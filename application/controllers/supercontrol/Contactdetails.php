<?php
class Contactdetails extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/contactdetail_model');
			$this->load->library('image_lib');
			$this->load->model('generalmodel');
			$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
            $this->output->set_header('Pragma: no-cache');
		}
		//============Constructor to call Model====================
		function index()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('supercontrol/showcmslist');
        }else{
        	$this->load->view('supercontrol/login');	
        }
	}
		
		public function is_logged_in(){
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        $is_logged_in = $this->session->userdata('logged_in');
        if(!isset($is_logged_in) || $is_logged_in!==TRUE){
            redirect('supercontrol/main/login');
        }
    }
		function show_cms_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Contact Detail";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/contactdetail_model');
			//Transfering data to Model
			$query = $this->contactdetail_model->show_cms_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/contactdetails_edit', $data);
			$this->load->view('supercontrol/footer');
		}
   		//================Show Individual by Id=================
  	 	//================Update Individual ====================
		function edit_cms(){
			 $config = array(
				'upload_path' => "uploads/contactdetails/",
				'upload_url' => base_url() . "uploads/contactdetails/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			
				$datalist = array(			
				'country_name' => $this->input->post('country_name'),  
				'country_image' => $_FILES['country_image']['name'],
				'address' => $this->input->post('address'),
				'mail' => $this->input->post('mail'),
				'phone' => $this->input->post('phone'),
				'mobile' => $this->input->post('mobile'),
				
				'whatapp' => $this->input->post('whatapp')
				);
				$id = $this->input->post('id');
				$data['title'] = "Contact Detail Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/contactdetail_model');
				//Transfering data to Model
				$query = $this->contactdetail_model->edit_cms($id,$datalist);
				$data1['message'] = 'Data Update Successfully';
				$query = $this->contactdetail_model->show_cmslist();
				$data['ecms'] = $query;
				$data['title'] = "Contact Detail Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showcontactdetailslist', $data1);
				$this->load->view('supercontrol/footer');
			
			
		}
		//================Update Individual ====================
  		//=======================Update Success message=========
		function successupdate(){
			//loading database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/contactdetail_model');
			//Transfering data to Model
			$query = $this->contactdetail_model->view_cms();
			$data['ecms'] = $query;
			$data['title'] = "Individual Data List";
			$datamsg['h1title'] = 'Data Updated Successfully';
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showcontactdetailslist',$datamsg);
			$this->load->view('supercontrol/footer');
		}
		//=======================Update Success message=========
		//=======================Delete Individual==============
		function delete_cms($id){
			//Loading  Database
			$this->load->database();
			//Transfering data to Model
			$this->contactdetail_model->delete_cms($id);
			$data1['message'] = 'Data Deleted Successfully';
			redirect('supercontrol/individual/successdelete');
		}
		//======================Delete Individual===============
		//======================Delete Success message==========
		function successdelete(){
			//Loading  Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/contactdetail_model');

			//Transfering data to Model
			$query = $this->contactdetail_model->view_cms();
			$data['ecms'] = $query;
			$data['title'] = "cms Data List";
			$datamsg['h1title'] = 'Data Updated Successfully';
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showcontactdetailslist');
			$this->load->view('supercontrol/footer');
		}
  		//======================Delete Success message==========
		
		//======================Show CMS========================
		function show_contactdetails(){
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/contactdetail_model');
			//Transfering data to Model
			$query = $this->contactdetail_model->show_cmslist();
			$data['ecms'] = $query;
			$data['title'] = "Contact Details List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showcontactdetailslist');
			$this->load->view('supercontrol/footer');
		
	}
		//==================Show CMS========================
		//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('supercontrol/login');
    	}
		//======================Logout==========================
}

?>

