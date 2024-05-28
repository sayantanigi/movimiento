<?php
class Press extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/press_model');
			$this->load->library('image_lib');
			$this->load->database();
			
				//****************************backtrace prevent*** START HERE*************************
			$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
            $this->output->set_header('Pragma: no-cache');
			
			//****************************backtrace prevent*** END HERE*************************
		}
		//============Constructor to call Model====================
		function index(){
		if($this->session->userdata('is_logged_in')){
			redirect('supercontrol/press/press_add_form');
			///supercontrol/press_add_form
        }else{
        	$this->load->view('supercontrol/login');	
        }
		
		
	}
//======================Show Add form for press add **** START HERE========================	
function press_add_form(){
				$data['title'] = "Add Press";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/pressadd_view');
				$this->load->view('supercontrol/footer');
     }
		
//====================== Show Add form for press add ****END HERE========================
		//=======================Insert Page Data============
		function add_press(){
			$my_date = date("Y-m-d", time()); 
			$config = array(
			'upload_path' => "uploads/press/",
			'upload_url' => base_url() . "uploads/press/",
			'allowed_types' => "gif|jpg|png|jpeg"
			);
        	$this->load->library('upload', $config);
				//=====================+++++++++++++++++++++++===================
				$this->form_validation->set_rules('press_title','News Title', 'required');
				$this->form_validation->set_rules('posted_by', 'Posted By', 'required|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('press_desc', 'press Description', 'required|min_length[1]|max_length[100000]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/pressadd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);
				}else{
					if (!$this->upload->do_upload('userfile')){
						 $data = array(
							'press_title' => $this->input->post('press_title'),
							'posted_by' => $this->input->post('posted_by'),
							'link' => $this->input->post('link'),
							'press_desc' => $this->input->post('press_desc'),
							'date' => $my_date,
							'press_status' => 1
						);
						$this->press_model->insert_press($data);
            			$upload_data = $this->upload->data();
						$query = $this->press_model->show_press();
						$data['ecms'] = $query;
            			$data['success_msg'] = '<div class="alert alert-success text-center"> Data successfully inserted!!!</div>';
						$this->load->view('supercontrol/header',$data);
						$this->load->view('supercontrol/showpresslist',$data);
						$this->load->view('supercontrol/footer');
				
					
        			}else{
						 $data['userfile'] = $this->upload->data();
						 $filename=$data['userfile']['file_name'];
						 $data = array(
							'press_title' => $this->input->post('press_title'),
							'posted_by' => $this->input->post('posted_by'),
							'link' => $this->input->post('link'),
							'press_image' => $filename,
							'press_desc' => $this->input->post('press_desc'),
							'date' => $my_date,
							'press_status' => 1
						);
						$this->press_model->insert_press($data);
            			$upload_data = $this->upload->data();
						$query = $this->press_model->show_press();
						$data['ecms'] = $query;
            			$data['success_msg'] = '<div class="alert alert-success text-center"> Data successfully inserted!!!</div>';
						$this->load->view('supercontrol/header',$data);
						$this->load->view('supercontrol/showpresslist',$data);
						$this->load->view('supercontrol/footer');
				
					}
				}
		}
		//=======================Insert Page Data============
function view_press($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit press";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/press_model');
			//Transfering data to Model
			$query = $this->press_model->show_press_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/press_view', $data);
			$this->load->view('supercontrol/footer');
		}
//=======================Insertion Success message for News *** START HERE=========
		function success(){
			$data['h1title'] = 'Add Press';
			
			$data['title'] = 'Add Press';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/pressadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
//=======================Insertion Success message *** END HERE=========	
//======================Show News List **** START HERE========================
		function show_press(){
		//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/press_model');
			//Transfering data to Model
			$query = $this->press_model->show_press();
			$data['ecms'] = $query;
			$data['title'] = "Press List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showpresslist');
			$this->load->view('supercontrol/footer');
		
	}
//======================Show News List **** END HERE========================
//======================Status change **** START HERE========================
	function statuspress ()
		{
			     $stat= $this->input->get('stat'); 
				 $id= $this->input->get('id');   
		$this->load->model('supercontrol/press_model');
		$this->press_model->updt($stat,$id);
		}

//=======================Status change **** END HERE========================	
//================Show Individual by Id for News *** START HERE=================
		function show_press_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit press";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/press_model');
			//Transfering data to Model
			$query = $this->press_model->show_press_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/press_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for News *** END HERE=================
//================Update Individual press***** START HERE ====================
		function edit_press(){
			 $press_image = $this->input->post('press_image');
			 $config = array(
				'upload_path' => "uploads/press/",
				'upload_url' => base_url() . "uploads/press/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				@unlink("uploads/press/".$press_image);
				//echo $image_data = $this->upload->data();
				$data['img'] = $this->upload->data();
			 	//echo $data['img']['file_name'];
				//exit();
				//*********************************
				//============================================
				$datalist = array(			
				'press_title' => $this->input->post('press_title'),
				'posted_by' => $this->input->post('posted_by'),
				'link' => $this->input->post('link'),
				'press_desc' => $this->input->post('press_desc'),
				'press_image' => $data['img']['file_name']
				);
				//echo $gallery_name=$_POST['gallery_name'];
				//====================Post Data===================
				//print_r($datalist);
				//exit();
				$id = $this->input->post('press_id');
				$data['title'] = "Press Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/press_model');
				//Transfering data to Model
				$query = $this->press_model->press_edit($id,$datalist);
				// echo $ddd=$this->db->last_query();
				
				$data1['message'] = '<div class="alert alert-success text-center">Data successfully uploaded!!!</div>';
				$query = $this->press_model->show_presslist();
				$data['ecms'] = $query;
				$data['title'] = "Press Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showpresslist', $data1);
				$this->load->view('supercontrol/footer');
				//*********************************
		
			}else{
				$datalist = array(			
					'press_title' => $this->input->post('press_title'),
				    'posted_by' => $this->input->post('posted_by'),
					'link' => $this->input->post('link'),
				    'press_desc' => $this->input->post('press_desc')
				
				);
				$id = $this->input->post('press_id');
				$data['title'] = "press Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/press_model');
				//Transfering data to Model
				$query = $this->press_model->press_edit($id,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = '<div class="alert alert-success text-center"> Data successfully uploaded!!!</div>';
				$query = $this->press_model->show_presslist();
				$data['ecms'] = $query;
				$data['title'] = "press Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showpresslist', $data1);
				$this->load->view('supercontrol/footer');
			}
			
		}
//================Update Individual  News ***** END HERE====================

		//=====================DELETE NEWS====================

		
			function delete_press() {
			$id = $this->uri->segment(4);
			$result=$this->press_model->show_press_id($id);
			$press_image=$result[0]->press_image; 
			$query = $this->press_model->delete_press($id,$press_image);
			
	        $query = $this->press_model->show_presslist();
			$data['ecms'] = $query;
			$data['title'] = "press Page List";
			$this->session->set_flashdata('success_delete', 'Press Deleted Successfully !!!');
			redirect('supercontrol/press/show_press',TRUE);
		}

		//=====================DELETE NEWS====================

		//====================MULTIPLE DELETE=================
		function delete_multiple(){
		$ids = ( explode( ',', $this->input->get_post('ids') ));
		$this->press_model->delete_mul($ids);
		$data4['msg1'] = '<div class="alert alert-success text-center"> Data successfully delete!!!</div>';
		$this->load->view('supercontrol/header');
		redirect('supercontrol/press/show_press',$data4);
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