<?php

class Distance extends CI_Controller {

		//============Constructor to call Model====================

		function __construct() {

			parent::__construct();

			$this->load->library(array('form_validation','session'));

			if($this->session->userdata('is_logged_in')!=1){

			redirect('supercontrol/home', 'refresh');

			}

			$this->load->model('supercontrol/distance_model');

			$this->load->database();

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

			redirect('event/event_view');

        }else{

        	$this->load->view('supercontrol/main/login');	

        }

	}

	//*********===============Event Section===============********//

		function adddistanceview(){

			$data['title'] = "Add Distance Booking";

			$this->load->view('supercontrol/header',$data);

			$this->load->view('supercontrol/distanceadd_view',$data);

			$this->load->view('supercontrol/footer');

		}

		//====================Insert Page Data===============

		//====================Insert Distance Booking===============

		//====================Insert Distance Booking===============

		//====================Add Event Type=================

		function add_distance_booking(){

				//=================+++++++++++++++++++++++===================

				$this->form_validation->set_rules('package_name','Package Name', 'required');		

				$this->form_validation->set_rules('price', 'Price', 'required|min_length[1]');

				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

				//===============+++++++++++++++++++++++===================

				if ($this->form_validation->run() == FALSE) {

				
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
	           		$this->load->view('supercontrol/distanceadd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);

				}else{

						 $data = array(
							'course_id' => $this->input->post('course_id'),
							'package_name' => $this->input->post('package_name'),
							'print_material' => $this->input->post('print_material'),
							'online_access' => $this->input->post('online_access'),
							'tutor_support' => $this->input->post('tutor_support'),
							'cirtificates' => $this->input->post('cirtificates'),
							'price' => $this->input->post('price'),
							'add_date' => date('Y-m-d'),
							'status' => '1'
						);

						//print_r($data);

						//exit();

						$this->distance_model->insert_data($data);

						//echo $this->db->last_query();

						//exit();

            			//$upload_data = $this->upload->data();

						$this->session->set_flashdata('success_add', 'Distance Booking Added Successfully !!!!');

						redirect($_SERVER['HTTP_REFERER']);

        			

				}

		}

		//====================Add Event Type=================

		//==================Show Event Type==================

		function showdistancebooking(){
			$data['title'] = "Distance Booking List";
			$courseid = end($this->uri->segment_array());
			$query = $this->distance_model->show_data($courseid);
			$data['distancebooking'] = $query;
			$querycrs = $this->distance_model->show_course_by_id(@$query['0']->course_id);
			$data['coursename'] = @$querycrs['0']->course_name;
			$data['title'] = "Distance Booking  List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showdistancelist',$data);
			$this->load->view('supercontrol/footer');

		}
		function editshowdistancebooking()
		{
			$id = end($this->uri->segment_array());
			$table_name = 'sm_distance_learning';
			$primary_key = 'diatance_id';
			$wheredata = $id;
			$query = $this->distance_model->show_location_id($id);
			$data['slist'] = $query;

			$data['title'] = "Edit Distance Booking Syllabus";
			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/distanceedit_view',$data);
			$this->load->view('supercontrol/footer',$data);
		}

function edit_distance(){
					$id=$this->input->post('id');

				$this->form_validation->set_rules('package_name','Package Name', 'required');		
				$this->form_validation->set_rules('price', 'Price', 'required|min_length[1]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				if ($this->form_validation->run() == FALSE) {
			
				$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
	           		$this->load->view('supercontrol/distanceedit_view',$data);
					$this->load->view('supercontrol/footer');
					

				}else{

						 $data = array(
							'package_name' => $this->input->post('package_name'),
							'print_material' => $this->input->post('print_material'),
							'online_access' => $this->input->post('online_access'),
							'tutor_support' => $this->input->post('tutor_support'),
							'cirtificates' => $this->input->post('cirtificates'),
							'price' => $this->input->post('price')
							
						);
						$this->distance_model->edit_distance($id,$data);
						$this->session->set_flashdata('success_add', 'Distance Booking Updated Successfully !!!!');

						redirect($_SERVER['HTTP_REFERER']);

        			

				}

		}
		//==================Show Event Type==================

		//==================Edit category====================

		function edit_event(){

		//============================================

		 $event_img = $this->input->post('event_image');

			$config = array(

				'upload_path' => "uploads/event/",

				'upload_url' => base_url() . "uploads/event/",

				'allowed_types' => "gif|jpg|png|jpeg"

			);

			$this->load->library('upload', $config);

			if ($this->upload->do_upload("userfile")) {

				//echo $path = base_url(). "banner/";exit();

				//echo $path1 = "banner/"; 

				@unlink("uploads/event/".$event_img);

				

				//echo $image_data = $this->upload->data();

				$data['img'] = $this->upload->data();

				//*********************************

				//============================================

				$datalist = array(			

				//**********************************************

				'event_name' => $this->input->post('event_name'),

				'start_date_time' => date('Y-m-d H:i:s',strtotime($this->input->post('start_date_time'))),

				'end_date_time' => date('Y-m-d H:i:s',strtotime($this->input->post('end_date_time'))),

				'location' => $this->input->post('location'),

				'post_date' => date('Y-m-d H:i:s'),

				'event_description' => $this->input->post('event_description'),

				'event_image' => $data['img']['file_name'],

				'status' => $this->input->post('status')

				//**********************************************

				);

				//print_r($datalist); exit();

				 $event_img = $this->input->post('event_image');

				//====================Post Data===================

				

				$id = $this->input->post('event_id');

				$data['title'] = "Edit Event";

				//loading database

				$this->load->database();

				//Calling Model

				$this->load->model('supercontrol/event_model');

				//Transfering data to Model

				$query = $this->event_model->event_edit($id,$datalist);

				$data1['message'] = 'Data Update Successfully';

				$query = $this->event_model->show_event();

				$data['eevent'] = $query;

				$data['title'] = "Event Page List";

				$this->session->set_flashdata('success_update', 'Event Updated Successfully !!!!');

				redirect('supercontrol/event/showevent',TRUE);

				/*$this->load->view('supercontrol/header',$data);

				$this->load->view('supercontrol/showeventlist', $data1);

				$this->load->view('supercontrol/footer');*/

				//*********************************

		

			}else{

				$datalist = array(			

				//**********************************************

				'event_name' => $this->input->post('event_name'),

				'start_date_time' => date('Y-m-d H:i:s',strtotime($this->input->post('start_date_time'))),

				'end_date_time' => date('Y-m-d H:i:s',strtotime($this->input->post('end_date_time'))),

				'location' => $this->input->post('location'),

				'post_date' => date('Y-m-d H:i:s'),

				'event_description' => $this->input->post('event_description'),

				'status' => $this->input->post('status')

				//**********************************************

				);

				
				$event_img = $this->input->post('event_img');

				$id = $this->input->post('event_id');

				$data['title'] = "Event Edit";

				//loading database

				$this->load->database();



				//Calling Model

				$this->load->model('supercontrol/event_model');

				//Transfering data to Model

				$query = $this->event_model->event_edit($id,$datalist);

				$data1['message'] = 'Data Update Successfully';

				$query = $this->event_model->show_event();

				$data['eevent'] = $query;

				$data['title'] = "Event Page List";

				$this->session->set_flashdata('success_update', 'Event Updated Successfully !!!!');

				redirect('supercontrol/event/showevent',TRUE);

			}

			

		}

		

		//================Show Category By Id================

		function showdistancebookingid($id) {
			$id = $this->uri->segment(4); 
			$data['title'] = "Edit Event Type";
			$query = $this->event_model->show_event_id($id);
			$data['eevent'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/event_edit', $data);
			$this->load->view('supercontrol/footer');
		}


   		//================Show Category By Id================

		//================Delete Category====================	

		function deletedistancebooking($id){
			
			$id = end($this->uri->segment_array());
			$cid=$this->uri->segment(4);

			$result=$this->distance_model->delete_mul($id); 
						$this->session->set_flashdata('delete_message','Distance  Deleted Successfully !!!!');

			redirect('supercontrol/distance/showdistancebooking/'.$cid);

		}

	//*********===============Event Section===============********//

	

	//======================Logout==========================

	function logout(){

		$this->session->unset_userdata('logged_in');

		session_destroy();

		redirect('supercontrol/home', 'refresh');

	}

		//======================Logout==========================

}



?>

