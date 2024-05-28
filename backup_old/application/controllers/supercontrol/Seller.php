<?php
class Seller extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/seller_model');
			$this->load->library('image_lib');
			
				//****************************backtrace prevent*** START HERE*************************
			$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
            $this->output->set_header('Pragma: no-cache');
			
			//****************************backtrace prevent*** END HERE*************************
		}
		//============Constructor to call Model====================
		function index()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('supercontrol/selleradd_view');
        }else{
        	$this->load->view('supercontrol/login');	
        }
		
		
	}
//======================Show Add form for seller add **** START HERE========================	
function seller_add_form(){
				$data['title'] = "Add Seller";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/selleradd_view');
				$this->load->view('supercontrol/footer');
     }
		
//====================== Show Add form for seller add ****END HERE========================
		//=======================Insert Page Data============
		function add_seller(){
			$my_date = date("Y-m-d", time()); 
			$config = array(
			'upload_path' => "seller/",
			'upload_url' => base_url() . "seller/",
			'allowed_types' => "gif|jpg|png|jpeg"
			);
        	$this->load->library('upload', $config);
				//=====================+++++++++++++++++++++++===================
				$this->form_validation->set_rules('seller_title','Seller Title', 'required');
				$this->form_validation->set_rules('designation', 'Designation', 'required|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('email', 'Email', 'required|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('username', 'Username', 'required|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('seller_desc', 'Seller Description', 'required|min_length[1]|max_length[100000]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/selleradd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);
				}else{
					if (!$this->upload->do_upload('userfile')){
            			$data['success_msg'] = '<div class="alert alert-success text-center">You Must Select An Image File!</div>';
						$this->load->view('supercontrol/header');
            			$this->load->view('supercontrol/selleradd_view', $data);
						$this->load->view('supercontrol/footer');
        			}else{
						 $data['userfile'] = $this->upload->data();
						 $filename=$data['userfile']['file_name'];
						 $data = array(
							'seller_title' => $this->input->post('seller_title'),
							'designation' => $this->input->post('designation'),
							'email' => $this->input->post('email'),
							'password' => base64_encode($this->input->post('password')),
							'username' => $this->input->post('username'),
							'seller_image' => $filename,
							'seller_desc' => $this->input->post('seller_desc'),
							'date' => $my_date,
							'seller_status' => 1
						);
						 //print_r($data); exit();
						$this->seller_model->insert_seller($data);
            			$upload_data = $this->upload->data();
						$query = $this->seller_model->show_seller();
						$data['ecms'] = $query;
						$this->session->set_flashdata('add_message', 'Seller Added Successfully !!!!');
            			$data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>' . $upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
						/*$this->load->view('supercontrol/header',$data);
						$this->load->view('supercontrol/showsellerlist',$data);
						$this->load->view('supercontrol/footer');*/
						$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/seller/show_seller');
			$this->load->view('supercontrol/footer');
				
					}
				}
		}
		//=======================Insert Page Data============

//=======================Insertion Success message for Seller *** START HERE=========
		function success(){
			$data['h1title'] = 'Add Seller';
			
			$data['title'] = 'Add Seller';
			$this->session->set_flashdata('add_message', 'Seller Added Successfully !!!!');
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/selleradd_view',$data);
			$this->load->view('supercontrol/footer');
		}
//=======================Insertion Success message *** END HERE=========	
//======================Show Seller List **** START HERE========================
		function show_seller(){
		//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/seller_model');
			//Transfering data to Model
			$query = $this->seller_model->show_seller();
			$data['ecms'] = $query;
			$data['title'] = "Seller List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showsellerlist');
			$this->load->view('supercontrol/footer');
		
	}
//======================Show Seller List **** END HERE========================
//======================Status change **** START HERE========================
	function statusseller ()
		{
			     $stat= $this->input->get('stat'); 
				 $id= $this->input->get('id');   
		$this->load->model('supercontrol/seller_model');
		$this->seller_model->updt($stat,$id);
		}

//=======================Status change **** END HERE========================	
//================Show Individual by Id for Seller *** START HERE=================
		function show_seller_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Seller";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/seller_model');
			//Transfering data to Model
			$query = $this->seller_model->show_seller_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/seller_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for Seller *** END HERE=================
