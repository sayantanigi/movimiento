<?php
class Servicedetails extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/servicedetails_model','cat');
			//$this->load->model('location_model','cat');
			$this->load->library('image_lib');
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
						$data['categories'] = $this->cat->category_menu();
						$this->load->view('supercontrol/header',$data);
						$this->load->view('supercontrol/servicedetailsadd_view', $data);
						$this->load->view('supercontrol/footer');
					}else{
						$this->load->view('login');	
				}
			}
				

  //=======================Insert Page Data============
		function add_servicedetails(){
				$config = array(
				'upload_path' => "uploads/servicedet/",
				'upload_url' => base_url() . "uploads/servicedet/",
				'allowed_types' => "gif|jpg|png|jpeg"
				);
				//load upload class library
        		$this->load->library('upload', $config);
			 	if (!$this->upload->do_upload('userfile')){
            			$data['success_msg'] = '<div class="alert alert-success text-center">You Must Select An Image File!</div>';
						$this->load->view('supercontrol/header');
            			$this->load->view('supercontrol/servicedetailsadd_view', $data);
						$this->load->view('supercontrol/footer');
        			}else{
						 $data['userfile'] = $this->upload->data();
						 $filename=$data['userfile']['file_name'];
							$data = array(
							'service_name' => $this->input->post('service_name'),
							'pid' => $this->input->post('pid'),
							'description' => $this->input->post('description'),
							'image' => $filename,
							'status' => 1,
							);
							//print_r($data); exit();
							//Transfering data to Model
							$this->load->model('supercontrol/servicedetails_model');
							$this->servicedetails_model->insert_servicedetails($data);
							$this->load->view('supercontrol/header',$data);
							$data['categories'] = $this->cat->category_menu();
							$data['success_msg'] = '<div class="alert alert-success text-center">Data Added Successfully!</div>';
							$this->load->view('supercontrol/servicedetailsadd_view',$data);
							$this->load->view('supercontrol/footer');
					}
			}
         //=======================Insert Page Data============
  		//=======================Insertion Success message=========
		function success(){
			$data['h1title'] = 'Add Service Details';
			
			$data['success_msg'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Inserted Successfully.....</div>';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/servicedetailsadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
		//=======================Insertion Success message=========	
		//================Add banner form=============
		function addservicedetails(){
			
			$data['title'] = "Service Details Add";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/servicedetailsadd_view');
			$this->load->view('supercontrol/footer');
		}
		//================View Individual Data List=============
		
		//================View Individual Data List=============
  		//================Show Individual by Id=================
		function show_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Service Details";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/servicedetails_model');
			//Transfering data to Model
			$query = $this->servicedetails_model->show_id($id);
			$data['eservdet'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/servicedetails_edit', $data);
			$this->load->view('supercontrol/footer');
		}
    function statusservicedetails ()
		{
	    $stat= $this->input->get('stat'); 
	    $id= $this->input->get('id');   
		$this->load->model('supercontrol/servicedetails_model');
		$this->servicedetails_model->updt($stat,$id);
		}
   		//================Show Individual by Id=================
  	 	//================Update Individual ====================
		function edit_servicedetails(){
			 
			 $image = $this->input->post('image');
			 $config = array(
				'upload_path' => "uploads/servicedet/",
				'upload_url' => base_url() . "uploads/servicedet/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				@unlink("uploads/servicedet/".$image);
				
				//echo $image_data = $this->upload->data();
				$data['userfile'] = $this->upload->data();
				//*********************************
				//============================================
				$datalist = array(			
				'service_name' => $this->input->post('service_name'),
				'description' => $this->input->post('description'),
				'image' => $data['userfile']['file_name'],
				);
				
				$id = $this->input->post('id');
				$data['title'] = "Service Details Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/servicedetails_model');
				//Transfering data to Model
				$query = $this->servicedetails_model->servicedetails_edit($id,$datalist);
				// echo $ddd=$this->db->last_query();
				
				$data1['success_msg1'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Updated Successfully.....</div>';
				$query = $this->servicedetails_model->show_servicedetailslist();
				$data['eserv'] = $query;
				$data['title'] = "Service Details Page List";
				$data1['success_msg1'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Updated Successfully.....</div>';
				$query = $this->servicedetails_model->show_servicedetailsjoin();
				$data['eserv'] = $query;
				$data['title'] = "Service Details Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showservicedetailslist', $data1);
				$this->load->view('supercontrol/footer');
				//*********************************
				
				}else{
				$datalist = array(			
				'service_name' => $this->input->post('service_name'),
				'description' => $this->input->post('description'),
				);
			
				
				$id = $this->input->post('id');
				$data['title'] = "Service Details Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/servicedetails_model');
				//Transfering data to Model
				$query = $this->servicedetails_model->servicedetails_edit($id,$datalist);
				// echo $ddd=$this->db->last_query();
				
				$data1['success_msg1'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Updated Successfully.....</div>';
				$query = $this->servicedetails_model->show_servicedetailslist();
				$data['eserv'] = $query;
				$data['title'] = "Service Details Page List";
				$data1['success_msg1'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Updated Successfully.....</div>';
				$query = $this->servicedetails_model->show_servicedetailsjoin();
				$data['eserv'] = $query;
				$data['title'] = "Service Details Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showservicedetailslist', $data1);
				$this->load->view('supercontrol/footer');
				//*********************************
			}
			}
			
		function show_servicedetails(){
		
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/servicedetails_model');
			//Transfering data to Model
			$query = $this->servicedetails_model->show_servicedetailsjoin();
			$data['eserv'] = $query;
			$data['title'] = "Service Details List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showservicedetailslist');
			$this->load->view('supercontrol/footer');
		
	}
	
	function delete_servicedetails($id){
			//Loading  Database
			$this->load->database();
			$this->load->model('supercontrol/servicedetails_model');
			$id = $this->uri->segment(4); 
			$this->servicedetails_model->delete_servicedetails($id);
			//$data['emember'] = $query; 
			$data1['message'] = 'Data Deleted Successfully'; 
			redirect('supercontrol/servicedetails/successdelete');
		}
		//======================Delete teacher===============
		//======================Delete Success message==========
		function successdelete(){
			//Loading  Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/servicedetails_model');
			//Transfering data to Model
			$query = $this->servicedetails_model->show_servicedetailsjoin();
			$data['eserv'] = $query;
			$data['title'] = "Service Details List";
			$data1['success_msg'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Deleted Successfully.....</div>';
			$datamsg['h1title'] = 'Data Deleted Successfully';
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showservicedetailslist',$data1);
			$this->load->view('supercontrol/footer');
		}
		
		function delete_property_img($id){
			//Loading  Database
			$this->load->database();
			$this->load->model('supercontrol/servicedetails_model');
			$id = $this->uri->segment(4);
			//echo $id; exit();
			$result=$this->servicedetails_model->show_property_multi_image($id); 
			//print_r($result); exit();
			$apartment_image = $result[0]->apartment_image;
			$this->servicedetails_model->delete_property_img($id);
			//$data['emember'] = $query; 
			$data1['message'] = 'Data Deleted Successfully'; 
			redirect('property/successdelete_img');
		}
		//======================Delete teacher===============
		//======================Delete Success message==========
		function successdelete_img(){
			//Loading  Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/servicedetails_model');
			//Transfering data to Model
			$query = $this->servicedetails_model->show_property_multi_image();
			$data['ecms'] = $query;
			$data['title'] = "Property List";
			$data1['success_msg'] = '<div class="alert alert-success text-center"> <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>Data Deleted Successfully.....</div>';
			$datamsg['h1title'] = 'Data Deleted Successfully';
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showpropertylist',$data1);
			$this->load->view('supercontrol/footer');
		}
		//======================Show CMS========================
		
		function addform(){
			$data['title'] = "Add Property ";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/propertyadd_view');
			$this->load->view('supercontrol/footer');
			
			}
		//======================Logout==========================
		
		//=======================Add Bedrooms===================
		function addbedroom_load() {
			$id = $this->uri->segment(4); 
			$data['title'] = "Add Bedroom";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/bedroom_add', $data);
			$this->load->view('supercontrol/footer');
		}
		//=============Add Bedroom==================
		function addbedroom(){
			$id = $this->input->post('property_id');
			$data = array(
				'property_id' => $this->input->post('property_id'),		  
				'bedroom' => $this->input->post('bedroom'),
				'status' => 1
				);
			$this->load->model('supercontrol/servicedetails_model');
			$this->servicedetails_model->insert_bedroom($data);
			$data2['message'] = 'Data Deleted Successfully'; 
			redirect('supercontrol/property/show_property',$data2);
			}
		//=========Property Bedroom View============
		function bedroom_view(){
			$id = $this->uri->segment(4);
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/servicedetails_model');
			//Transfering data to Model
			$query = $this->servicedetails_model->bedroom_view($id);
			$data['viewbedroom'] = $query;
			
			//$query = $this->servicedetails_model->multi_img($id);
			//$data['mulimg'] = $query;

			$data['title'] = "Bedroom View";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showbedroomlist',$data);
			$this->load->view('supercontrol/footer');
		}
		
		function show_bedroom_id(){
			$id = $this->uri->segment(4); 
			$data['title'] = "Edit Bedroom";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/servicedetails_model');
			//Transfering data to Model
			$query = $this->servicedetails_model->show_bedroom_id($id);
			$data['ebdrm'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/bedroom_edit', $data);
			$this->load->view('supercontrol/footer');
			}
			
		function edit_bedroom(){
				$datalist = array(			
				'bedroom' => $this->input->post('bedroom')
				);
				
				$id = $this->input->post('id');
				$propid = $this->input->post('propid');
				$data['title'] = "Bedroom Edit";
				
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/servicedetails_model');
				//Transfering data to Model
				$query = $this->servicedetails_model->bedroom_edit($id,$datalist);
				redirect('supercontrol/property/bedroom_view/'.$propid);
			}
		//===============Delete Bedroom======================
		function delete_bedroom($id){
				$id = $this->uri->segment(4);
				$propid = $this->uri->segment(5);
				//Loading  Database
				$this->load->database();
				$this->load->model('supercontrol/servicedetails_model');
				
				$this->servicedetails_model->delete_bedroom($id);
				//$data['emember'] = $query; 
				$data1['message'] = 'Data Deleted Successfully'; 
				redirect('supercontrol/property/bedroom_view/'.$propid);
				}
		//===========Bedroom Status	Change===================
		function statusbedroom ()
				{
					$stat= $this->input->get('stat'); 
					$id= $this->input->get('id');   
					$this->load->model('supercontrol/servicedetails_model');
					$this->servicedetails_model->updtbdrm($stat,$id);
				}
		//======================Add Bedrooms====================
		function logout()
		{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('supercontrol/home', 'refresh');
		}
		//======================Logout==========================
}

?>
