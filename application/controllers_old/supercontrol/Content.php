<?php
class Content extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/Content_model');
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
			redirect('supercontrol/showcontentlist');
        }else{
        	$this->load->view('supercontrol/login');	
        }
	}
		
		public function is_logged_in(){
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        //header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        $is_logged_in = $this->session->userdata('logged_in');
        
        if(!isset($is_logged_in) || $is_logged_in!==TRUE){
            redirect('supercontrol/main/login');
        }
    }
		//=======================Insert Page Data============
		function add_cms(){
			
			 $config = array(
				'upload_path' => "uploads/Content",
				'upload_url' => base_url() . "uploads/Content",
				'allowed_types' => "gif|jpg|png|jpeg|pdf"
			);
			 $this->load->library('upload', $config);
			 if ($this->upload->do_upload("userfile")) {
				 //echo $image_data = $this->upload->data();
				 $data['img'] = $this->upload->data();
			 	 $data['img']['file_name'];
				//exit();
				//*********************************
				//============================================
				
				$data = array(
					'cms_pagetitle' => $this->input->post('cms_pagetitle'),
					'cms_heading' => $this->input->post('cms_heading'),
					'cms_sub_heading' => $this->input->post('cms_sub_heading'),
					'cms_img' => $data['img']['file_name'],
					'description' => mysql_real_escape_string(strip_tags($this->input->post('description'))),
					'status' => 1
				);
				//Transfering data to Model
				$this->Content_model->insert_cms($data);
				$data1['message'] = 'Data Inserted Successfully';
				redirect('supercontrol/content/success');
			 }else{
				 $data = array(
					'cms_pagetitle' => $this->input->post('cms_pagetitle'),
					'cms_heading' => $this->input->post('cms_heading'),
					'cms_sub_heading' => $this->input->post('cms_sub_heading'),
					'description' => mysql_real_escape_string(strip_tags($this->input->post('description'))),
					'status' => 1
				);
				//Transfering data to Model
				$this->Content_model->insert_cms($data);
				$data1['message'] = 'Data Inserted Successfully';
				redirect('supercontrol/content/success');
				 
			 }
			
			
			
			
			//}
		}
		//=======================Insert Page Data============
  		//=======================Insertion Success message=========
		function success(){
			$data['h1title'] = 'Data Inserted Successfully';
			$data['title'] = 'Add Content';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/contentadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
		//=======================Insertion Success message=========	
		
		
		//================View Individual Data List=============
		function view_addcms(){
			$data['title'] = "Content Data Add";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/contentadd_view');
			$this->load->view('supercontrol/footer');
		}
		//================View Individual Data List=============
		
		//================View Individual Data List=============
  		//================Show Individual by Id=================
		function show_cms_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Content";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/Content_model');
			//Transfering data to Model
			$query = $this->Content_model->show_cms_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/content_edit', $data);
			$this->load->view('supercontrol/footer');
		}
   		//================Show Individual by Id=================
  	 	//================Update Individual ====================
		function edit_cms(){
				

			 $config = array(
				'upload_path' => "uploads/content",
				'upload_url' => base_url() . "uploads/content",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload("userfile") && $this->upload->do_upload("userfile1") && $this->upload->do_upload("userfile2") && $this->upload->do_upload("userfile3") && $this->upload->do_upload("userfile4")) {
				
				//============================================
				
				$datalist = array(			
				'page_title'      => $this->input->post('page_title'),  
				'content_title'   => $this->input->post('content_title'),
				'content_sub_title'   => $this->input->post('content_sub_title'),
				'video_link'   => $this->input->post('video_link'),
				'read_more'   => $this->input->post('read_more'),
				'content_details'   => $this->input->post('content_details'),
				'content_image'   => $_FILES['userfile']['name'],
				
				'content_title_1'   => $this->input->post('content_title_1'),
				'content_sub_title_1'   => $this->input->post('content_sub_title_1'),
				'video_link_1'   => $this->input->post('video_link_1'),
				'read_more_1'   => $this->input->post('read_more_1'),
				'content_details_1'   => $this->input->post('content_details_1'),
				'content_image_1' => $_FILES['userfile1']['name'],
				
				'content_title_2'   => $this->input->post('content_title_2'),
				'content_sub_title_2'   => $this->input->post('content_sub_title_2'),
				'video_link_2'   => $this->input->post('video_link_2'),
				'read_more_2'   => $this->input->post('read_more_2'),
				'content_details_2'   => $this->input->post('content_details_2'),
				'content_image_2' => $_FILES['userfile2']['name'],
				
				'content_title_3'   => $this->input->post('content_title_3'),
				'content_sub_title_3'   => $this->input->post('content_sub_title_3'),
				'video_link_3'   => $this->input->post('video_link_3'),
				'read_more_3'   => $this->input->post('read_more_3'),
				'content_details_3'   => $this->input->post('content_details_3'),
				'content_image_3' => $_FILES['userfile3']['name'],
				
				'content_title_4'   => $this->input->post('content_title_4'),
				'content_sub_title_4'   => $this->input->post('content_sub_title_4'),
				'video_link_4'   => $this->input->post('video_link_4'),
				'read_more_4'   => $this->input->post('read_more_4'),
				'content_image_4' => $_FILES['userfile4']['name'],
				'content_details_4'   => $this->input->post('content_details_4')
				
				);
				//print_r($datalist); exit();
				//====================Post Data===================
				
				$id = $this->input->post('id');
				$data['title'] = "Page Content Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/Content_model');
				//Transfering data to Model
				$query = $this->Content_model->edit_cms($id,$datalist);
				$data1['message'] = 'Data Update Successfully';
				$query = $this->Content_model->show_cmslist();
				$data['ecms'] = $query;
				$data['title'] = "Content Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showcontentlist', $data1);
				$this->load->view('supercontrol/footer');
				//*********************************
		
			}else{
				$datalist = array(			
				'page_title'      => $this->input->post('page_title'),  
				'content_title'   => $this->input->post('content_title'),
				'content_sub_title'   => $this->input->post('content_sub_title'),
				'video_link'   => $this->input->post('video_link'),
				'read_more'   => $this->input->post('read_more'),
				'content_details'   => $this->input->post('content_details'),
				
				
				'content_title_1'   => $this->input->post('content_title_1'),
				'content_sub_title_1'   => $this->input->post('content_sub_title_1'),
				'video_link_1'   => $this->input->post('video_link_1'),
				'read_more_1'   => $this->input->post('read_more_1'),
				'content_details_1'   => $this->input->post('content_details_1'),
				
				
				'content_title_2'   => $this->input->post('content_title_2'),
				'content_sub_title_2'   => $this->input->post('content_sub_title_2'),
				'video_link_2'   => $this->input->post('video_link_2'),
				'read_more_2'   => $this->input->post('read_more_2'),
				'content_details_2'   => $this->input->post('content_details_2'),
				
				
				'content_title_3'   => $this->input->post('content_title_3'),
				'content_sub_title_3'   => $this->input->post('content_sub_title_3'),
				'video_link_3'   => $this->input->post('video_link_3'),
				'read_more_3'   => $this->input->post('read_more_3'),
				'content_details_3'   => $this->input->post('content_details_3'),
				
				
				'content_title_4'   => $this->input->post('content_title_4'),
				'content_sub_title_4'   => $this->input->post('content_sub_title_4'),
				'video_link_4'   => $this->input->post('video_link_4'),
				'read_more_4'   => $this->input->post('read_more_4'),
				'content_details_4'   => $this->input->post('content_details_4')
				);
				
				$id = $this->input->post('id');
				$data['title'] = "Content Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/Content_model');
				//Transfering data to Model
				$query = $this->Content_model->edit_cms($id,$datalist);
				$data1['message'] = 'Data Update Successfully';
				$query = $this->Content_model->show_cmslist();
				$data['ecms'] = $query;
				$data['title'] = "Content Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showcontentlist', $data1);
				$this->load->view('supercontrol/footer');
			}
			
		}
		//================Update Individual ====================
  		//=======================Update Success message=========
		function successupdate(){
			//loading database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/Content_model');
			//Transfering data to Model
			$query = $this->Content_model->view_cms();
			$data['ecms'] = $query;
			$data['title'] = "Individual Data List";
			$datamsg['h1title'] = 'Data Updated Successfully';
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showcmslist',$datamsg);
			$this->load->view('supercontrol/footer');
		}
		//=======================Update Success message=========
		//=======================Delete Individual==============
		function delete_cms($id){
			//Loading  Database
			$this->load->database();
			//Transfering data to Model
			$this->Content_model->delete_cms($id);
			$data1['message'] = 'Data Deleted Successfully';
			redirect('supercontrol/individual/successdelete');
		}
		//======================Delete Individual===============
		//======================Delete Success message==========
		function successdelete(){
			//Loading  Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/cms_model');

			//Transfering data to Model
			$query = $this->cms_model->view_cms();
			$data['ecms'] = $query;
			$data['title'] = "cms Data List";
			$datamsg['h1title'] = 'Data Updated Successfully';
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showcmslist');
			$this->load->view('supercontrol/footer');
		}
  		//======================Delete Success message==========
		
		//======================Show CMS========================
		function show_cms(){
		 
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/Content_model');
			//Transfering data to Model
			$query = $this->Content_model->show_cmslist();
			$data['ecms'] = $query;
			$data['title'] = "Content List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showcontentlist');
			$this->load->view('supercontrol/footer');
		
	}
	function crop_cms(){
		 
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/cms_model');
			//Transfering data to Model
			$query = $this->cms_model->crop_cmslist();
			$data['ecmsq'] = $query;
			$data['title'] = "CMS List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showcroplist');
			$this->load->view('supercontrol/footer');
		
	}
	function delete_crop() {
		$id = $this->uri->segment(4);
		$table_name = 'sm_cms_corp_stu';
		$fieldname = 'id';
		$action = 'delete';
		$this->generalmodel->show_data_id($table_name,$id,$fieldname,$action,'');
		$this->session->set_flashdata('delete_message','Deleted Successfully');
		redirect('supercontrol/cms/crop_cms',TRUE);
	}
		function addcrop(){
			$data['title'] = "CMS Data Add";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/cropadd_view');
			$this->load->view('supercontrol/footer');
		}
		function add_crop(){
				
				$data = array(
					'for_type' => $this->input->post('for_type'),
					'icon' => $this->input->post('icon'),
					'heading' => $this->input->post('heading'),
					'description' => mysql_real_escape_string(strip_tags($this->input->post('description')))
				);
				//Transfering data to Model
				$this->cms_model->insert_crop($data);
				$data['message'] = 'Data Inserted Successfully';
				redirect('supercontrol/cms/crop_cms');
			 }			
		function show_crop_id($id) {
			 $id = $this->uri->segment(4); 
			
			$data['title'] = "Edit Cms";
			
			$this->load->database();
			$this->load->model('supercontrol/cms_model');
			$query = $this->cms_model->show_crop_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/crop_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		function edit_crop(){
			
				$data = array(
					'for_type' => $this->input->post('for_type'),
					'icon' => $this->input->post('icon'),
					'heading' => $this->input->post('heading'),
					'description' => mysql_real_escape_string(strip_tags($this->input->post('description')))
				);	
				
				$id = $this->input->post('cms_id');
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/cms_model');
				//Transfering data to Model
				$query = $this->cms_model->edit_crop($id,$data);
				$data['message'] = 'Data Update Successfully';
				$query = $this->cms_model->crop_cmslist();
				$data['ecmsq'] = $query;
				$data['title'] = "Cms Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showcroplist');
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