//================Update Individual seller***** START HERE ====================
		function edit_seller(){
			 $seller_image = $this->input->post('seller_image');
			 $config = array(
				'upload_path' => "seller/",
				'upload_url' => base_url() . "seller/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				@unlink("seller/".$seller_image);
				//echo $image_data = $this->upload->data();
				$data['img'] = $this->upload->data();
			 	//echo $data['img']['file_name'];
				//exit();
				//*********************************
				//============================================
				$datalist = array(			
				'seller_title' => $this->input->post('seller_title'),
				'designation' => $this->input->post('designation'),
				'email' => $this->input->post('email'),
				'password' => base64_encode($this->input->post('password')),
				'username' => $this->input->post('username'),
				'seller_desc' => $this->input->post('seller_desc'),
				'seller_image' => $data['img']['file_name']
				);
				//echo $gallery_name=$_POST['gallery_name'];
				//====================Post Data===================
				//print_r($datalist);
				//exit();
				$id = $this->input->post('seller_id');
				$data['title'] = "Seller Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/seller_model');
				//Transfering data to Model
				$query = $this->seller_model->seller_edit($id,$datalist);
				// echo $ddd=$this->db->last_query();
				
				$data1['message'] = 'Data Update Successfully';
				$query = $this->seller_model->show_sellerlist();
				$data['ecms'] = $query;
				$data['title'] = "Seller Page List";
				/*$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showsellerlist', $data1);
				$this->load->view('supercontrol/footer');*/
				$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/seller/show_seller');
			$this->load->view('supercontrol/footer');
				//*********************************
		
			}else{
				$datalist = array(			
					'seller_title' => $this->input->post('seller_title'),
				    'designation' => $this->input->post('designation'),
					'email' => $this->input->post('email'),
					'password' => base64_encode($this->input->post('password')),
					'username' => $this->input->post('username'),
				    'seller_desc' => $this->input->post('seller_desc')
				
				);
				$id = $this->input->post('seller_id');
				$data['title'] = "Seller Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/seller_model');
				//Transfering data to Model
				$query = $this->seller_model->seller_edit($id,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = 'Data Update Successfully';
				$query = $this->seller_model->show_sellerlist();
				$data['ecms'] = $query;
				$this->session->set_flashdata('edit_message', 'Seller Updated Successfully !!!!');
				$data['title'] = "Seller Page List";
				/*$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showsellerlist', $data1);
				$this->load->view('supercontrol/footer');*/
				$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/seller/show_seller');
			$this->load->view('supercontrol/footer');
			}
			
		}
//================Update Individual  Seller ***** END HERE====================

		//=====================DELETE NEWS====================

		
			function delete_seller() {
			$id = $this->uri->segment(4);
			$result=$this->seller_model->show_seller_id($id);
			//print_r($result);
			$seller_image = $result[0]->seller_image; 
			//echo $banner_img;exit();
			//Loading Database
			$this->load->database();

			//Transfering data to Model
			$query = $this->seller_model->delete_seller($id,$seller_image);
			$data['ecms'] = $query;
			$this->session->set_flashdata('delete_message', 'Seller Deleted Successfully !!!!');
			$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/seller/show_seller');
			$this->load->view('supercontrol/footer');
		}

		//=====================DELETE NEWS====================

		//====================MULTIPLE DELETE=================
		function delete_multiple(){
		$ids = ( explode( ',', $this->input->get_post('ids') ));
		$this->seller_model->delete_mul($ids);
		$this->session->set_flashdata('delete_message1', 'Seller Deleted Successfully !!!!');
		$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/seller/show_seller');
			$this->load->view('supercontrol/footer');
		}
		
		function seller_view($id){
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/seller_model');
			//Transfering data to Model
			$query = $this->seller_model->seller_view($id);
			$data['viewseller'] = $query;
			//echo $sql = $this->db->last_query();
			//exit();
			$data['title'] = "Seller View";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/seller_view',$data);
			$this->load->view('supercontrol/footer');
			
		
	}
		//====================MULTIPLE DELETE=================
//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('supercontrol/login');
    	}
//======================Logout==========================
}

?>