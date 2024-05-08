<?php
class Adminprofile extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/adminprofile_model');
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
			redirect('supercontrol/adminprofile_edit');
        }else{
        	$this->load->view('supercontrol/login');	
        }
	}
//================Show Individual by Id for BLOG *** START HERE=================
		function show_adminprofile_id($MailId) {
			 $MailId = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Admin Profile";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/adminprofile_model');
			//Transfering data to Model
			$query = $this->adminprofile_model->show_adminprofile_id($MailId);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/adminprofile_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for BLOG *** END HERE=================
//================Update Individual blog***** START HERE ====================
		function edit_adminprofile(){
			
			 $config = array(
				'upload_path' => "profile/",
				'upload_url' => base_url() . "profile/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				
				//echo $image_data = $this->upload->data();
				$data['img'] = $this->upload->data();
	
				$datalist = array(			
				'MailAddress' => $this->input->post('MailAddress'),
				'UserImage' => $data['img']['file_name']
			                        );
				
				$MailId = $this->input->post('admin_id');
				$data['title'] = "Admin Profile Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/adminprofile_model');
				//Transfering data to Model
				$query = $this->adminprofile_model->adminprofile_edit($MailId,$datalist);
				// echo $ddd=$this->db->last_query();
				
				$data1['message'] = 'Data Update Successfully';
				$query = $this->adminprofile_model->show_adminprofilelist();
				$data['ecms'] = $query;
				$data['title'] = "Admin profile Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/adminprofile_edit', $data1);
				$this->load->view('supercontrol/footer');
				//*********************************
		
			}else{
				$datalist = array(			
				'MailAddress' => $this->input->post('MailAddress')
				);
		       //====================Post Data===================
				
				$MailId = $this->input->post('admin_id');
				$data['title'] = "Adminprofile Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/adminprofile_model');
				//Transfering data to Model
				$query = $this->adminprofile_model->adminprofile_edit($MailId,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = 'Data Update Successfully';
				$query = $this->adminprofile_model->show_adminprofilelist();
				$data['ecms'] = $query;
				$data['title'] = "Admin profile Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/adminprofile_edit', $data1);
				$this->load->view('supercontrol/footer');
			}
			
		}
//================Update Individual  Blog ***** END HERE====================
//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('supercontrol/login');
    	}
//======================Logout==========================
}

?>