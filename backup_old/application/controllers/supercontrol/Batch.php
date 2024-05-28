<?php
class Batch extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library(array('form_validation', 'session'));

		$this->load->model('supercontrol/category_model', 'cat');
		$this->load->library('form_validation');
		$this->load->model('generalmodel');
		$this->load->model('supercontrol/instructor_model');
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->library('image_lib');
		if ($this->session->userdata('is_logged_in') != 1) {
			redirect('supercontrol/home', 'refresh');
		}

	}
	function index()
	{
		$data['categories'] = $this->cat->course_menu();
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/courseadd_view', $data);
		$this->load->view('supercontrol/footer');

	}

	function add_batch()
	{
		$table_name = 'sm_course';
		$primary_key = 'course_id !=';
		$wheredata = '0';
		$queryallcat = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['allcat'] = $queryallcat;
		$data['categories'] = $this->generalmodel->getCategories();
		$data['locations'] = $this->generalmodel->getlocations();
		//print_r($data['locations']);die;
		$data['title'] = "Add Batch";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/batchadd_view');
		$this->load->view('supercontrol/footer');
	}

	function add()
	{
		$this->form_validation->set_rules('total_session', 'Total session', 'required');
		$this->form_validation->set_rules('total_hour', 'Total hour', 'required');
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'courseId' => $this->input->post('courseId'),
				'total_session' => $this->input->post('total_session'),
				'total_hour' => $this->input->post('total_hour'),
				'created' => date('Y-m-d H:i:s'),
				'status' => 1
			);
			//print_r($data);die;
			$table_name = 'sm_batch';
			$insertId = $this->generalmodel->insert_data($table_name, $data);
			$date = $this->input->post('date');
			$startTime = $this->input->post('startTime');
			$endTime = $this->input->post('endTime');
			$time_type = $this->input->post('time_type');
			$session_objective = $this->input->post('session_objective');
			$session_location = $this->input->post('session_location');
			$course_country = $this->input->post('course_country');
			$course_city = $this->input->post('course_city');
			$length = count($date);
			for ($i = 0; $i < $length; $i++) {
				$data1 = array(
					'date' => $date[$i],
					'starttime' => $startTime[$i],
					'endtime' => $endTime[$i],
					'time_type' => $time_type[$i],
					'session_objective' => $session_objective[$i],
					'session_location' => $session_location[$i],
					'course_country' => $course_country[$i],
					'course_city' => $course_city[$i],
					'batch_id' => $insertId
				);
				//print_r($data1);die;
				$this->db->insert('sm_course_sessions', $data1);
			}
			$this->load->view('supercontrol/header', $data);
			$this->session->set_flashdata('success', 'Course Time session added Successfully!.');
			redirect('supercontrol/course/show_course', 'refresh');
			$this->load->view('supercontrol/footer');
		} else {

			$this->session->set_flashdata('error', 'Something went Wrong...');
			$table_name = 'sm_course';
			$primary_key = 'course_id !=';
			$wheredata = '0';
			$queryallcat = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
			$data['allcat'] = $queryallcat;
			$data['title'] = "Add Course Time Table";
			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/batchadd_view');
			$this->load->view('supercontrol/footer');

		}
	}

	function add_batch_location()
	{
		$data['batchlist'] = $this->generalmodel->getAllData("sm_batch", "batchId !=", 0, '', '');
		$data['title'] = "Add Location ";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/add_batch_location_view');
		$this->load->view('supercontrol/footer');
	}
	function addLocation()
	{

		$this->form_validation->set_rules('batchId', 'batch Name', 'trim|required');
		$this->form_validation->set_rules('locationAddress', 'address', 'trim|required');
		$this->form_validation->set_rules('start_date', 'start date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'end date', 'trim|required');
		$this->form_validation->set_rules('starttime', 'start time', 'trim|required');
		$this->form_validation->set_rules('endtime', 'end time', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'batchId' => $this->input->post('batchId'),
				'locationAddress' => $this->input->post('locationAddress'),
				'startDate' => date('Y-m-d', strtotime($this->input->post('start_date'))),
				'endDate' => date('Y-m-d', strtotime($this->input->post('end_date'))),
				'startTime' => $this->input->post('starttime'),
				'endTime' => $this->input->post('endtime'),
				'created' => date('Y-m-d H:i:s'),
				'status' => 1
			);

			$table_name = 'sm_batchlocation';

			$this->generalmodel->insert_data($table_name, $data);
			$this->load->view('supercontrol/header', $data);


			$this->session->set_flashdata('success', 'Batch location added Successfully!.');

			redirect('supercontrol/batch/show_batch', 'refresh');

			$this->load->view('supercontrol/footer');

		} else {

			$this->session->set_flashdata('error', 'Something went Wrong...');

			$data['batchlist'] = $this->generalmodel->getAllData("sm_batch", "batchId !=", 0, '', '');
			$data['title'] = "Add Batch";
			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/add_batch_location_view');
			$this->load->view('supercontrol/footer');

		}

	}
	function show_batch_location()
	{
		$bid = $this->uri->segment(4);
		$data['eloca'] = $this->generalmodel->getAllData("sm_batchlocation", "batchId", $bid, "", "");
		$data['title'] = "Batch Wise Location List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showbatchlocationlist', $data);
		$this->load->view('supercontrol/footer');
	}

	function add_instructor()
	{
		$queryinst = $this->instructor_model->show_member();
		$data['inst'] = $queryinst;

		$querycourse = $this->instructor_model->show_course();
		$data['course'] = $querycourse;

		$querymode = $this->instructor_model->show_mode();
		$data['mode'] = $querymode;

		$data['title'] = "Add Instructor";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/instructoradd_view');
		$this->load->view('supercontrol/footer');
	}

	public function add_course_instructor()
	{
		$table_name = 'sm_course_instructor';
		$data = array(
			'course_id' => $this->input->post('course_idd'),
			'instructor_id' => $this->input->post('instructor_id'),
			'mode_id' => $this->input->post('mode_id'),
			'class_date' => date('Y-m-d', strtotime($this->input->post('class_date'))),
			'start_time' => date('H:i:s', strtotime($this->input->post('start_time'))),
			'end_time' => date('H:i:s', strtotime($this->input->post('end_time'))),
			'status' => '1'
		);
		$this->generalmodel->insert_data($table_name, $data);
		$this->session->set_flashdata('success', 'Data Added Successfully');
		redirect($_SERVER['HTTP_REFERER']);
	}

	function success()
	{
		$data['h1title'] = 'Add course';
		$data['title'] = 'Add course';
		$this->load->view('supercontrol/header');
		$this->load->view('supercontrol/courseadd_view', $data);
		$this->load->view('supercontrol/footer');
	}



	function show_batch()
	{

		$table_name = 'sm_batch';
		$primary_key = '';
		$wheredata = '';
		$queryallcat = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');

		$data['eloca'] = $queryallcat;
		$data['title'] = "Batch List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showbatchlist', $data);
		$this->load->view('supercontrol/footer');
	}
	function delete_batch()
	{
		$id = $this->uri->segment(4);
		$table_name = 'sm_batch';
		$fieldname = 'batchId';
		$action = 'delete';
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, '');
		$this->session->set_flashdata('delete_message', 'Batch Deleted Successfully');
		redirect('supercontrol/batch/show_batch', TRUE);
	}
	function view_batch($id)
	{
		$id = $this->uri->segment(4);
		$data['title'] = "View Batch";

		$data['lessdetails'] = $this->generalmodel->fetch_all_join("Select * from sm_batch where batchId='$id'");

		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/batch_view', $data);
		$this->load->view('supercontrol/footer');
	}

	function show_instructor()
	{
		$queryinst = $this->instructor_model->show_instructor();
		$data['inst'] = $queryinst;
		$data['title'] = "course List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showinstructorlist', $data);
		$this->load->view('supercontrol/footer');
	}

	function statusnews()
	{
		$stat = $this->input->get('stat');
		$id = $this->input->get('id');
		$this->load->model('news_model');
		$this->news_model->updt($stat, $id);
	}

	//=============Show Individual by Id for course *** START HERE==============
	function show_course_id($id)
	{
		$id = $this->uri->segment(4);
		$data['title'] = "Edit course";
		$table_name = 'sm_course';
		$primary_key = 'course_id';
		$wheredata = $id;
		$querycourse = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['course'] = $querycourse;
		$table_name = 'sm_category';
		$primary_key = 'parent_id !=';
		$wheredata = '0';
		$queryallcat = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['allcat'] = $queryallcat;
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/course_edit', $data);
		$this->load->view('supercontrol/footer');
	}

	function show_instructor_id($id)
	{
		$id = $this->uri->segment(4);
		$data['title'] = "Edit Instructor";
		$table_name = 'sm_course_instructor';
		$primary_key = 'inst_id';
		$wheredata = $id;
		$querycourse = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['inst'] = $querycourse;

		$querycourse = $this->instructor_model->show_course();
		$data['course'] = $querycourse;

		$querymode = $this->instructor_model->show_mode();
		$data['mode'] = $querymode;

		$queryinst = $this->instructor_model->show_member();
		$data['instr'] = $queryinst;

		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/instructor_edit', $data);
		$this->load->view('supercontrol/footer');
	}

	function edit_instructor()
	{
		$data = array(
			'course_id' => $this->input->post('course_idd'),
			'instructor_id' => $this->input->post('instructor_id'),
			'mode_id' => $this->input->post('mode_id'),
			'class_date' => date('Y-m-d', strtotime($this->input->post('class_date'))),
			'start_time' => date('H:i:s', strtotime($this->input->post('start_time'))),
			'end_time' => date('H:i:s', strtotime($this->input->post('end_time'))),
			'status' => $this->input->post('status')
		);
		//echo "<pre>"; print_r($data); exit();
		$table_name = 'sm_course_instructor';
		$fieldname = 'inst_id';
		$id = $this->input->post('inst_id');
		$action = 'update';
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, $data);
		$data['title'] = "Instructor Edit";
		$this->session->set_flashdata('edit_message', 'Data Updated Successfully !!!');
		redirect('supercontrol/course/show_instructor');
	}

	function view_course($id)
	{
		$id = $this->uri->segment(4);
		$data['title'] = "Edit course";
		//$table_name = 'course_lesion';
		///$primary_key = 'lession_ids';
		//$wheredata="course_id='$id";
		//$querycourse = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
		$data['couserdetails'] = $this->generalmodel->fetch_all_join("Select * from sm_course where course_id='$id'");
		$querycourse = $this->generalmodel->fetch_all_join("Select * from sm_course_lesion where course_id='$id'");
		$data['course'] = $querycourse;
		$table_name = 'sm_category';
		$primary_key = 'parent_id !=';
		$wheredata = '0';
		$queryallcat = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['allcat'] = $queryallcat;
		$booking = $this->generalmodel->fetch_all_join("Select * from sm_course_booking where course_id='$id'");
		$data['allbook'] = $booking;
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/course_view', $data);
		$this->load->view('supercontrol/footer');
	}

	//================Update Individual course***** START HERE ====================
	function edit_course()
	{
		$course_image = $this->input->post('course_image');
		$config = array(
			'upload_path' => "uploads/courseimage/",
			'upload_url' => base_url() . "uploads/courseimage/",
			'allowed_types' => "gif|jpg|png|jpeg"
		);
		$this->load->library('upload', $config);
		if ($this->upload->do_upload("userfile")) {
			@unlink("uploads/courseimage/" . $course_image);
			$data['img'] = $this->upload->data();
			$data = array(
				'course_name' => $this->input->post('course_name'),
				'course_category' => $this->input->post('course_category'),
				'price' => $this->input->post('price'),
				'cpd' => $this->input->post('cpd'),
				'certificate' => $this->input->post('certificate'),
				'entry_requirment' => $this->input->post('entry_requirment'),
				'course_description' => $this->input->post('course_description'),
				'sort_order' => $this->input->post('sort_order'),
				'course_image' => $data['img']['file_name']
			);
			//echo "<pre>"; print_r($data); exit();
		} else {
			$data = array(
				'course_name' => $this->input->post('course_name'),
				'course_category' => $this->input->post('course_category'),
				'price' => $this->input->post('price'),
				'cpd' => $this->input->post('cpd'),
				'certificate' => $this->input->post('certificate'),
				'entry_requirment' => $this->input->post('entry_requirment'),
				'course_description' => $this->input->post('course_description'),
				'sort_order' => $this->input->post('sort_order'),
			);
			//echo "<pre>"; print_r($data); exit();
		}
		$table_name = 'sm_course';
		$fieldname = 'course_id';
		$id = $this->input->post('course_id');
		$action = 'update';
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, $data);
		$data['title'] = "course Edit";
		$this->session->set_flashdata('edit_message', 'Data Updated Successfully !!!');
		redirect('supercontrol/course/show_course');
	}
	//==============Update Individual  course ***** END HERE====================

	//=====================DELETE LOCATION====================
	function delete_course()
	{
		$id = $this->uri->segment(4);
		$table_name = 'sm_course';
		$fieldname = 'course_id';
		$action = 'delete';
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, '');
		$this->session->set_flashdata('delete_message', 'Course Deleted Successfully');
		redirect('supercontrol/course/show_course', TRUE);
	}

	function delete_instructor()
	{
		$id = $this->uri->segment(4);
		$table_name = 'sm_course_instructor';
		$fieldname = 'inst_id';
		$action = 'delete';
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, '');
		$this->session->set_flashdata('delete_message', 'Data Deleted Successfully');
		redirect('supercontrol/course/show_instructor', TRUE);
	}

	//====================MULTIPLE DELETE=================
	function delete_multiple()
	{
		$ids = (explode(',', $this->input->get_post('ids')));
		$this->generalmodel->delete_mul($ids);
		$data4['msg1'] = '<div class="alert alert-success text-center"> Data successfully delete!!!</div>';
		$this->load->view('supercontrol/header');
		redirect('supercontrol/course/show_course', $data4);
		$this->load->view('supercontrol/footer');
	}

	function delete_multiple_inst()
	{
		$ids = (explode(',', $this->input->get_post('ids')));
		$this->instructor_model->delete_mul_inst($ids);
		$data4['msg1'] = '<div class="alert alert-success text-center"> Data successfully delete!!!</div>';
		$this->load->view('supercontrol/header');
		redirect('supercontrol/course/show_instructor', $data4);
		$this->load->view('supercontrol/footer');
	}
	//====================MULTIPLE DELETE=================
