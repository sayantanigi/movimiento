<?php
class Gallery extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/gallery_model');
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
			redirect('supercontrol/galleryadd_view');
        }else{
        	$this->load->view('supercontrol/main/login');	
        }
	}
  //=======================Insert Page Data============
		function add_gallery(){
			$my_date = date("Y-m-d", time()); 
			 $config = array(
				'upload_path' => "gallery/",
				'upload_url' => base_url() . "gallery/",
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
					'gallery_name' => $this->input->post('gallery_name'),
					'gallery_image' => $data['img']['file_name'],
					'gallery_status' => 1,
					'date' =>  $my_date
				);
				//Transfering data to Model
				$this->gallery_model->insert_gallery($data);
				$data1['message'] = 'Data Inserted Successfully';
				redirect('supercontrol/gallery/success');
			 }
			 else{
				   	$data = array(
					'gallery_name' => $this->input->post('gallery_name'),
					'gallery_image' => $data['img']['file_name'],
					'gallery_status' => 1,
					'date' =>  $my_date
				);
				//Transfering data to Model
				$this->gallery_model->insert_gallery($data);
				$data1['message'] = 'Data Inserted Successfully';
				redirect('supercontrol/gallery/success');
			}
		}
         //=======================Insert Page Data============
  		//=======================Insertion Success message=========
		function success(){
			$data['h1title'] = 'Add Gallery';
			
			$data['success_msg'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Inserted Successfully.....</div>';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/galleryadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
		//=======================Insertion Success message=========	
		//================Add banner form=============
		function addgallery(){
			
			$data['title'] = "Gallery add";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/galleryadd_view');
			$this->load->view('supercontrol/footer');
		}
		//================View Individual Data List=============
		
		//================View Individual Data List=============
  		//================Show Individual by Id=================
		function show_gallery_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Gallery";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/gallery_model');
			//Transfering data to Model
			$query = $this->gallery_model->show_gallery_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/gallery_edit', $data);
			$this->load->view('supercontrol/footer');
		}
    function statusgallery ()
		{
			     $stat= $this->input->get('stat'); 
				 $id= $this->input->get('id');   
		$this->load->model('supercontrol/gallery_model');
		$this->gallery_model->updt($stat,$id);
		}
   		//================Show Individual by Id=================
  	 	//================Update Individual ====================
		function edit_gallery(){
			 //echo $id= $_GET['id'];
			 //exit();
			 //============================================
			 $config = array(
				'upload_path' => "gallery/",
				'upload_url' => base_url() . "gallery/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				
				//echo $image_data = $this->upload->data();
				$data['img'] = $this->upload->data();
			 	//echo $data['img']['file_name'];
				//exit();
				//*********************************
				//============================================
				
				$datalist = array(			
				'gallery_name' => $this->input->post('gallery_name'),
				'gallery_image' => $data['img']['file_name']
				
				);
				$old_file = $this->input->post('old_file');
				$id = $this->input->post('gallery_id');
				$data['title'] = "Gallery Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/gallery_model');
				//Transfering data to Model
				$query = $this->gallery_model->gallery_edit($id,$datalist,$old_file);
				// echo $ddd=$this->db->last_query();
				
				$data1['success_msg1'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Updated Successfully.....</div>';
				$query = $this->gallery_model->show_gallerylist();
				$data['ecms'] = $query;
				$data['title'] = "Gallery Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showgallerylist', $data1);
				$this->load->view('supercontrol/footer');
				//*********************************
		
			}else{
				$datalist = array(			
				'gallery_name' => $this->input->post('gallery_name')
				
				);
				//echo $gallery_name=$_POST['gallery_name'];
				//echo $ddd=$this->db->last_query();
				//print_r($datalist);
				//exit();
				//====================Post Data===================
				$old_file = $this->input->post('gallery_image');
				$id = $this->input->post('gallery_id');
				$data['title'] = "Gallery Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/gallery_model');
				//Transfering data to Model
				$query = $this->gallery_model->gallery_edit($id,$datalist,$old_file);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['success_msg1'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Updated Successfully.....</div>';
				$query = $this->gallery_model->show_gallerylist();
				$data['ecms'] = $query;
				$data['title'] = "Gallery Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showgallerylist', $data1);
				$this->load->view('supercontrol/footer');
			}
			
		}
		//================Update Individual ====================
      //======================Show CMS========================
		function show_gallery(){
		
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/gallery_model');
			//Transfering data to Model
			$query = $this->gallery_model->show_gallery();
			$data['ecms'] = $query;
			$data['title'] = "Gallery List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showgallerylist');
			$this->load->view('supercontrol/footer');
		
	}
	
	function delete_gallery($id){
			//Loading  Database
			$this->load->database();
			$this->load->model('supercontrol/gallery_model');
			////echo $id;
			//exit();
			//Transfering data to Model
			$id = $this->uri->segment(4);
			//echo $id; exit();
			$result=$this->gallery_model->gallery_view($id); 
			//print_r($result); exit();
			$gallery_image = $result[0]->gallery_image;
			$this->gallery_model->delete_gallery($id,$gallery_image);
			//$data['emember'] = $query; 
			//echo $this->db->last_query(); exit();
			$data1['message'] = 'Data Deleted Successfully'; 
			redirect('supercontrol/gallery/successdelete');
		}
		//======================Delete teacher===============
		//======================Delete Success message==========
		function successdelete(){
			//Loading  Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/gallery_model');
			//Transfering data to Model
			$query = $this->gallery_model->show_gallery();
			$data['ecms'] = $query;
			$data['title'] = "Gallery List";
			$data1['success_msg'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Deleted Successfully.....</div>';
			$datamsg['h1title'] = 'Data Deleted Successfully';
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showgallerylist',$data1);
			$this->load->view('supercontrol/footer');
		}
		//======================Show CMS========================
		
		function addform(){
			$data['title'] = "Add Gallery ";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/galleryadd_view');
			$this->load->view('supercontrol/footer');
			
			}
		//======================Logout==========================
		function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('supercontrol/home', 'refresh');
 }
		//======================Logout==========================
}

?>
