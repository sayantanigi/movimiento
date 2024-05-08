<?php
class Partners extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/partners_model');
			$this->load->library('image_lib');
			$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
            $this->output->set_header('Pragma: no-cache');
			
			//****************************backtrace prevent*** END HERE*************************
			
		}
		//============Constructor to call Model====================
		function index(){
			if($this->session->userdata('is_logged_in')){
				redirect('supercontrol/partnersadd_view');
			}else{
				$this->load->view('supercontrol/main/login');	
			}
		}
		
		
		//=======================Insert Page Data============
		function add_partners(){
			$config = array(
			'upload_path' => "uploads/partners/",
			'upload_url' => base_url() . "uploads/partners/",
			'allowed_types' => "gif|jpg|png|jpeg"
			);
			
        	$this->load->library('upload', $config);
		if (!$this->upload->do_upload('userfile')){
			$data['success_msg'] = '<div class="alert alert-success text-center">You Must Select An Image File!</div>';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/partnersadd_view', $data);
			$this->load->view('supercontrol/footer');
		} else{
			 $data['userfile'] = $this->upload->data();
			 $filename = $data['userfile']['file_name'];
			 $data = array(
				'partners_img' => $filename,
				'status' => 1
			);
			$this->partners_model->insert_partners($data);
			$upload_data = $this->upload->data();
			$query = $this->partners_model->show_partners();
			$data['ecms'] = $query;
			$data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>' . $upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showpartnerslist',$data);
			$this->load->view('supercontrol/footer');
	
		}
		}
		//=======================Insert Page Data============
  		//=======================Insertion Success message=========
		function success(){
			$data['h1title'] = 'Data Inserted Successfully';
			$data['title'] = 'Add partners';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/partnersadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
		//=======================Insertion Success message=========	
		
		
		//================Add partners form=============
		function addpartners(){
			
			$data['title'] = "Partners Add";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/partnersadd_view');
			$this->load->view('supercontrol/footer');
		}
		//================View Individual Data List=============
		
		//================View Individual Data List=============
  		//================Show Individual by Id=================
		function show_partners_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Partners";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/partners_model');
			//Transfering data to Model
			$query = $this->partners_model->show_partners_id($id);
			
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/partners_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
		
		function statuspartners (){
		$stat= $this->input->get('stat'); 
		$id= $this->input->get('id');   
		$this->load->model('supercontrol/partners_model');
		$this->partners_model->updt($stat,$id);
		}
   		//================Show Individual by Id=================
  	 	//================Update Individual ====================
		function edit_partners(){
			 //============================================
		 	 $partners_img = $this->input->post('partners_img');
			  
			 $config = array(
				'upload_path' => "uploads/partners/",
				'upload_url' => base_url() . "uploads/partners/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			 
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload("userfile")) {
				@unlink("uploads/partners/".$partners_img);
				$data['img'] = $this->upload->data();
				//============================================
				$datalist = array(
				'partners_img' => $data['img']['file_name']
				);
				//print_r($datalist); exit();
				$partners_img = $this->input->post('partners_img');
				//====================Post Data===================
				
				$id = $this->input->post('partners_id');
				$data['title'] = "Partners Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/partners_model');
				//Transfering data to Model
				$query = $this->partners_model->partners_edit($id,$datalist,$partners_img);
				$data1['message'] = 'Data Update Successfully';
				$query = $this->partners_model->show_partnerslist();
				$data['ecms'] = $query;
				$data['title'] = "partners Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showpartnerslist', $data1);
				$this->load->view('supercontrol/footer');
				//*********************************
			}
		}
		//================Update Individual ====================
		//=======================Delete Individual==============
		function delete_cms($id){
			//Loading  Database
			$this->load->database();
			//Transfering data to Model
			$this->cms_model->delete_cms($id);
			$data1['message'] = 'Data Deleted Successfully';
			redirect('individual/successdelete');
		}
		//======================Delete Individual===============
		
		//======================Show CMS========================
		function showpartners(){
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/partners_model');
			//Transfering data to Model
			$query = $this->partners_model->show_partners();
			$data['ecms'] = $query;
			$data['title'] = "Partners List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showpartnerslist');
			$this->load->view('supercontrol/footer');
		}
		//======================Show CMS========================
		
		//=====================DELETE partners====================
			function delete_partners() {
			$id = $this->uri->segment(4);
			$result=$this->partners_model->show_partners_id($id);
			$partners_img = $result[0]->partners_img;
			//Loading Database
			$this->load->database();

			//Transfering data to Model
			$query = $this->partners_model->delete_partners($id,$partners_img);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			redirect('supercontrol/partners/showpartners');
			$this->load->view('supercontrol/footer');
		}

		//=====================DELETE partners====================
		
		//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('supercontrol/login');
    	}
		//======================Logout==========================
}
?>