//======================Logout==========================
	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('supercontrol/login');
	}
	//======================Logout==========================

	public function add_lesson()
	{
		$course_id = end($this->uri->segment_array());
		$data['title'] = "Add Lesson";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/lessonaddview', $data);
		$this->load->view('supercontrol/footer', $data);
	}

	public function add_course_lesson()
	{
		$table_name = 'course_lesion';
		$data = array(
			'course_id' => $this->input->post('course_id'),
			'type_id' => $this->input->post('course_type'),
			'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
			'start_time' => date('H:i:s', strtotime($this->input->post('start_time'))),
			'end_time' => date('H:i:s', strtotime($this->input->post('end_time')))
		);
		//print_r($data);
//exit();
		$this->generalmodel->insert_data($table_name, $data);
		$this->session->set_flashdata('success', 'Data Added Successfully');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function lesson_list()
	{
		$course_id = end($this->uri->segment_array());
		$table_name = 'sm_course_lesion';
		$primary_key = 'course_id';
		$wheredata = $course_id;
		$queryallcat = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['llist'] = $queryallcat;
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/lessonlist');
		$this->load->view('supercontrol/footer');
	}

	public function delete_lesson()
	{
		$table_name = 'sm_course_lesion';
		$id = end($this->uri->segment_array());
		$fieldname = 'lession_id';
		$action = 'delete';
		$data = '';
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, $data);
		$this->session->set_flashdata('success', 'Data Deleted Successfully');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function edit_lesson()
	{
		$id = end($this->uri->segment_array());
		$table_name = 'sm_course_lesion';
		$primary_key = 'lession_id';
		$wheredata = $id;
		$queryallcat = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['llist'] = $queryallcat;
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/editlesson');
		$this->load->view('supercontrol/footer');
	}

	function update_lesson()
	{
		$lession_id = $this->input->post('lession_id');
		$datalist = array(
			'type_id' => $this->input->post('type_id'),
			'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
			'start_time' => date('H:i:s', strtotime($this->input->post('start_time'))),
			'end_time' => date('H:i:s', strtotime($this->input->post('end_time'))),
			'status' => $this->input->post('status')
		);
		$table_name = 'sm_course_lesion';
		$id = $this->input->post('lession_id');
		$fieldname = 'lession_id';
		$action = 'update';

		//$this->generalmodel->delete_data($table_name,$fieldname,$id);
//$queryallcat = $this->generalmodel->delete_data($table_name,$fieldname,$id);
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, $datalist);

		$this->session->set_flashdata('success', 'Data Updated Successfully !!!');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function add_private()
	{
		$course_id = end($this->uri->segment_array());
		$data['title'] = "Add Private Booking";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/privateaddview', $data);
		$this->load->view('supercontrol/footer', $data);
	}

	public function add_private_booking()
	{
		$this->form_validation->set_rules('price_per_hr', 'Price', 'required');



		$this->form_validation->set_rules('price_whole_course', 'Whole Price', 'required|min_length[1]');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		//===============+++++++++++++++++++++++===================

		if ($this->form_validation->run() == FALSE) {


			$this->load->view('supercontrol/header');
			$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
			//$this->load->view('supercontrol/header');
			//$this->load->view('supercontrol/distanceadd_view',$data);
			//$this->load->view('supercontrol/footer');
			redirect('supercontrol/course/add_private', TRUE);

		} else {
			$table_name = 'private_learning';
			$data = array(
				'course_id' => $this->input->post('course_id'),
				'price_per_hr' => $this->input->post('price_per_hr'),
				'price_whole_course' => $this->input->post('price_whole_course'),
				'add_date' => date('Y-m-d H:i:s'),
			);
			$this->generalmodel->insert_data($table_name, $data);
			$this->session->set_flashdata('success_add', 'Data Added Successfully');
			//redirect($_SERVER['HTTP_REFERER']);
			redirect('supercontrol/course/show_course', TRUE);
		}
	}

	public function view_private()
	{
		$course_id = end($this->uri->segment_array());
		//========================================
		$id = end($this->uri->segment_array());
		$table_name = 'sm_private_learning';
		$primary_key = 'course_id';
		$wheredata = $id;
		$queryallprivate = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['queryallprivate'] = $queryallprivate;
		//===============Course Name=================

		$id = end($this->uri->segment_array());
		$table_name = 'sm_course';
		$primary_key = 'course_id';
		$wheredata = $id;
		$queryallcourse = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['coursename'] = $queryallcourse[0]->course_name;
		//========================================
//===============Course Name=================
		$data['title'] = "Private Booking List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showprivatelist', $data);
		$this->load->view('supercontrol/footer', $data);
	}

	public function show_private_id()
	{
		$id = end($this->uri->segment_array());
		$table_name = 'sm_private_learning';
		$primary_key = 'private_id';
		$wheredata = $id;
		$query = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['plist'] = $query;
		$data['title'] = 'Edit Private Learning';
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/editprivate');
		$this->load->view('supercontrol/footer');
	}

	function update_private()
	{
		$datalist = array(
			'price_per_hr' => $this->input->post('price_per_hr'),
			'price_whole_course' => $this->input->post('price_whole_course'),
		);
		$table_name = 'sm_private_learning';
		$id = $this->input->post('private_id');
		$fieldname = 'private_id';
		$action = 'update';
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, $datalist);

		$this->session->set_flashdata('success', 'Data Updated Successfully !!!');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete_private()
	{
		$id = $this->uri->segment(4);
		$table_name = 'sm_private_learning';
		$fieldname = 'private_id';
		$action = 'delete';
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, '');
		$this->session->set_flashdata('delete_message', 'Private Booking  Deleted Successfully');
		redirect($_SERVER['HTTP_REFERER']);
		//redirect('supercontrol/course/show_course',TRUE);
	}

	public function add_course_syllabus_view()
	{
		$id = end($this->uri->segment_array());
		$data['title'] = "Add Course Syllabus";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/syllabusaddview', $data);
		$this->load->view('supercontrol/footer', $data);
	}

	public function add_course_syllabus()
	{
		$this->load->library('form_validation');
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		// Validation For Address Field
		$this->form_validation->set_rules('syllabus_name', 'Syllabus Title', 'required|min_length[1]|max_length[50]');
		if ($this->form_validation->run() == FALSE) {
			$id = end($this->uri->segment_array());
			$data['title'] = "Add Course Syllabus";
			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/syllabusaddview', $data);
			$this->load->view('supercontrol/footer', $data);
		} else {
			$table_name = 'sm_syllabus';
			$data = array(
				'course_id' => $this->input->post('course_id'),
				'syllabus_name' => $this->input->post('syllabus_name'),
				's_order' => $this->input->post('s_order'),
				'syllabus_content' => $this->input->post('syllabus_content'),
				'status' => '1'
			);
			$this->generalmodel->insert_data($table_name, $data);
			$this->session->set_flashdata('success', 'Data Added Successfully');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function syllabus_list()
	{
		$id = end($this->uri->segment_array());
		$querysyllabus = $this->generalmodel->getAllData('sm_syllabus', 'course_id', $id, '', '');
		$data['syllabuslist'] = $querysyllabus;

		$data['title'] = "Course Syllabus List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showsyllabuslist', $data);
		$this->load->view('supercontrol/footer', $data);
	}

	public function edit_syllabus_view()
	{
		$id = end($this->uri->segment_array());
		$table_name = 'sm_syllabus';
		$primary_key = 'syllabus_id';
		$wheredata = $id;
		$query = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['slist'] = $query;

		$data['title'] = "Edit Course Syllabus";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/editsyllabus', $data);
		$this->load->view('supercontrol/footer', $data);
	}

	public function edit_syllabus()
	{
		$table_name = 'sm_syllabus';
		$id = $this->input->post('syllabus_id');
		$fieldname = 'syllabus_id';
		$action = 'update';
		$datalist = array(
			'syllabus_name' => $this->input->post('syllabus_name'),
			's_order' => $this->input->post('s_order'),
			'syllabus_content' => $this->input->post('syllabus_content'),
			'status' => $this->input->post('status')
		);
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, $datalist);
		$this->session->set_flashdata('success', 'Data Updated Successfully !!!');
		redirect('supercontrol/course/syllabus_list/' . $this->input->post('course_id') . '', 'refresh');
	}

	public function delete_syllabus()
	{
		$id = end($this->uri->segment_array());
		$this->generalmodel->show_data_id('sm_syllabus', $id, 'syllabus_id', 'delete', '');
		$this->session->set_flashdata('success', 'Data Deleted Successfully');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function edit()
	{

		$batch_id = $this->input->post('batch_id');
		$this->generalmodel->show_data_id('sm_course_sessions', $batch_id, 'batch_id', 'delete', '');
		//echo $this->db->last_query();

		$table_name = 'sm_batch';
		$id = $this->input->post('batch_id');
		$fieldname = 'batchId';

		$action = 'update';
		$datalist = array(

			'courseId' => $this->input->post('courseId'),
			'total_session' => $this->input->post('total_session'),
			'total_hour' => $this->input->post('total_hour'),
			'created' => date('Y-m-d H:i:s'),
			'status' => 1
		);
		//print_r($datalist);
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, $datalist);
		$batchId = $this->input->post('batch_id');
		$date = $this->input->post('date');
		$startTime = $this->input->post('startTime');
		$endTime = $this->input->post('endTime');
		$time_type = $this->input->post('time_type');
		$session_objective = $this->input->post('session_objective');
		$session_location = $this->input->post('session_location');
		$course_country = $this->input->post('course_country');
		$course_city = $this->input->post('course_city');
		$length = count($date);
		for ($i = 0; $i < $length; $i++) {
			$data1 = array(
				'date' => $date[$i],
				'starttime' => $startTime[$i],
				'endtime' => $endTime[$i],
				'time_type' => $time_type[$i],
				'session_objective' => $session_objective[$i],
				'session_location' => $session_location[$i],
				'course_country' => $course_country[$i],
				'course_city' => $course_city[$i],
				'batch_id' => $batchId
			);
			//print_r($data1);die;
			$this->db->insert('sm_course_sessions', $data1);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

}
?>