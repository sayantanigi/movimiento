<?php
class Banner extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			
			$this->load->model('supercontrol/banner_model');
			$this->load->library('image_lib');
			$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
            $this->output->set_header('Pragma: no-cache');
			
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			
		}
		//============Constructor to call Model====================
		function index(){
			if($this->session->userdata('is_logged_in')){
				redirect('supercontrol/banneradd_view');
			}else{
				$this->load->view('supercontrol/main/login');	
			}
		}
		
		
		//=======================Insert Page Data============
		function add_banner(){
			$config = array(
			'upload_path' => "banner/",
			'upload_url' => base_url() . "banner/",
			'allowed_types' => "gif|jpg|png|jpeg"
			);
			
			//load upload class library
        	$this->load->library('upload', $config);
				//=====================+++++++++++++++++++++++===================
				$this->form_validation->set_rules('banner_heading','Banner Heading', 'required');
				//$this->form_validation->set_rules('banner_sub_heading', 'Banner Sub Heading', 'required|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('banner_description', 'Banner Description', 'required|min_length[1]|max_length[10000000000]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/banneradd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);
				}else{
					if (!$this->upload->do_upload('userfile')){
            			$data = array(
							'banner_heading' => $this->input->post('banner_heading'),
							'banner_sub_heading' => $this->input->post('banner_sub_heading'),
							'banner_description' => $this->input->post('banner_description'),
							'status' => 1
						);
						$this->banner_model->insert_banner($data);
            			$upload_data = $this->upload->data();
						$query = $this->banner_model->show_banner();
						$data['ecms'] = $query;
            			$data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>' . $upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
						$this->load->view('supercontrol/header',$data);
						$this->load->view('supercontrol/showbannerlist',$data);
						$this->load->view('supercontrol/footer');
        			}else{
						 $data['userfile'] = $this->upload->data();
						 $filename=$data['userfile']['file_name'];
						 $data = array(
							'banner_heading' => $this->input->post('banner_heading'),
							'banner_sub_heading' => $this->input->post('banner_sub_heading'),
							'banner_img' => $filename,
							'banner_description' => $this->input->post('banner_description'),
							'status' => 1
						);
						$this->banner_model->insert_banner($data);
            			$upload_data = $this->upload->data();
						$query = $this->banner_model->show_banner();
						$data['ecms'] = $query;
            			$data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>' . $upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
						$this->load->view('supercontrol/header',$data);
						$this->load->view('supercontrol/showbannerlist',$data);
						$this->load->view('supercontrol/footer');
				
					}
				}
		}
		//=======================Insert Page Data============
  		//=======================Insertion Success message=========
		function success(){
			$data['h1title'] = 'Data Inserted Successfully';
			$data['title'] = 'Add banner';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/banneradd_view',$data);
			$this->load->view('supercontrol/footer');
		}
		//=======================Insertion Success message=========	
		
		
		//================Add banner form=============
		function addbanner(){
			
			$data['title'] = "Banner add";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/banneradd_view');
			$this->load->view('supercontrol/footer');
		}
		//================View Individual Data List=============
		
		//================View Individual Data List=============
  		//================Show Individual by Id=================
		function show_banner_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Banner";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/banner_model');
			//Transfering data to Model
			$query = $this->banner_model->show_banner_id($id);
			
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/banner_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
		
		function statusbanner (){
		$stat= $this->input->get('stat'); 
		$id= $this->input->get('id');   
		$this->load->model('supercontrol/banner_model');
		$this->banner_model->updt($stat,$id);
		}
   		//================Show Individual by Id=================
  	 	//================Update Individual ====================
		function edit_banner(){
			
			 //============================================
		 $banner_img = $this->input->post('banner_img');
			  
			 $config = array(
				'upload_path' => "banner/",
				'upload_url' => base_url() . "banner/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				//echo $path = base_url(). "banner/";exit();
				//echo $path1 = "banner/"; 
				@unlink("banner/".$banner_img);
				
				//echo $image_data = $this->upload->data();
				$data['img'] = $this->upload->data();
				//*********************************
				//============================================
				$datalist = array(			
				'banner_heading' => $this->input->post('banner_heading'),
				'banner_img' => $data['img']['file_name'],
				'banner_sub_heading' => $this->input->post('banner_sub_heading'),
				'banner_description' => $this->input->post('description')
				);
				//print_r($datalist); exit();
				$banner_img = $this->input->post('banner_img');
				//====================Post Data===================
				
				$id = $this->input->post('banner_id');
				$data['title'] = "Banner Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/banner_model');
				//Transfering data to Model
				$query = $this->banner_model->banner_edit($id,$datalist,$banner_img);
				$data1['message'] = 'Data Update Successfully';
				$query = $this->banner_model->show_bannerlist();
				$data['ecms'] = $query;
				$data['title'] = "Banner Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showbannerlist', $data1);
				$this->load->view('supercontrol/footer');
				//*********************************
		
			}else{
				$datalist = array(			
				'banner_heading' => $this->input->post('banner_heading'),
				'banner_sub_heading' => $this->input->post('banner_sub_heading'),
				'banner_description' => $this->input->post('description')
				);
			
				
				//====================Post Data===================
				$banner_img = $this->input->post('banner_img');
				$id = $this->input->post('banner_id');
				$data['title'] = "Banner Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/banner_model');
				//Transfering data to Model
				$query = $this->banner_model->banner_edit($id,$datalist,$banner_img);
				$data1['message'] = 'Data Update Successfully';
				$query = $this->banner_model->show_bannerlist();
				$data['ecms'] = $query;
				$data['title'] = "Banner Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showbannerlist', $data1);
				$this->load->view('supercontrol/footer');
			}
			
		}
		//================Update Individual ====================
  		//=======================Update Success message=========
		function successupdate(){
			//loading database
			$this->load->database();
			//Calling Model
			$this->load->model('cms_model');
			//Transfering data to Model
			$query = $this->cms_model->view_cms();
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
			$this->cms_model->delete_cms($id);
			$data1['message'] = 'Data Deleted Successfully';
			redirect('individual/successdelete');
		}
		//======================Delete Individual===============
		
		//======================Show CMS========================
		function showbanner(){
		
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/banner_model');
			//Transfering data to Model
			$query = $this->banner_model->show_banner();
			$data['ecms'] = $query;
			$data['title'] = "BannerList";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showbannerlist');
			$this->load->view('supercontrol/footer');
		
	}
		//======================Show CMS========================
		
		//=====================DELETE BANNER====================

		
			function delete_banner() {
			$id = $this->uri->segment(4);
			$result=$this->banner_model->show_banner_id($id);
			//print_r($result);
			$banner_img = $result[0]->banner_img; 
			//echo $banner_img;exit();
			//Loading Database
			$this->load->database();

			//Transfering data to Model
			$query = $this->banner_model->delete_banner($id,$banner_img);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/banner/showbanner');
			$this->load->view('supercontrol/footer');
		}

		//=====================DELETE BANNER====================
		
		//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('supercontrol/login');
    	}
		//======================Logout==========================
}

?>

