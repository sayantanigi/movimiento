<?php
class Location extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('generalmodel');
			$this->load->model('supercontrol/location_model');
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
			redirect('supercontrol/locationadd_view');
        }else{
        	$this->load->view('supercontrol/login');	
        }
		
		
	}
//======================Show Add form for location add **** START HERE========================	
function location_add_form(){
	          	$data['title'] = "Add Location";
	          	$user = $this->session->userdata('userid');
	          	$data['categories'] = $this->db->get_where('sm_countrys',array('userid'=>$user))->result();
            	$data['cites'] = $this->generalmodel->getCities();
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/locationadd_view');
				$this->load->view('supercontrol/footer');
     }
//================= For Start Date=========================	 
function start_date_add_form(){
				$data['title'] = "Add Start Date";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/start_date_add_view');
				$this->load->view('supercontrol/footer');
     }
function add_start_date(){
						 $data = array(
							'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
							'loc_id' => $this->input->post('loc_id'),
							'status' => 1
						);
						$this->location_model->insert_start_date($data);
            			$data['title'] = "Location List";
						$this->session->set_flashdata('add_message', 'start date Added successfully!!!!');
						redirect($_SERVER['HTTP_REFERER']);
		}
function start_date_list(){
			$id = $this->uri->segment(4);
			$query = $this->location_model->show_start_date($id);
			$data['ecms'] = $query;
			$data['h1title'] = 'Start Date List';
			$data['title'] = 'Start Date List';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/show_start_date_list',$data);
			$this->load->view('supercontrol/footer');
}
function show_start_date_id($id) {
			$id = $this->uri->segment(4); 
			$data['title'] = "Edit Start Date";
			$query = $this->location_model->show_start_date_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/show_start_date_edit', $data);
			$this->load->view('supercontrol/footer');
		}
function edit_start_date(){
				$datalist = array(			
					'start_date' => date('Y-m-d',strtotime($this->input->post('start_date')))
				);
				$id = $this->input->post('st_id');
				$data['title'] = "Start Date Edit";
				$query = $this->location_model->start_date_edit($id,$datalist);
				$this->session->set_flashdata('add_message', 'Start Date Updated successfully!!');
				redirect($_SERVER['HTTP_REFERER']);
		}
function delete_start_date() {
			$id = $this->uri->segment(4);
			$query = $this->location_model->delete_start_date($id);
			$data['ecms'] = $query;
			$data['title'] = "Start Date";
			$this->session->set_flashdata('delete_message', 'Start Date Deleted successfully!!!!');
			redirect($_SERVER['HTTP_REFERER']);
		}
//================= For End Date =============================
function end_date_add_form(){
				$id = $this->uri->segment(4);
				$query = $this->location_model->show_start_date_id($id);
				$data['ecms'] = $query;
				$data['title'] = "Add End Date";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/end_date_add_view');
				$this->load->view('supercontrol/footer');
     }
function add_end_date(){
						 $data = array(
							'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
							'start_id' => $this->input->post('st_id'),
							//'hour' => $this->input->post('hour'),
							//'per_hour_price' => $this->input->post('per_hour_price'),
							'status' => 1
						);
						$this->location_model->insert_end_date($data);
            			$data['title'] = "Location List";
						$this->session->set_flashdata('add_message', 'end date Added successfully!!!!');
						redirect($_SERVER['HTTP_REFERER']);
		}
function end_date_list(){
			$id = $this->uri->segment(4);
			$query = $this->location_model->show_end_date($id);
			$data['ecms'] = $query;
			$data['h1title'] = 'End Date List';
			$data['title'] = 'End Date List';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/show_end_date_list',$data);
			$this->load->view('supercontrol/footer');
}
function show_end_date_id($id) {
			$last = $this->uri->total_segments();
			$record_num = $this->uri->segment($last);
			$id = $this->uri->segment(4); 
			$data['title'] = "Edit End Date";
			$query = $this->location_model->show_end_date_id($id);
			$data['ecms'] = $query;
			$query = $this->location_model->show_start_date_id($record_num);
			$data['start'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/show_end_date_edit', $data);
			$this->load->view('supercontrol/footer');
		}
function edit_end_date(){
				$datalist = array(			
					'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
					'hour' => $this->input->post('hour'),
					'per_hour_price' => $this->input->post('per_hour_price')
				);
				$id = $this->input->post('st_id');
				$data['title'] = "End Date Edit";
				$query = $this->location_model->end_date_edit($id,$datalist);
				$this->session->set_flashdata('add_message', 'End Date Updated successfully!!');
				redirect($_SERVER['HTTP_REFERER']);
		}
function delete_end_date() {
			$id = $this->uri->segment(4);
			$query = $this->location_model->delete_end_date($id);
			$data['ecms'] = $query;
			$data['title'] = "End Date";
			$this->session->set_flashdata('delete_message', 'End Date Deleted successfully!!!!');
			redirect($_SERVER['HTTP_REFERER']);
		}		
		
//====================== Show Add form for location add ****END HERE========================
		//=======================Insert Page Data============
		function add_location(){
				//=====================+++++++++++++++++++++++===================
				$this->form_validation->set_rules('location_name','Location Name', 'required');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/locationadd_view',$data);
					$this->load->view('supercontrol/footer');
				}else{
						 $data = array(
						'location_name' => $this->input->post('location_name'),
						'location_country_id' => $this->input->post('course_country'),
						'location_city_id' => $this->input->post('city_name'),
						'location_address' => $this->input->post('location_address'),
						'location_telephone_number' => $this->input->post('location_telephone_number'),
						'location_currency' => $this->input->post('location_currency'),
						'location_direction' => $this->input->post('location_direction'),
						'location_opening_hours' => $this->input->post('location_opening_hours'),
						'userid'=>$this->session->userdata('userid')
						);
					//	echo "<pre/>"; print_r($data); exit();
						$this->location_model->insert_location($data);
						//echo $this->db->last_query(); exit();
						$query = $this->location_model->show_location();
						$data['ecms'] = $query;
            			$data['title'] = "Location List";
						$this->session->set_flashdata('add_message', 'Location Added successfully!!!!');
						redirect($_SERVER['HTTP_REFERER']);
				
				}
		}
		//=======================Insert Page Data============

