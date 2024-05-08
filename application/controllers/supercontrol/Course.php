<?php
ob_start();
error_reporting(0);
class Course extends CI_Controller {
	function __construct() {
		parent::__construct();
		//$this->load->model('coursemodel', 'cat');
		$this->load->helper('form');
		$this->load->library(array('form_validation', 'session'));
		/*if ($this->session->userdata('is_logged_in') != 1) {
			redirect('supercontrol/home', 'refresh');
		}*/
		$this->load->model('supercontrol/category_model', 'cat');
		$this->load->library('form_validation');
		$this->load->model('generalmodel');
		$this->load->model('supercontrol/instructor_model');
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->library('image_lib');

	}
	function index() {
		//print_r($this->session->userdata()); die;
		$data['categories'] = $this->cat->course_menu();
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/courseadd_view', $data);
		$this->load->view('supercontrol/footer');
	}
	function add_course() {
		$table_name = 'sm_category';
		$primary_key = 'id !=';
		$wheredata = '0';
		$queryallcat = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['allcat'] = $queryallcat;
		$data['levels'] = $this->generalmodel->getAllData('sm_levels', 'level_status =', '1', '', '');
		$data['modes'] = $this->generalmodel->getAllData('sm_mode', 'mode_status =', '1', '', '');
		//$data['categories'] = $this->generalmodel->getCategories();
		//$data['modes'] = $this->generalmodel->getMode();
		//$data['cites'] = $this->generalmodel->getCities();
		//$data['levels'] = $this->generalmodel->getlevel();
		//$data['locations'] = $this->generalmodel->getlocations();
		//$data['country'] = $this->db->get('na_country')->result();
		$data['title'] = "Add course";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/courseadd_view');
		$this->load->view('supercontrol/footer');
	}
	function add_my_course() {
		$my_date = date("Y-m-d", time());
		$config = array(
			'upload_path' => "./assets/images/courses/",
			'upload_url' => base_url() . "./assets/images/courses/",
			'allowed_types' => "gif|jpg|png|jpeg"
		);
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('userfile')) {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'cat_id' => $this->input->post('cat_id'),
				'mode_id' => $this->input->post('mode_id'),
				'level_id' => $this->input->post('level_id'),
				'title' => $this->input->post('title'),
				'heading_1' => $this->input->post('heading_1'),
				'heading_2' => $this->input->post('heading_2'),
				'description' => $this->input->post('description'),
				'program_overview' => $this->input->post('program_overview'),
				'objectives' => $this->input->post('objectives'),
				'curriculam' => $this->input->post('curriculam'),
				'career_paths' => $this->input->post('career_paths'),
				'duration' => $this->input->post('duration'),
				'course_fees' => $this->input->post('course_fees'),
				'price' => $this->input->post('price'),
				'price_key' => $this->input->post('price_key'),
				'course_type' => $this->input->post('course_type'),
				'course_certificate' => $this->input->post('course_certificate'),
				'requirement' => $this->input->post('requirement'),
				'attended' => $this->input->post('attended'),
				'status' => $this->input->post('status'),
				'created_at' => date('Y-m-d H:i:s'),
				'assigned_instrustor' => $this->session->userdata('user_id'),
			);
			//print_r($data); die;
			$table_name = 'courses';
			$insertId = $this->generalmodel->insert_data($table_name, $data);
			$this->load->view('supercontrol/header', $data);
			$data['success_msg'] = '<div class="alert alert-success text-center">Data Added Successfully!</div>';
			redirect('supercontrol/course/show_all_courses', 'refresh');
			$this->load->view('supercontrol/footer');
		} else {
			$data['userfile'] = $this->upload->data();
			$filename = $data['userfile']['file_name'];
			$table_name = 'courses';
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'cat_id' => $this->input->post('cat_id'),
				'mode_id' => $this->input->post('mode_id'),
				'level_id' => $this->input->post('level_id'),
				'title' => $this->input->post('title'),
				'heading_1' => $this->input->post('heading_1'),
				'heading_2' => $this->input->post('heading_2'),
				'description' => $this->input->post('description'),
				'program_overview' => $this->input->post('program_overview'),
				'objectives' => $this->input->post('objectives'),
				'curriculam' => $this->input->post('curriculam'),
				'career_paths' => $this->input->post('career_paths'),
				'duration' => $this->input->post('duration'),
				'course_fees' => $this->input->post('course_fees'),
				'price' => $this->input->post('price'),
				'price_key' => $this->input->post('price_key'),
				'course_type' => $this->input->post('course_type'),
				'course_certificate' => $this->input->post('course_certificate'),
				'requirement' => $this->input->post('requirement'),
				'attended' => $this->input->post('attended'),
				'status' => $this->input->post('status'),
				'image' => $filename,
				'created_at' => date('Y-m-d H:i:s'),
			);
			//print_r($data); die;
			$this->generalmodel->insert_data($table_name, $data);
			$table_name = 'courses';
			$this->load->view('supercontrol/header', $data);
			$data['success_msg'] = '<div class="alert alert-success text-center">Data Added Successfully!</div>';
			redirect('supercontrol/course/show_all_courses', 'refresh');
			$this->load->view('supercontrol/footer');
		}
	}
	function add_instructor() {
		$queryinst = $this->instructor_model->show_member();
		$data['inst'] = $queryinst;
		$querycourse = $this->instructor_model->show_course();
		$data['course'] = $querycourse;
		$querymode = $this->instructor_model->show_mode();
		$data['mode'] = $querymode;
		//echo $this->db->last_query();
		$data['title'] = "Add Instructor";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/instructoradd_view');
		$this->load->view('supercontrol/footer');
	}
	public function add_course_instructor() {
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
		//echo "<pre>"; print_r($data); exit();
		$this->generalmodel->insert_data($table_name, $data);
		$this->session->set_flashdata('success', 'Data Added Successfully');
		redirect($_SERVER['HTTP_REFERER']);
	}
	function success() {
		$data['h1title'] = 'Add course';
		$data['title'] = 'Add course';
		$this->load->view('supercontrol/header');
		$this->load->view('supercontrol/courseadd_view', $data);
		$this->load->view('supercontrol/footer');
	}
	function show_all_courses() {
		$user = $this->session->userdata('user_id');
		$queryallcat = $this->db->get_where('courses', array('user_id' => $user, 'status' => '1'))->result();
		$data['eloca'] = $queryallcat;
		$data['title'] = "course List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showallcourselist', $data);
		$this->load->view('supercontrol/footer');
	}
	function upcomming_course() {
		/*$table_name = 'sm_course';
		$primary_key = 'course_type';*/
		$wheredata = 'Upcoming Courses';
		//$queryallcat = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
		$user = $this->session->userdata('user_id');
		$queryallcat = $this->db->get_where('courses', array('course_type' => $wheredata, 'user_id' => $user, 'status' => '1'))->result();
		$data['eloca'] = $queryallcat;
		$data['title'] = "course List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showupcomingcourselist', $data);
		$this->load->view('supercontrol/footer');
	}
	function comingsoon_course() {
		//$table_name = 'courses';
		//$primary_key = 'course_type';
		$wheredata = 'Coming Soon Courses';
		$user = $this->session->userdata('user_id');
		//$queryallcats = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
		$queryallcats = $this->db->get_where('courses', array('course_type' => $wheredata, 'user_id' => $user))->result();
		$data['elocal'] = $queryallcats;
		$data['title'] = "course List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showcomingcourselist', $data);
		//$this->load->view('supercontrol/showcourselist', $data);
		$this->load->view('supercontrol/footer');
	}
	function show_batch() {
		$table_name = 'sm_batch';
		$primary_key = 'batchId';
		$wheredata = '';
		$queryallcat = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['eloca'] = $queryallcat;
		$data['title'] = "Batch List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showbatchlist', $data);
		$this->load->view('supercontrol/footer');
	}
	function delete_batch() {
		$id = $this->uri->segment(4);
		$table_name = 'sm_course_lesion';
		$fieldname = 'lession_id';
		$action = 'delete';
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, '');
		$this->session->set_flashdata('delete_message', 'Batch Deleted Successfully');
		redirect('supercontrol/course/show_batch', TRUE);
	}
	function view_batch($id) {
		$id = $this->uri->segment(4);
		$data['title'] = "View Batch";
		$data['lessdetails'] = $this->generalmodel->fetch_all_join("Select * from sm_course_lesion where lession_id='$id'");
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/batch_view', $data);
		$this->load->view('supercontrol/footer');
	}
	function show_instructor() {
		$queryinst = $this->instructor_model->show_instructor();
		$data['inst'] = $queryinst;
		$data['title'] = "course List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showinstructorlist', $data);
		$this->load->view('supercontrol/footer');
	}
	function statusnews() {
		$stat = $this->input->get('stat');
		$id = $this->input->get('id');
		$this->load->model('news_model');
		$this->news_model->updt($stat, $id);
	}
	function show_course_id($id) {
		$id = $this->uri->segment(4);
		$data['title'] = "Edit course";
		$table_name = 'courses';
		$primary_key = 'id';
		$wheredata = $id;
		$querycourse = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['course'] = $querycourse;
		$table_name = 'sm_category';
		$primary_key = 'id !=';
		$wheredata = '0';
		//$data['categories'] = $this->generalmodel->getCategories();
		//$data['cites'] = $this->generalmodel->getCities();
		//$data['cites'] = $this->generalmodel->getCites();
		$data['levels'] = $this->generalmodel->getlevel();
		$data['modes'] = $this->generalmodel->getMode();
		$queryallcat = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['allcat'] = $queryallcat;
		$table_name = 'sm_mode';
		$primary_key = 'mode_status';
		$wheredata = '1';
		$queryallmode = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['eallmode'] = $queryallmode;
		//print_r($data['eallcat']);die;
		$table_name = 'sm_levels';
		$primary_key = 'level_status';
		$wheredata = '1';
		$queryalllevel = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['ealllevel'] = $queryalllevel;
		//print_r($data['eallcat']);die;
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/course_edit', $data);
		$this->load->view('supercontrol/footer');
	}
	function show_instructor_id($id) {
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
	function edit_instructor() {
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
	function view_course($id) {
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit course";
		//$table_name = 'course_lesion';
		///$primary_key = 'lession_ids';
		//$wheredata="course_id='$id";
		//$querycourse = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
		$data['couserdetails'] = $this->generalmodel->fetch_all_join("SELECT * FROM courses WHERE id='$id'");
		$querycourse = $this->generalmodel->fetch_all_join("SELECT * FROM course_modules WHERE course_id='$id'");
		$data['course'] = $querycourse;
		$table_name = 'sm_category';
		$primary_key = 'id !=';
		$wheredata = '0';
		$queryallcat = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$data['allcat'] = $queryallcat;
		$booking = $this->generalmodel->fetch_all_join("Select * from course_enrollment where course_id='$id'");
		$data['allbook'] = $booking;
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/course_view', $data);
		$this->load->view('supercontrol/footer');
	}
	function edit_course($id) {
		if(!empty($_FILES['userfile']['name'])) {
			$config['upload_path'] = 'assets/images/courses';
			$config['allowed_types'] = '*';
			$config['max_size'] = '*';
			$config['overwrite'] = false;
			$config['remove_spaces'] = TRUE;
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('userfile')) {
				$error = array('error' => $this->upload->display_errors());
				$msg = '["' . $error['error'] . '", "error", "#e50914"]';
			} else {
				$fileData = $this->upload->data();
				$filename1 = $fileData['file_name'];
			}
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'cat_id' => $this->input->post('cat_id'),
				'mode_id' => $this->input->post('mode_id'),
				'level_id' => $this->input->post('level_id'),
				'title' => $this->input->post('title'),
				'heading_1' => $this->input->post('heading_1'),
				'heading_2' => $this->input->post('heading_2'),
				'description' => $this->input->post('description'),
				'program_overview' => $this->input->post('program_overview'),
				'objectives' => $this->input->post('objectives'),
				'curriculam' => $this->input->post('curriculam'),
				'career_paths' => $this->input->post('career_paths'),
				'duration' => $this->input->post('duration'),
				'course_fees' => $this->input->post('course_fees'),
				'price' => $this->input->post('price'),
				'price_key' => $this->input->post('price_key'),
				'course_type' => $this->input->post('course_type'),
				'course_certificate' => $this->input->post('course_certificate'),
				'requirement' => $this->input->post('requirement'),
				'attended' => $this->input->post('attended'),
				'status' => $this->input->post('status'),
				'image' => $filename1
			);
			//echo "<pre>"; print_r($_FILES['userfile']['name']); echo "<br>"; print_r($data); die();
			$table_name = 'courses';
			$fieldname = 'id';
			$action = 'update';
			$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, $data);
		} else {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'cat_id' => $this->input->post('cat_id'),
				'mode_id' => $this->input->post('mode_id'),
				'level_id' => $this->input->post('level_id'),
				'title' => $this->input->post('title'),
				'heading_1' => $this->input->post('heading_1'),
				'heading_2' => $this->input->post('heading_2'),
				'description' => $this->input->post('description'),
				'program_overview' => $this->input->post('program_overview'),
				'objectives' => $this->input->post('objectives'),
				'curriculam' => $this->input->post('curriculam'),
				'career_paths' => $this->input->post('career_paths'),
				'duration' => $this->input->post('duration'),
				'course_fees' => $this->input->post('course_fees'),
				'price' => $this->input->post('price'),
				'price_key' => $this->input->post('price_key'),
				'course_type' => $this->input->post('course_type'),
				'course_certificate' => $this->input->post('course_certificate'),
				'requirement' => $this->input->post('requirement'),
				'attended' => $this->input->post('attended'),
				'status' => $this->input->post('status')
			);
			$table_name = 'courses';
			$fieldname = 'id';
			$action = 'update';
			$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, $data);
		}
		//$data['title'] = "course Edit";
		$this->session->set_flashdata('edit_message', 'Data Updated Successfully !!!');
		redirect('supercontrol/course/show_all_courses');
	}
	function delete_course() {
		$id = $this->uri->segment(4);
		$table_name = 'sm_course';
		$fieldname = 'course_id';
		$action = 'delete';
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, '');
		$this->session->set_flashdata('delete_message', 'Course Deleted Successfully');
		redirect('supercontrol/course/show_all_courses', TRUE);
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
	function delete_multiple()
	{
		$ids = (explode(',', $this->input->get_post('ids')));
		$this->generalmodel->delete_mul($ids);
		$data4['msg1'] = '<div class="alert alert-success text-center"> Data successfully delete!!!</div>';
		$this->load->view('supercontrol/header');
		redirect('supercontrol/course/show_all_courses', $data4);
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
		$table_name = 'sm_course_lesion';
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
			$table_name = 'sm_private_learning';
			$data = array(
				'course_id' => $this->input->post('course_id'),
				'price_per_hr' => $this->input->post('price_per_hr'),
				'price_whole_course' => $this->input->post('price_whole_course'),
				'add_date' => date('Y-m-d H:i:s'),
			);
			$this->generalmodel->insert_data($table_name, $data);
			$this->session->set_flashdata('success_add', 'Data Added Successfully');
			//redirect($_SERVER['HTTP_REFERER']);
			redirect('supercontrol/course/show_all_courses', TRUE);
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
		//redirect('supercontrol/course/show_all_courses',TRUE);
	}

	public function add_course_module_view($id) {
		$data = array(
			'title' => "Add Course Module",
			'id' => $id
		);
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/syllabusaddview', $data);
		$this->load->view('supercontrol/footer', $data);
	}

	public function add_course_module() {
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('name', 'Module Name', 'required|min_length[1]|max_length[50]');
		if ($this->form_validation->run()) {
			if ($_FILES['module_image']['name'] != '') {
                $config['upload_path'] = './uploads/modules/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
                $config['max_size'] = '*';
                $config['overwrite'] = false;
                $config['remove_spaces'] = TRUE;  //it will remove all spaces
                $config['encrypt_name'] = TRUE;   //it wil encrypte the original file name
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('module_image')) {
                    $error = array('error' => $this->upload->display_errors());
                    $msg = '["' . $error['error'] . '", "error", "#e50914"]';
                } else {
                    $fileData = $this->upload->data();
                    $module_image = $fileData['file_name'];
                }
				$data = array(
					'user_id' => $this->session->userdata('user_id'),
					'course_id' => $this->input->post('course_id'),
					'name' => $this->input->post('name'),
					'module_image' => $module_image,
					'module_descriptions' => $this->input->post('module_descriptions'),
					'status' => $this->input->post('status'),
					'created_at' => date("Y-m-d H:i:s")
				);
				$this->generalmodel->insert_data('course_modules', $data);
            } else {
				$data = array(
					'user_id' => $this->session->userdata('user_id'),
					'course_id' => $this->input->post('course_id'),
					'name' => $this->input->post('name'),
					'module_descriptions' => $this->input->post('module_descriptions'),
					'status' => $this->input->post('status'),
					'created_at' => date("Y-m-d H:i:s")
				);
				$this->generalmodel->insert_data('course_modules', $data);
			}
			redirect('supercontrol/course/module_list/' . $this->input->post('course_id') . '', 'refresh');
		}
	}

	public function module_list($id) {
		$querysyllabus = $this->generalmodel->getAllData('course_modules', 'course_id', $id, '', '');
		$data['syllabuslist'] = $querysyllabus;
		$data['title'] = "Course Syllabus List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showsyllabuslist', $data);
		$this->load->view('supercontrol/footer', $data);
	}
	public function change_module_status($course_id, $id) {
        if ($course_id && $id) {
            $checkStatus = $this->db->query("SELECT * FROM course_modules WHERE id = '".$id."' AND course_id = '".$course_id."'")->result_array();
            if($checkStatus[0]['status'] == '0' || empty($checkStatus[0]['status'])) {
                $this->db->query("UPDATE course_modules SET status = '1' WHERE id = '".$id."' AND course_id = '".$course_id."'");
            } else {
                $this->db->query("UPDATE course_modules SET status = '0' WHERE id = '".$id."' AND course_id = '".$course_id."'");
            }
            //echo $this->db->last_query(); die();
            $this->session->set_flashdata('success', 'Status changed successfully!');
        } else {
            $this->session->set_flashdata('error', 'Sorry, Status is not changed!');
        }
        redirect('supercontrol/course/module_list/'.$course_id.'', 'refresh');
    }
	public function edit_module_view($course_id, $id) {
		$query = $this->generalmodel->getAllData('course_modules', 'id', $id, '', '');
		$data['slist'] = $query;
		$data['title'] = "Edit Course Module";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/editsyllabus', $data);
		$this->load->view('supercontrol/footer', $data);
	}
	public function edit_module() {
		$old_image = $this->input->post('old_image');
		if ($_FILES['module_image']['name'] != '') {
			$config['upload_path'] = './uploads/modules/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
			$config['max_size'] = '*';
			$config['overwrite'] = false;
			$config['remove_spaces'] = TRUE;  //it will remove all spaces
			$config['encrypt_name'] = TRUE;   //it wil encrypte the original file name
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('module_image')) {
				$error = array('error' => $this->upload->display_errors());
				$msg = '["' . $error['error'] . '", "error", "#e50914"]';
			} else {
				// Uploaded file data 
				$fileData = $this->upload->data();
				$module_image = $fileData['file_name'];
			}
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'course_id' => $this->input->post('course_id'),
				'name' => $this->input->post('name'),
				'module_image' => $module_image,
				'module_descriptions' => $this->input->post('module_descriptions'),
				'status' => $this->input->post('status'),
				'created_at' => date("Y-m-d H:i:s")
			);
			$this->db->update('course_modules', $data, array('id' => $this->input->post('module_id')));
		} else {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'course_id' => $this->input->post('course_id'),
				'name' => $this->input->post('name'),
				'module_descriptions' => $this->input->post('module_descriptions'),
				'status' => $this->input->post('status'),
				'created_at' => date("Y-m-d H:i:s")
			);
			$this->db->update('course_modules', $data, array('id' => $this->input->post('module_id')));
		}
		if ($old_image && $_FILES['module_image']['name'] != '') {
			if (file_exists('./uploads/modules/' . $old_image)) {
				@unlink('./uploads/modules/' . $old_image);
			}
		}
		$this->session->set_flashdata("success", "Module Updated");
		redirect('supercontrol/course/module_list/' . $this->input->post('course_id'));
	}

	public function delete_syllabus()
	{
		$id = end($this->uri->segment_array());
		$this->generalmodel->show_data_id('sm_syllabus', $id, 'syllabus_id', 'delete', '');
		$this->session->set_flashdata('success', 'Data Deleted Successfully');
		redirect('supercontrol/course/syllabus_list/',TRUE);
	}

	function add_course_clone1($id)
	{
		$id = end($this->uri->segment_array());
		$table_name = 'sm_course';
		$primary_key = 'course_id';
		$wheredata = $id;
		$queryallcourse = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');

		$queryallcourse = $this->db->get($table_name);

		foreach ($queryallcourse->result() as $row) {
			foreach ($row as $key => $val) {
				if ($key != $primary_key) {

					$this->db->set($key, $val);
				} //endif              
			} //endforeach
		} //endforeach

		return $this->db->insert($table_name);
	}

	function add_course_clone($id)
	{
		$sql = "INSERT INTO sm_course (	course_name, course_category, course_country, course_city, price, add_date, course_description, course_image, status, certificate, entry_requirment, who_should_apply, course_startDate, course_endDate, course_mode, course_level, course_type) SELECT course_name, course_category, course_country, course_city, price, add_date, course_description, course_image, status, certificate, entry_requirment, who_should_apply, course_startDate, course_endDate, course_mode, course_level, course_type FROM sm_course WHERE course_id = " . $id;
		$res = $this->db->query($sql);
		$ide = $this->db->insert_id();

		$sql2 = "INSERT INTO sm_syllabus ( course_id, syllabus_name, syllabus_content, s_order, status ) SELECT " . $ide . ", syllabus_name, syllabus_content, s_order, status FROM sm_syllabus WHERE course_id = " . $id;
		$this->db->query($sql2);

		$sql1 = "INSERT INTO sm_batch ( courseId, total_hour, total_session,created,status ) SELECT " . $ide . ",  total_hour, total_session ,created,status FROM sm_batch WHERE courseId = " . $id;
		$this->db->query($sql1);
		$query = $this->db->query("SELECT batchId FROM sm_batch WHERE courseId = " . $id)->row();
		$idbat = $this->db->insert_id();

		$sql3 = "INSERT INTO sm_course_sessions (batch_id, date, starttime, endtime, time_type, session_objective, session_location, created_at, course_country, course_city ) SELECT " . $idbat . ", date, starttime, endtime, time_type, session_objective, session_location, created_at, course_country, course_city FROM sm_course_sessions WHERE batch_id = " . $query->batchId;
		$this->db->query($sql3);

		$sql4 = "INSERT INTO sm_training_material ( course_id, training_material_name, training_material_files, s_order, status ) SELECT " . $ide . ", training_material_name, training_material_files, s_order, status FROM sm_training_material  WHERE course_id = " . $id;
		$this->db->query($sql4);

		$this->session->set_flashdata('success_add', 'Data Added Successfully');
		redirect('supercontrol/course/show_all_courses', TRUE);

	}


	function add_course_clone_coming_soon($id)
	{
		$sql = "INSERT INTO sm_course (	course_name, course_category, course_country, course_city, price, add_date, course_description, course_image, status, certificate, entry_requirment, who_should_apply, course_startDate, course_endDate, course_mode, course_level, course_type) SELECT course_name, course_category, course_country, course_city, price, add_date, course_description, course_image, status, certificate, entry_requirment, who_should_apply, course_startDate, course_endDate, course_mode, course_level, course_type FROM sm_course WHERE course_id = " . $id;
		$res = $this->db->query($sql);
		$ide = $this->db->insert_id();

		$sql1 = "INSERT INTO sm_syllabus ( course_id, syllabus_name, syllabus_content, s_order, status ) SELECT " . $ide . ", syllabus_name, syllabus_content, s_order, status FROM sm_syllabus WHERE course_id = " . $id;
		$this->db->query($sql1);

		$sql2 = "INSERT INTO sm_training_material ( course_id, training_material_name, training_material_files, s_order, status ) SELECT " . $ide . ", training_material_name, training_material_files, s_order, status FROM sm_syllabus WHERE course_id = " . $id;
		$this->db->query($sql2);

		$this->session->set_flashdata('success_add', 'Data Added Successfully');
		redirect('supercontrol/course/comingsoon_course', TRUE);

	}
	public function add_course_session_view() {
		$id = end($this->uri->segment_array());
		$data['categories'] = $this->generalmodel->getCategories();
		$data['locations'] = $this->generalmodel->getlocations();
		$data['title'] = "Add Course Syllabus";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/batchadd_view', $data);
		$this->load->view('supercontrol/footer', $data);
	}
	public function add_course_trainingmaterial_view($course_id) {
		$data['id'] = $course_id;
		$data['title'] = "Add Training Material ";
		$data['module'] = $this->db->where('course_id', $course_id)->get('course_modules')->result();
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/trainingmaterialaddview', $data);
		$this->load->view('supercontrol/footer', $data);
	}
	public function material_list($course_id) {
		$querysyllabus = $this->generalmodel->getAllData('course_materials', 'course_id', $course_id, '', '');
		$data['syllabuslist'] = $querysyllabus;
		$data['title'] = "Course Training Material List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showtrainingmateriallist', $data);
		$this->load->view('supercontrol/footer', $data);
	}
	/*public function add_course_trainingmaterial() {
		$this->load->library('form_validation');
		$config = array(
			'upload_path' => "uploads/trainingmaterial/",
			'upload_url' => base_url() . "uploads/trainingmaterial/",
			'file_name' => time() . str_replace(' ', '_', $_FILES['training_material_files']['name']),
			'allowed_types' => "pdf|doc|docx"

		);
		$this->load->library('upload', $config);
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('training_material_name', 'Training Material Title', 'required|min_length[1]|max_length[50]');
		if ($this->form_validation->run() == FALSE) {
			$id = end($this->uri->segment_array());
			$data['title'] = "Add Course Training Material";
			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/trainingmaterialaddview', $data);
			$this->load->view('supercontrol/footer', $data);
		} else {
			$table_name = 'sm_training_material';
			if ($this->upload->do_upload('training_material_files')) {
				$data['userfile'] = $this->upload->data();
				$config['file_name'] = time() . str_replace(' ', '_', $_FILES['training_material_files']['name']);
			}
			$filename = $data['userfile']['file_name'];
			$data = array(
				'course_id' => $this->input->post('course_id'),
				'training_material_name' => $this->input->post('training_material_name'),
				'training_material_files' => $filename,
				's_order' => '1',
				'status' => '1'
			);
			$this->generalmodel->insert_data($table_name, $data);
			$this->session->set_flashdata('success', 'Data Added Successfully');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}*/
	public function add_course_trainingmaterial($id) {
		//echo $id; die();
		$this->form_validation->set_rules('material_type', 'Material Type', 'required');
		$formdata['course_id'] = $id;
		$mydata = array(
			'course_id' => @$id,
			'user_id' => @$this->session->userdata('user_id'),
			'module' => @$this->input->post('module'),
			'material_type' => @$this->input->post('material_type'),
			'video_type' => @$this->input->post('video_type'),
			'video_url' => @$this->input->post('video_url'),
			'material_description' => @$this->input->post('material_description'),
			'created_at' => date("Y-m-d h:i:s"),
			'status' => @$this->input->post('status')
		);

		if ($_FILES['video_file']['name'] != '') {
			$config['upload_path'] = './uploads/materials/';
			$config['allowed_types'] = '*';
			$config['max_size'] = '*';
			$config['overwrite'] = false;
			$config['remove_spaces'] = TRUE;
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('video_file')) {
				$error = array('error' => $this->upload->display_errors());
				$msg = '["' . $error['error'] . '", "error", "#e50914"]';
			} else {
				$fileData = $this->upload->data();
				$mydata['video_file'] = $fileData['file_name'];
			}
		}
		$insert = $this->generalmodel->insert_data('course_materials', $mydata);
		if ($insert) {
			$dataOrdering = array(
				'position_order' => $insert
			);
			$this->db->update('course_materials', $dataOrdering, array('id' => $insert));
		}

		if (!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) {
			$countfiles = count($_FILES['files']['name']);
			for ($i = 0; $i < $countfiles; $i++) {
				if (!empty($_FILES['files']['name'][$i])) {
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];
					$config['upload_path'] = 'uploads/materials/';
					$config['allowed_types'] = '*';
					$config['max_size'] = '*';
					$config['file_name'] = $_FILES['files']['name'][$i];
					$config['overwrite'] = false;
					$config['remove_spaces'] = true;
					$config['encrypt_name'] = false;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('file')) {
						$fileData = $this->upload->data();
						$uploadData[$i]['resource_file'] = $fileData['file_name'];
						$uploadData[$i]['user_id'] = @$this->session->userdata('user_id');
						$uploadData[$i]['course_id'] = $id;
						$uploadData[$i]['material_id'] = $insert;
						$uploadData[$i]['created_at'] = date("Y-m-d h:i:s");
						$uploadData[$i]['status'] = 1;
						if (!empty($uploadData)) {
							$this->generalmodel->insert_data('course_resources', $uploadData[$i]);
							//echo $this->db->last_query(); die();
						}
					}
				}
			}			
		}

		if ($this->input->post('material_type') == 'quiz') {
			$ques = $this->input->post('ques');
			$ans1 = $this->input->post('ans1');
			$ans2 = $this->input->post('ans2');
			$ans3 = $this->input->post('ans3');
			$ans4 = $this->input->post('ans4');
			$cor_ans = $this->input->post('cor_ans');
			for ($k = 0; $k < count($ques); $k++) {
				$basicdata[] = array(
					'course_id' => $id,
					'material_id' => $insert,
					'question' => $ques[$k],
					'ans1' => $ans1[$k],
					'ans2' => $ans2[$k],
					'ans3' => $ans3[$k],
					'ans4' => $ans4[$k],
					'correct_answer' => $cor_ans[$k],
					'status' => 1,
					'created_at' => date("Y-m-d h:i:s")
				);
				$basicdata[$k]['quiz_file'] = '';
				if (!empty($_FILES['file_name']['name'][$k])) {
					$_FILES['file']['name'] = $_FILES['file_name']['name'][$k];
					$_FILES['file']['type'] = $_FILES['file_name']['type'][$k];
					$_FILES['file']['tmp_name'] = $_FILES['file_name']['tmp_name'][$k];
					$_FILES['file']['error'] = $_FILES['file_name']['error'][$k];
					$_FILES['file']['size'] = $_FILES['file_name']['size'][$k];
					$config['upload_path'] = 'uploads/quizs/';
					$config['allowed_types'] = '*';
					$config['max_size'] = '*';
					$config['file_name'] = $_FILES['file_name']['name'][$k];
					$config['overwrite'] = false;
					$config['remove_spaces'] = true;
					$config['encrypt_name'] = false;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('file')) {
						$fileData = $this->upload->data();
						$basicdata[$k]['quiz_file'] = $fileData['file_name'];
					}
				}
				$basicdata[$k]['ans1_file'] = '';
				if (!empty($_FILES['option1_file_name']['name'][$k])) {
					$_FILES['file']['name'] = $_FILES['option1_file_name']['name'][$k];
					$_FILES['file']['type'] = $_FILES['option1_file_name']['type'][$k];
					$_FILES['file']['tmp_name'] = $_FILES['option1_file_name']['tmp_name'][$k];
					$_FILES['file']['error'] = $_FILES['option1_file_name']['error'][$k];
					$_FILES['file']['size'] = $_FILES['option1_file_name']['size'][$k];
					$config['upload_path'] = 'uploads/quizs/answer_files/';
					$config['allowed_types'] = '*';
					$config['max_size'] = '*';
					$config['file_name'] = $_FILES['option1_file_name']['name'][$k];
					$config['overwrite'] = false;
					$config['remove_spaces'] = true;
					$config['encrypt_name'] = false;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('file')) {
						$fileData = $this->upload->data();
						$basicdata[$k]['ans1_file'] = $fileData['file_name'];
					}
				}
				$basicdata[$k]['ans2_file'] = '';
				if (!empty($_FILES['option2_file_name']['name'][$k])) {
					$_FILES['file']['name'] = $_FILES['option2_file_name']['name'][$k];
					$_FILES['file']['type'] = $_FILES['option2_file_name']['type'][$k];
					$_FILES['file']['tmp_name'] = $_FILES['option2_file_name']['tmp_name'][$k];
					$_FILES['file']['error'] = $_FILES['option2_file_name']['error'][$k];
					$_FILES['file']['size'] = $_FILES['option2_file_name']['size'][$k];
					$config['upload_path'] = 'uploads/quizs/answer_files/';
					$config['allowed_types'] = '*';
					$config['max_size'] = '*'; 
					$config['file_name'] = $_FILES['option2_file_name']['name'][$k];
					$config['overwrite'] = false;
					$config['remove_spaces'] = true;
					$config['encrypt_name'] = false;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('file')) {
						$fileData = $this->upload->data();
						$basicdata[$k]['ans2_file'] = $fileData['file_name'];
					}
				}
				$basicdata[$k]['ans3_file'] = '';
				if (!empty($_FILES['option3_file_name']['name'][$k])) {
					$_FILES['file']['name'] = $_FILES['option3_file_name']['name'][$k];
					$_FILES['file']['type'] = $_FILES['option3_file_name']['type'][$k];
					$_FILES['file']['tmp_name'] = $_FILES['option3_file_name']['tmp_name'][$k];
					$_FILES['file']['error'] = $_FILES['option3_file_name']['error'][$k];
					$_FILES['file']['size'] = $_FILES['option3_file_name']['size'][$k];
					$config['upload_path'] = 'uploads/quizs/answer_files/';
					$config['allowed_types'] = '*';
					$config['max_size'] = '*';
					$config['file_name'] = $_FILES['option3_file_name']['name'][$k];
					$config['overwrite'] = false;
					$config['remove_spaces'] = true;
					$config['encrypt_name'] = false;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('file')) {
						$fileData = $this->upload->data();
						$basicdata[$k]['ans3_file'] = $fileData['file_name'];
					}
				}
				$basicdata[$k]['ans4_file'] = '';
				if (!empty($_FILES['option4_file_name']['name'][$k])) {
					$_FILES['file']['name'] = $_FILES['option4_file_name']['name'][$k];
					$_FILES['file']['type'] = $_FILES['option4_file_name']['type'][$k];
					$_FILES['file']['tmp_name'] = $_FILES['option4_file_name']['tmp_name'][$k];
					$_FILES['file']['error'] = $_FILES['option4_file_name']['error'][$k];
					$_FILES['file']['size'] = $_FILES['option4_file_name']['size'][$k];
					$config['upload_path'] = 'uploads/quizs/answer_files/';
					$config['allowed_types'] = '*';
					$config['max_size'] = '*';
					$config['file_name'] = $_FILES['option4_file_name']['name'][$k];
					$config['overwrite'] = false;
					$config['remove_spaces'] = true;
					$config['encrypt_name'] = false;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('file')) {
						$fileData = $this->upload->data();
						$basicdata[$k]['ans4_file'] = $fileData['file_name'];
					}
				}
				$this->generalmodel->insert_data('course_quiz', $basicdata[$k]);
			}
		}
		$msg = '["Course Material added successfully!", "success", "#36A1EA"]';
		$this->session->set_flashdata('msg', $msg);
		//redirect(admin_url('course/material_list/' . $id));
		redirect('supercontrol/course/material_list/'.$id.'', 'refresh');
	}
	public function edit_trainingmaterial_view($course_id, $mat_id) {
		$data['course_id'] = $course_id;
		$data['mat_id'] = $mat_id;
		//$query = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		//echo $this->db->last_query(); die();
		$query = $this->db->query("SELECT * FROM course_materials WHERE id = '".$mat_id."'")->result();
		$data['slist'] = $query;
		$data['module'] = $this->generalmodel->getAllData('course_modules', 'course_id', $course_id, '', '');
		$data['title'] = "Edit Course Training Material";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/edittrainingmaterial', $data);
		$this->load->view('supercontrol/footer', $data);
		//redirect('supercontrol/course/material_list/'.$course_id.'', 'refresh');
	}

	/*public function edit_trainingmaterial() {
		$training_material_files = $this->input->post('training_material_files');
		$config = array(
			'upload_path' => "uploads/trainingmaterial/",
			'upload_url' => base_url() . "uploads/trainingmaterial/",
			'file_name' => time() . str_replace(' ', '_', $_FILES['training_material_files']['name']),
			'allowed_types' => "pdf|doc|docx"

		);
		$this->load->library('upload', $config);
		@unlink("uploads/trainingmaterial/" . $training_material_files);
		$data['training_material_files'] = $this->upload->data();
		$table_name = 'sm_training_material';
		$id = $this->input->post('training_material_id');
		$fieldname = 'training_material_id';
		$action = 'update';
		if ($this->upload->do_upload('training_material_files')) {
			$data['userfile'] = $this->upload->data();

		}
		$filename = $data['userfile']['file_name'];
		//print_r($_FILES);die;
		$datalist = array(
			'training_material_name' => $this->input->post('training_material_name'),
			'training_material_files' => $data['training_material_files']['file_name'],
			's_order' => '1',
			'status' => '1'
		);
		//$training_material_files = $this->input->post('training_material_files');
		//print_r($datalist);die;
		$this->generalmodel->show_data_id($table_name, $id, $fieldname, $action, $datalist);
		$this->session->set_flashdata('success', 'Data Updated Successfully !!!');
		redirect('supercontrol/course/trainingmaterial_list/' . $this->input->post('course_id') . '', 'refresh');
	}*/

	public function edit_trainingmaterial($course_id, $id) {
		//echo $course_id."=====".$id; die();
		$this->form_validation->set_rules('module', 'Module', 'required');
		if ($this->form_validation->run()) {
			$where = array('id' => $id);
			$old_file = $this->input->post('old_file');
			$mydata = array(
				'module' => $this->input->post('module'),
				'video_url' => $this->input->post('video_url'),
				'material_description' => $this->input->post('material_description'),
				'status' => @$this->input->post('status')
			);
			if ($_FILES['video_file']['name'] != '') {
				$config['upload_path'] = './uploads/materials/';
				$config['allowed_types'] = '*';
				$config['max_size'] = '*';
				$config['overwrite'] = false;
				$config['remove_spaces'] = TRUE;  //it will remove all spaces
				$config['encrypt_name'] = true;   //it wil encrypte the original file name
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('video_file')) {
					$error = array('error' => $this->upload->display_errors());
					$msg = '["' . $error['error'] . '", "error", "#e50914"]';
				} else {
					$fileData = $this->upload->data();
					$mydata['video_file'] = $fileData['file_name'];
				}
			}
			if ($old_file && $_FILES['video_file']['name'] != '') {
				if (file_exists('./uploads/materials/' . $old_file)) {
					@unlink('./uploads/materials/' . $old_file);
				}
			}
			//$update = $this->Commonmodel->update_row('course_materials', $mydata, $where);
			$this->generalmodel->show_data_id('course_materials', $id, 'id', 'update', $mydata);
			if (!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) {
				$countfiles = count($_FILES['files']['name']);
				for ($i = 0; $i < $countfiles; $i++) {
					if (!empty($_FILES['files']['name'][$i])) {
						$_FILES['file']['name'] = $_FILES['files']['name'][$i];
						$_FILES['file']['type'] = $_FILES['files']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$_FILES['file']['error'] = $_FILES['files']['error'][$i];
						$_FILES['file']['size'] = $_FILES['files']['size'][$i];
						$config['upload_path'] = 'uploads/materials/';
						$config['allowed_types'] = '*';
						$config['max_size'] = '*'; // max_size in kb
						$config['file_name'] = $_FILES['files']['name'][$i];
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;  //it will remove all spaces
						$config['encrypt_name'] = false;   //it wil encrypte the original file name
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file')) {
							$fileData = $this->upload->data();
							$uploadData[$i]['resource_file'] = $fileData['file_name'];
							$uploadData[$i]['course_id'] = $course_id;
							$uploadData[$i]['material_id'] = $id;
							$uploadData[$i]['created_at'] = date("Y-m-d h:i:s");
							$uploadData[$i]['status'] = 1;
							if (!empty($uploadData)) {
								$this->generalmodel->insert_data('course_resources', $uploadData[$i]);
							}
						}
					}
				}
			}
			$ques = $this->input->post('ques');
			$ans1 = $this->input->post('ans1');
			$ans2 = $this->input->post('ans2');
			$ans3 = $this->input->post('ans3');
			$ans4 = $this->input->post('ans4');
			$cor_ans = $this->input->post('cor_ans');
			$old_image = $this->input->post('old_image');
			$ans1_old_image = $this->input->post('ans1_old_image');
			$ans2_old_image = $this->input->post('ans2_old_image');
			$ans3_old_image = $this->input->post('ans3_old_image');
			$ans4_old_image = $this->input->post('ans4_old_image');
			// echo $old_image."--";
			if (!empty($ques)) {
				//$this->Commonmodel->delete_single_con('course_quiz', array('material_id' => $id));
				$this->db->query("DELETE FROM course_quiz WHERE material_id = '".$id."'");
				for ($k = 0; $k < count($ques); $k++) {
					$basicdata[] = array(
						'course_id'=> $course_id,
						'material_id' => $id,
						'question' => $ques[$k],
						'ans1' => $ans1[$k],
						'ans2' => $ans2[$k],
						'ans3' => $ans3[$k],
						'ans4' => $ans4[$k],
						'correct_answer' => $cor_ans[$k],
						'status' => 1,
						'created_at' => date("Y-m-d h:i:s")
					);
					// echo $old_image[$k];die;
					if (empty($old_image[$k])) {
						$basicdata[$k]['quiz_file'] = '';
					} else {
						$basicdata[$k]['quiz_file'] = $old_image[$k];
					}
					if (!empty($_FILES['file_name']['name'][$k])) {
						$_FILES['file']['name'] = $_FILES['file_name']['name'][$k];
						$_FILES['file']['type'] = $_FILES['file_name']['type'][$k];
						$_FILES['file']['tmp_name'] = $_FILES['file_name']['tmp_name'][$k];
						$_FILES['file']['error'] = $_FILES['file_name']['error'][$k];
						$_FILES['file']['size'] = $_FILES['file_name']['size'][$k];
						$config['upload_path'] = 'uploads/quizs/';
						$config['allowed_types'] = '*';
						$config['max_size'] = '*'; // max_size in kb
						$config['file_name'] = $_FILES['files']['name'][$k];
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;  //it will remove all spaces
						$config['encrypt_name'] = false;   //it wil encrypte the original file name
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file')) {
							$fileData = $this->upload->data();
							$basicdata[$k]['quiz_file'] = $fileData['file_name'];
						}
					}
					if ($old_image[$k] && $_FILES['file_name']['name'][$k] != '') {
						if (file_exists('./uploads/quizs/'.$old_image[$k])) {
							@unlink('./uploads/quizs/'.$old_image[$k]);
						}
					}
					if (empty($ans1_old_image[$k])) {
						$basicdata[$k]['ans1_file'] = '';
					} else {
						$basicdata[$k]['ans1_file'] = $ans1_old_image[$k];
					}
					if (!empty($_FILES['option1_file_name']['name'][$k])) {
						$_FILES['file']['name'] = $_FILES['option1_file_name']['name'][$k];
						$_FILES['file']['type'] = $_FILES['option1_file_name']['type'][$k];
						$_FILES['file']['tmp_name'] = $_FILES['option1_file_name']['tmp_name'][$k];
						$_FILES['file']['error'] = $_FILES['option1_file_name']['error'][$k];
						$_FILES['file']['size'] = $_FILES['option1_file_name']['size'][$k];
						$config['upload_path'] = 'uploads/quizs/answer_files/';
						$config['allowed_types'] = '*';
						$config['max_size'] = '*'; // max_size in kb
						$config['file_name'] = $_FILES['option1_file_name']['name'][$k];
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;  //it will remove all spaces
						$config['encrypt_name'] = false;   //it wil encrypte the original file name
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file')) {
							$fileData = $this->upload->data();
							$basicdata[$k]['ans1_file'] = $fileData['file_name'];
						}
					}
					if ($ans1_old_image[$k] && $_FILES['option1_file_name']['name'][$k] != '') {
						if (file_exists('./uploads/quizs/answer_files/'.$ans1_old_image[$k])) {
							@unlink('./uploads/quizs/answer_files/'.$ans1_old_image[$k]);
						}
					}
					if (empty($ans2_old_image[$k])) {
						$basicdata[$k]['ans2_file'] = '';
					} else {
						$basicdata[$k]['ans2_file'] = $ans2_old_image[$k];
					}
					if (!empty($_FILES['option2_file_name']['name'][$k])) {
						$_FILES['file']['name'] = $_FILES['option2_file_name']['name'][$k];
						$_FILES['file']['type'] = $_FILES['option2_file_name']['type'][$k];
						$_FILES['file']['tmp_name'] = $_FILES['option2_file_name']['tmp_name'][$k];
						$_FILES['file']['error'] = $_FILES['option2_file_name']['error'][$k];
						$_FILES['file']['size'] = $_FILES['option2_file_name']['size'][$k];
						$config['upload_path'] = 'uploads/quizs/answer_files/';
						$config['allowed_types'] = '*';
						$config['max_size'] = '*';
						$config['file_name'] = $_FILES['option2_file_name']['name'][$k];
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['encrypt_name'] = false;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file')) {
							$fileData = $this->upload->data();
							$basicdata[$k]['ans2_file'] = $fileData['file_name'];
						}
					}
					if ($ans2_old_image[$k] && $_FILES['option2_file_name']['name'][$k] != '') {
						if (file_exists('./uploads/quizs/answer_files/'.$ans2_old_image[$k])) {
							@unlink('./uploads/quizs/answer_files/'.$ans2_old_image[$k]);
						}
					}
					if (empty($ans3_old_image[$k])) {
						$basicdata[$k]['ans3_file'] = '';
					} else {
						$basicdata[$k]['ans3_file'] = $ans3_old_image[$k];
					}
					if (!empty($_FILES['option3_file_name']['name'][$k])) {
						$_FILES['file']['name'] = $_FILES['option3_file_name']['name'][$k];
						$_FILES['file']['type'] = $_FILES['option3_file_name']['type'][$k];
						$_FILES['file']['tmp_name'] = $_FILES['option3_file_name']['tmp_name'][$k];
						$_FILES['file']['error'] = $_FILES['option3_file_name']['error'][$k];
						$_FILES['file']['size'] = $_FILES['option3_file_name']['size'][$k];
						$config['upload_path'] = 'uploads/quizs/answer_files/';
						$config['allowed_types'] = '*';
						$config['max_size'] = '*';
						$config['file_name'] = $_FILES['option3_file_name']['name'][$k];
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['encrypt_name'] = false;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file')) {
							$fileData = $this->upload->data();
							$basicdata[$k]['ans3_file'] = $fileData['file_name'];
						}
					}
					if ($ans3_old_image[$k] && $_FILES['option3_file_name']['name'][$k] != '') {
						if (file_exists('./uploads/quizs/answer_files/'.$ans3_old_image[$k])) {
							@unlink('./uploads/quizs/answer_files/'.$ans3_old_image[$k]);
						}
					}
					if (empty($ans4_old_image[$k])) {
						$basicdata[$k]['ans4_file'] = '';
					} else {
						$basicdata[$k]['ans4_file'] = $ans4_old_image[$k];
					}
					if (!empty($_FILES['option4_file_name']['name'][$k])) {
						$_FILES['file']['name'] = $_FILES['option4_file_name']['name'][$k];
						$_FILES['file']['type'] = $_FILES['option4_file_name']['type'][$k];
						$_FILES['file']['tmp_name'] = $_FILES['option4_file_name']['tmp_name'][$k];
						$_FILES['file']['error'] = $_FILES['option4_file_name']['error'][$k];
						$_FILES['file']['size'] = $_FILES['option4_file_name']['size'][$k];
						$config['upload_path'] = 'uploads/quizs/answer_files/';
						$config['allowed_types'] = '*';
						$config['max_size'] = '*';
						$config['file_name'] = $_FILES['option4_file_name']['name'][$k];
						$config['overwrite'] = false;
						$config['remove_spaces'] = true;
						$config['encrypt_name'] = false;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload('file')) {
							$fileData = $this->upload->data();
							$basicdata[$k]['ans4_file'] = $fileData['file_name'];
						}
					}
					if ($ans4_old_image[$k] && $_FILES['option4_file_name']['name'][$k] != '') {
						if (file_exists('./uploads/quizs/answer_files/'.$ans4_old_image[$k])) {
							@unlink('./uploads/quizs/answer_files/'.$ans4_old_image[$k]);
						}
					}
				}
				$this->db->insert_batch('course_quiz', $basicdata);
			}
			$msg = '["Course Material updated successfully!", "success", "#36A1EA"]';
			$this->session->set_flashdata('msg', $msg);
			//redirect('supercontrol/course/material_list/'.$course_id.'/'.$id.'', 'refresh');
			redirect('supercontrol/course/material_list/'.$course_id.'', 'refresh');
		} else {
			//redirect('supercontrol/course/material_list/'.$course_id.'/'.$id.'', 'refresh');
			redirect('supercontrol/course/material_list/'.$course_id.'', 'refresh');
		}
	}

	public function delete_trainingmaterial($id, $course_id) {
		/*$id = end($this->uri->segment_array());
		$this->generalmodel->show_data_id('sm_training_material', $id, 'training_material_id', 'delete', '');
		$this->session->set_flashdata('success', 'Data Deleted Successfully');
		redirect($_SERVER['HTTP_REFERER']);*/
		if ($id > 0) {
            $result = $this->db->get_where('course_resources', array('material_id' => $id))->result();
            if (!empty($result)) {
                foreach ($result as $key => $value) {
                    if (@$value->resource_file && file_exists('./uploads/materials/' . @$value->resource_file)) {
                        @unlink('./uploads/materials/' . @$value->resource_file);
                    }
                }
            }
            $data = $this->db->get_where('course_materials', array('id' => $id))->row();
            if (@$data->video_file && file_exists('./uploads/materials/' . @$data->video_file)) {
                @unlink('./uploads/materials/' . @$data->video_file);
            }
            //$this->Commonmodel->delete_single_con('course_resources', array('material_id' => $id));
            //$this->Commonmodel->delete_single_con('course_quiz', array('material_id' => $id));
            //$this->Course_model->delete($id, 'course_materials');
			$this->db->query("DELETE FROM course_resources WHERE material_id = '".$id."'");
			$this->db->query("DELETE FROM course_quiz WHERE material_id = '".$id."'");
			$this->db->query("DELETE FROM course_materials WHERE id = '".$id."'");
            $this->session->set_flashdata('success', 'Course Material deleted successfully');
			redirect('supercontrol/course/material_list/'.$course_id.'', 'refresh');
        }
	}
	public function course_session_list()
	{
		echo $id = end($this->uri->segment_array());
		$data['batchlist'] = $this->db->get_where('sm_batch', array('courseId' => $id))->result();
		//print_r($data['batchlist']); die;
		$batchId = $data['batchlist'][0]->batchId;
		$data['batchSession'] = $this->db->get_where('sm_course_sessions', array('batch_id' => $batchId))->result();
		$data['locations'] = $this->generalmodel->getlocations();
		//print_r($data['batchSession']); die;

		$data['title'] = "Course Syllabus List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showcoursesessionlist', $data);
		$this->load->view('supercontrol/footer', $data);
	}

	public function session_view()
	{
		//$id = end($this->uri->segment_array());
		$table_name = 'sm_batch';
		$primary_key = '';
		$wheredata = "";
		$data['batchlists'] = $batchlist = $this->generalmodel->getAllData($table_name, $primary_key, $wheredata, '', '');
		$batchId = $data['batchlists']->batchId;
		$data['batchSessionlist'] = $session_list = $this->db->get_where('course_sessions', array('batch_id' => $batchId))->result();
		//print_r($data['batchSessionlist']);die;
		$data['locations'] = $this->generalmodel->getlocations();
		$data['title'] = "Course Syllabus List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showsessionlist', $data);
		$this->load->view('supercontrol/footer', $data);
	}
	public function edit_coursesession_view()
	{
		$id = $this->uri->segment(4);
		$data['lessdetails'] = $this->generalmodel->fetch_all_join("Select * from sm_batch where batchId='$id'");
		$data['batchSessionlist'] = $session_list = $this->db->get_where('sm_course_sessions', array('batch_id' => $id))->result();
		$data['categories'] = $this->generalmodel->getCategories();
		$data['locations'] = $this->generalmodel->getlocations();
		$data['cites'] = $this->generalmodel->getCities();
		//$data['cites'] = $this->generalmodel->getCites();
		$data['levels'] = $this->generalmodel->getlevel();
		$data['modes'] = $this->generalmodel->getMode();
		$data['title'] = "Edit Course Session";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/editcoursesession', $data);
		$this->load->view('supercontrol/footer', $data);
	}
	public function deleteMaterialFile($id = false, $course_id = false, $material_id = false) {
		//echo $id."=======".$course_id."=====".$material_id; die();
        $data = $this->db->get_where('course_resources', array('id' => $id))->row();
        if (@$data->resource_file && file_exists('./uploads/materials/' . @$data->resource_file)) {
            @unlink('./uploads/materials/' . @$data->resource_file);
        }
        //$this->Commonmodel->delete_single_con('course_resources', array('id' => $id));
		$this->db->query("DELETE FROM course_resources WHERE id = '".$id."'");
        $msg = '["Deleted successfully.", "success", "#36A1EA"]';
        $this->session->set_flashdata('msg', $msg);
        redirect('supercontrol/course/edit_trainingmaterial_view/'.$course_id."/".$material_id.'', 'refresh');
    }
}
?>