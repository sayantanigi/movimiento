<?php
class Testimonial extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->model('supercontrol/testimonial_model');
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
			redirect('supercontrol/testimonialadd_view');
        }else{
        	$this->load->view('supercontrol/login');	
        }
	}
//======================Show Add form for blog add **** START HERE========================	
		
		function testmonial_add_form(){
			$data['title'] = "Add Blog ";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/testimonialadd_view');
			$this->load->view('supercontrol/footer');
			}
		
//====================== Show Add form for blog add ****END HERE========================
		
		//=======================Insert Blog Data *** START HERE============
		function add_testimonial(){
			$my_date = date("Y-m-d", time()); 
			$config = array(
				'upload_path' => "uploads/testimonial/",
				'upload_url' => base_url() . "uploads/testimonial/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			
			//load upload class library
        	  $this->load->library('upload', $config);
			   $this->load->library('form_validation');
               $this->form_validation->set_rules('testimonial_title', 'Testimonial Title', 'required');
		       $this->form_validation->set_rules('testimonial_desc', 'Testimonial Description','required');
		
		    if ($this->form_validation->run() == FALSE){ 
						$data['success_msg'] = '<div class="alert alert-success text-center">Validation Error!</div>';
						$this->load->view('supercontrol/header');
						$this->load->view('supercontrol/testimonialadd_view');
						$this->load->view('supercontrol/footer');
		         }else{ 
		
				 if (!$this->upload->do_upload('userfile')){
            			$data['success_msg'] = '<div class="alert alert-success text-center">You Must Select An Image File!</div>';
						$this->load->view('supercontrol/header');
            			$this->load->view('supercontrol/testimonialadd_view', $data);
						$this->load->view('supercontrol/footer');
        			}else{
						 $data['userfile'] = $this->upload->data();
						 $filename=$data['userfile']['file_name'];
						 $data = array(
						 'testimonial_title' => $this->input->post('testimonial_title'),
						 'testimonial_image' => $filename,
					     'testimonial_desc' => $this->input->post('testimonial_desc'),
					     'posted_by' => $this->input->post('posted_by'),
				         'testimonial_status' => 1,
					     'date' =>  $my_date
				    );
						 
				//Transfering data to Model
				$this->testimonial_model->insert_testimonial($data);
				$data1['message'] = 'Data Inserted Successfully';
				redirect('supercontrol/testimonial/success');
				 
			 }
		
		}
		}
//=======================Insert Blod Data **** END HERE============

//=======================Insertion Success message for blog *** START HERE=========
			function success(){
		
		$data['msg'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Inserted Successfully.....</div>';
					//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/testimonial_model');
			//Transfering data to Model
			$query = $this->testimonial_model->show_testimonial();
			$data['ecms'] = $query;
			//$data['title'] = "testimonial List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showtestimoniallist',$data);
			$this->load->view('supercontrol/footer');
		}
//=======================Insertion Success message *** END HERE=========	
//======================Show Blog List **** START HERE========================
		function show_testimonial(){
		     //Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/testimonial_model');
			//Transfering data to Model
			$query = $this->testimonial_model->show_testimonial();
			$data['ecms'] = $query;
			$data['title'] = "Testimonial List";
			$this->load->view('supercontrol/header',$data);
			
			$this->load->view('supercontrol/showtestimoniallist');
			$this->load->view('supercontrol/footer');
		
	}
//======================Show Blog List **** END HERE========================

//======================Status change **** START HERE========================
	function statustestimonial ()
		{
			     $stat= $this->input->get('stat'); 
				 $id= $this->input->get('id');   
		$this->load->model('testimonial_model');
		$this->testimonial_model->updt($stat,$id);
		}

//=======================Status change **** END HERE========================	
		
//================Show Individual by Id for BLOG *** START HERE=================
		function show_testimonial_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Testimonial";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('testimonial_model');
			//Transfering data to Model
			$query = $this->testimonial_model->show_testimonial_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/testimonial_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for BLOG *** END HERE=================
//================Update Individual blog***** START HERE ====================
		function edit_testimonial(){
			
		//============================================
		 $testimonial_image = $this->input->post('testimonial_image');
		 $id = $this->input->post('testimonial_id');
			$config = array(
				'upload_path' => "uploads/testimonial/",
				'upload_url' => base_url() . "uploads/testimonial/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				//echo $path = base_url(). "banner/";exit();
				//echo $path1 = "banner/"; 
				@unlink("uploads/testimonial/".$testimonial_image);
				
				//echo $image_data = $this->upload->data();
				$data['img'] = $this->upload->data();
				//*********************************
				//============================================
				$datalist = array(			
				//**********************************************
				'testimonial_title' => $this->input->post('testimonial_title'),
				'testimonial_desc' => $this->input->post('testimonial_desc'),
				'posted_by' => $this->input->post('posted_by'),
				'testimonial_image' => $data['img']['file_name']
				//**********************************************
				);

				 $this->load->database();
				//Calling Model
				$this->load->model('supercontrol/testimonial_model');
				//Transfering data to Model
				$query = $this->testimonial_model->testimonial_edit($id,$datalist,$testimonial_image);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = 'Data Update Successfully';
				$query = $this->testimonial_model->show_testimoniallist();
				$data['ecms'] = $query;
				$data['title'] = "Testimonial Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showtestimoniallist', $data1);
				$this->load->view('supercontrol/footer');
		
			}else{
				$datalist = array(			
				'testimonial_title' => $this->input->post('testimonial_title'),
				'testimonial_desc' => $this->input->post('testimonial_desc'),
				'posted_by' => $this->input->post('posted_by')
				);
				$id = $this->input->post('testimonial_id');
				$testimonial_image = $this->input->post('testimonial_image');
				$data['title'] = "Testimonial Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/testimonial_model');
				//Transfering data to Model
				$query = $this->testimonial_model->testimonial_edit($id,$datalist,$testimonial_image);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = 'Data Update Successfully';
				$query = $this->testimonial_model->show_testimoniallist();
				$data['ecms'] = $query;
				$data['title'] = "Testimonial Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showtestimoniallist', $data1);
				$this->load->view('supercontrol/footer');
			}
			}
		
//================Update Individual  Blog ***** END HERE====================
function delete_testimonial($id){
			//Loading  Database
			$this->load->database();
			$this->load->model('supercontrol/testimonial_model');
			////echo $id;
			//exit();
			//Transfering data to Model
			$id = $this->uri->segment(4);
			//echo $id; exit();
			$result=$this->testimonial_model->testimonial_view($id); 
			//print_r($result); exit();
			$testimonial_image = $result[0]->testimonial_image;
			$this->testimonial_model->delete_testimonial($id,$testimonial_image);
			//$data['emember'] = $query; 
			$data1['message'] = 'Data Deleted Successfully'; 
			redirect('supercontrol/testimonial/successdelete');
		}
		//======================Delete teacher===============
		//======================Delete Success message==========
		function successdelete(){
			//Loading  Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/testimonial_model');
			//Transfering data to Model
			$query = $this->testimonial_model->show_testimonial();
			$data['ecms'] = $query;
			$data['title'] = "testimonial List";
			$data1['success_msg'] = '<div class="alert alert-success-del text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Deleted Successfully.....</div>';
			$datamsg['h1title'] = 'Data Deleted Successfully';
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showtestimoniallist',$data1);
			$this->load->view('supercontrol/footer');
		}
//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('login');
    	}
//======================Logout==========================
}

?>