//=======================Insertion Success message for Location *** START HERE=========
		function success(){
			$data['h1title'] = 'Add Location';
			
			$data['title'] = 'Add Location';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/locationadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
//=======================Insertion Success message *** END HERE=========	
//======================Show Location List **** START HERE========================
		public function show_location(){
		//Loading Database
		    $id = $this->uri->segment(4); 
			$this->load->database();
			$user = $this->session->userdata('userid');
			$this->load->model('supercontrol/location_model');
			$query = $this->db->get_where('sm_location',array('userid'=>$user))->result();
			$data['ecms'] = $query;
		//	print_r($data['ecms']);die;
			$data['title'] = "Location List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/footer');
			$this->load->view('supercontrol/showlocationlist');
			
		
	}
//======================Show Location List **** END HERE========================
//======================Status change **** START HERE========================
	function statuslocation ()
		{
			     $stat= $this->input->get('stat'); 
				 $id= $this->input->get('id');   
		$this->load->model('supercontrol/location_model');
		$this->location_model->updt($stat,$id);
		}

//=======================Status change **** END HERE========================	
//================Show Individual by Id for Location *** START HERE=================
		function show_location_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Location";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/location_model');
			//Transfering data to Model
			$query = $this->location_model->show_location_id($id);
			$data['ecms'] = $query;
			$data['categories'] = $this->generalmodel->getCategories();
            	//$data['cites'] = $this->generalmodel->getCities();
            	$data['ecategory'] = $query;
	        $table_name = 'sm_countrys';
			$primary_key = 'country_status';
			$wheredata='1';
			$queryallcat = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
			$data['eallcat'] = $queryallcat;
			//print_r($data['eallcat']);
			$table_name = 'sm_city';
			$primary_key = 'sort_order';
			$wheredata='0';
			$queryallcity = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
			$data['eallcity'] = $queryallcity;
			//print_r($data['eallcity']);die;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/location_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for Location *** END HERE=================
//================Update Individual location***** START HERE ====================
		function edit_location(){
				$datalist = array(			
					'location_name' => $this->input->post('location_name'),
						'location_country_id' => $this->input->post('course_country'),
						'location_city_id' => $this->input->post('city_name'),
						'location_address' => $this->input->post('location_address'),
						'location_telephone_number' => $this->input->post('location_telephone_number'),
						'location_currency' => $this->input->post('location_currency'),
						'location_direction' => $this->input->post('location_direction'),
						'location_opening_hours' => $this->input->post('location_opening_hours')
				);
				//echo "<pre>"; print_r($datalist); exit();
				$id = $this->input->post('id');
				$data['title'] = "Location Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/location_model');
				//Transfering data to Model
				$query = $this->location_model->location_edit($id,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = 'Data Update Successfully';
				$query = $this->location_model->show_locationlist();
				$data['ecms'] = $query;
				$data['title'] = "Location List";
				$this->session->set_flashdata('edit_message', 'Location Updated successfully!!');
				redirect($_SERVER['HTTP_REFERER']);
			
			
		}
//================Update Individual  Location ***** END HERE====================

		//=====================DELETE NEWS====================

		
	function delete_location() {
			$id = $this->uri->segment(4);
			$result=$this->location_model->show_location_id($id);
			//print_r($result);
			$location_image = $result[0]->location_image; 
			//echo $banner_img;exit();
			//Loading Database
			$this->load->database();

			//Transfering data to Model
			$query = $this->location_model->delete_location($id,$location_image);
			$data['ecms'] = $query;
			$data['title'] = "Location List";
			$this->session->set_flashdata('delete_message', 'Location Deleted successfully!!!!');
			redirect($_SERVER['HTTP_REFERER']);
			//redirect('supercontrol/location/show_location');
		}

		//=====================DELETE NEWS====================

		//====================MULTIPLE DELETE=================
		function delete_multiple(){
		$ids = ( explode( ',', $this->input->get_post('ids') ));
		$this->location_model->delete_mul($ids);
		$data['title'] = "Location List";
		$this->session->set_flashdata('delete_message', 'Location Deleted successfully!!!!');
		redirect($_SERVER['HTTP_REFERER']);
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