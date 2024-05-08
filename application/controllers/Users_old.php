<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Users extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Apimodel');
		$this->load->model('Commonmodel');
		// $this->isLoggedIn();
		require 'vendor/autoload.php';
		if (!$this->session->has_userdata('isLoggedIn') || !$this->session->has_userdata('user_id')) {
			$redirectto = urlencode(current_url());
			redirect(base_url('login?redirectto=' . $redirectto), 'refresh');
		}
	}
	public function index() {
		$data = array('title' => 'Student Dashboard', 'page' => 'dashboard');
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$data['enrolments'] = $this->db->query($getEnrolmentSql)->result();
		//$getEnrolmentSql = "SELECT COUNT(DISTINCT `enrollment_id`) AS activeCourse FROM `course_enrollment_status` WHERE `user_id` = '" . $user_id . "'";
		//$data['active_data'] = $this->db->query($getEnrolmentSql)->row();
		$this->load->view('header', $data);
		$this->load->view('dashboard');
		$this->load->view('footer');
	}
	public function profile() {
		$data = array('title' => 'Student Profile','page' => 'profile');
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$this->load->view('header', $data);
		$this->load->view('profile');
		$this->load->view('footer');
	}
	public function purchaseList() {
		$data = array(
			'title' => 'Purchase History',
			'page' => 'purchase',
		);
		$user_id = $this->session->userdata('user_id');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getPurchaseSql = "SELECT ctrl.*, cour.title FROM `course_enrollment` as ctrl INNER JOIN `courses` as cour ON cour.id = ctrl.course_id WHERE ctrl.user_id = '" . $user_id . "' ORDER BY ctrl.enrollment_date DESC";
		$data['orders'] = $this->Commonmodel->fetch_all_join($getPurchaseSql);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$this->load->view('header', $data);
		$this->load->view('purchase-list');
		$this->load->view('footer');
	}
	public function reviews() {
		$data = array(
			'title' => 'Reviews',
			'page' => 'reviews',
		);
		$user_id = $this->session->userdata('user_id');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getReviewsSql = "SELECT ctrl.*, cour.title, cour.image FROM `course_reviews` as ctrl INNER JOIN `courses` as cour ON cour.id = ctrl.course_id WHERE ctrl.user_id = '".$user_id."' ORDER BY ctrl.review_date DESC";
		$data['reviews'] = $this->Commonmodel->fetch_all_join($getReviewsSql);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$this->load->view('header', $data);
		$this->load->view('reviews');
		$this->load->view('footer');
	}
	public function editProfile() {
		$data = array(
			'title' => 'Edit Profile',
			'page' => 'profile',
		);
		$user_id = $this->session->userdata('user_id');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$this->load->view('header', $data);
		$this->load->view('edit-profile');
		$this->load->view('footer');
	}
	public function testInput($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	public function profileUpdate() {
		//echo "test"; die();
		$user_id = $this->session->userdata('user_id');
		$oldImage = $this->input->post('old_image');
		$email = $this->input->post('email');
		$first_name = $this->testInput($this->input->post('first_name'));
		//$last_name = $this->testInput($this->input->post('last_name'));
		$phone_full = $this->input->post('phone_full');
		$phone_code = $this->input->post('phone_code');
		$phone_country = $this->input->post('phone_country');
		$phone_st_country = $this->input->post('phone_st_country');
		$check_email = $this->db->get_where('users', array('email' => $email, 'id !=' => $user_id))->num_rows();
		if ($check_email > 0) {
			$this->session->set_flashdata('error', 'The email id you are trying to use is already registered. Please try unique email address!');
			redirect(base_url('edit-profile'), 'refresh');
		}
		$where = array('id' => @$user_id);
		$mydata = array(
			'fname' => $first_name, 
			'email' => $email, 
			'phone' => $this->input->post('phone'), 
			'phone_full' => $phone_full, 
			'skills' => $this->input->post('skills'),
			'phone_code' => $phone_code, 
			'phone_country' => $phone_country, 
			'phone_st_country' => $phone_st_country, 
			'user_bio' => $this->input->post('user_bio')
		);
		//print_r($mydata); die();
		if ($_FILES['profile_image']['name'] != '') {
			$config['upload_path'] = './uploads/profile_pictures/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '*';
			$config['overwrite'] = false;
			$config['remove_spaces'] = TRUE;  //it will remove all spaces
			$config['encrypt_name'] = false;   //it wil encrypte the original file name
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('profile_image')) {
				$error = array('error' => $this->upload->display_errors());
				$msg = '["' . $error['error'] . '", "error", "#e50914"]';
			} else {
				// Uploaded file data 
				$fileData = $this->upload->data();
				$mydata['image'] = $fileData['file_name'];
			}
		}

		if ($this->input->post('password_edit') && $this->input->post('password_edit') != '') {
			$mydata['password'] = md5($this->input->post('password_edit'));
		}

		if (empty($mydata)) {
			$msg = '["Profile updated successfully!", "success", "#36A1EA"]';
		} else {
			if (!($this->Commonmodel->edit_single_row('users', $mydata, $where))) {
				$msg = '["Some error occured, Please try again!", "error", "#e50914"]';
			} else {
				if ($oldImage && $_FILES['profile_image']['name'] != '') {
					if (file_exists('./uploads/profile_pictures/' . $oldImage)) {
						@unlink('./uploads/profile_pictures/' . $oldImage);
					}
				}
				$msg = '["Profile updated successfully!", "success", "#36A1EA"]';
			}
		}
		$this->session->set_flashdata('msg', $msg);
		redirect(base_url('profile'), 'refresh');
	}
	public function enrolledCourse() {
		$data = array(
			'title' => 'Enrolled Courses',
			'page' => 'enrolled',
		);
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getAllEnrolledSql = "SELECT cre.*, cr.* FROM `course_enrollment` cre INNER JOIN `courses` AS cr ON cr.id = cre.course_id WHERE cre.payment_status = 'COMPLETED' AND cre.user_id = '" . $user_id . "'";
		$data['courses'] = $this->Commonmodel->fetch_all_join($getAllEnrolledSql);
		$getEnrolmentSql = "SELECT * FROM `course_enrollment` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getEnrolmentSql)->num_rows();
		$this->load->view('header', $data);
		$this->load->view('enrolled-courses');
		$this->load->view('footer');
	}
	public function courseModule($id = null) {
		if (empty($id)) {
			redirect(base_url('enrolled-courses'), 'refresh');
		}
		$data = array(
			'title' => 'Enrolled Course Detail',
			'page' => 'enrolled',
		);
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$getEnrolledSql = "SELECT cre.*, cr.* FROM `course_enrollment` cre INNER JOIN `courses` AS cr ON cr.id = cre.course_id WHERE cre.enrollment_id = '" . $id . "'";
		$data['courses'] = $this->Commonmodel->fetch_single_join($getEnrolledSql);
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$this->load->view('header', $data);
		$this->load->view('enrolled-course-detail');
		$this->load->view('footer');
	}
	public function courseMaterial($enrollment_id = null, $id = null) {
		if (empty($id) && empty($enrollment_id)) {
			redirect(base_url('enrolled-courses'), 'refresh');
		}
		$data = array('title' => 'Module Details', 'page' => 'enrolled');
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getEnrolledSql = "SELECT cre.*, cr.* FROM `course_enrollment` cre INNER JOIN `courses` AS cr ON cr.id = cre.course_id WHERE cre.enrollment_id = '" . $enrollment_id . "'";
		$data['courses'] = $this->Commonmodel->fetch_single_join($getEnrolledSql);
		$getModuleSql = "SELECT * FROM `course_modules` WHERE `id` = '" . @$id . "' ORDER BY `position_order` ASC";
		$data['module'] = $this->Commonmodel->fetch_single_join($getModuleSql);
		$data['enrollment_id'] = $enrollment_id;
		$getAllVideoSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$data['module']->course_id . "' AND `module` = '" . $id . "' AND `status` = '1' ORDER BY `position_order` ASC";
		$data['materials'] = $this->Commonmodel->fetch_all_join($getAllVideoSql);
		$this->load->view('header', $data);
		$this->load->view('enrolled-course-read');
		$this->load->view('footer');
	}
	public function completedMaterial() {
		$user_id = $this->session->userdata('user_id');
		$enrollment_id = $this->input->post('enrollment_id');
		$id = $this->input->post('id');
		// Get Material Details
		$getMaterialSql = "SELECT `course_id`, `module`, `material_type` FROM `course_materials` WHERE `id` = '" . @$id . "'";
		$materialData = $this->Commonmodel->fetch_single_join($getMaterialSql);
		$course_id = @$materialData->course_id;
		$module = @$materialData->module;
		$material_type = @$materialData->material_type;
		$isExitMaterialSql = "SELECT * FROM `course_enrollment_status` WHERE `user_id` = '" . $user_id . "' AND `course_id` = '" . $course_id . "' AND `module` = '" . $module . "' AND `material_id` = '" . $id . "'";
		$isExist = $this->db->query($isExitMaterialSql)->num_rows();
		if ($isExist == 0) {
			$materialData = array('enrollment_id' => @$enrollment_id, 'course_id' => @$course_id, 'module' => @$module, 'user_id' => @$user_id, 'material_id' => @$id, 'material_type' => @$material_type, 'completed_date' => date('Y-m-d H:i:s'));
			$lastId = $this->Commonmodel->add_details('course_enrollment_status', $materialData);
		}
	}
	public function courseQuizMaterial() {
		$user_id = $this->session->userdata('user_id');
		$enrollment_id = $this->input->post('enrollment_id');
		$id = $this->input->post('id');
		$keyId = $this->input->post('key');
		$page = $this->input->post('page');
		$optionArray = $this->input->post('optionArray');
		$quizList = "SELECT * FROM `course_quiz` WHERE `material_id` = '" . $id . "'";
		$totalQuiz = $this->db->query($quizList)->num_rows();
		$score = 0;
		$attempt = 0;
		$notAttempt = 0;
		$correctAttempt = 0;
		if (!empty($optionArray)) {
			foreach ($optionArray as $key => $value) {
				$correctAnswer = "SELECT `correct_answer` FROM `course_quiz` WHERE `id` = '" . $value['id'] . "'";
				$correctData = $this->db->query($correctAnswer)->row();
				$correct_answer = @$correctData->correct_answer;
				if ($value['choice'] != '') {
					if ($correct_answer == $value['choice']) {
						$score++;
						$correctAttempt++;
					}
					$attempt++;
				}
				if ($value['choice'] == '') {
					$notAttempt++;
				}
			}
		}
		$correctAttempt = $correctAttempt;
		$score = $score	/ $totalQuiz * 100;
		if ($score < 50) {
			$message = 'You need to score at least 50% to pass the exam.';
		} else {
			$message = 'You have passed the exam and scored ' . $score . '%.';
		}
		$data['totalQuiz'] = $totalQuiz;
		$data['totalAttempt'] = $attempt;
		$data['correctAttempt'] = $correctAttempt;
		$data['score'] = $score;
		$data['notAttempt'] = $notAttempt;
		$data['message'] = $message;
		$data['id'] = $id;
		$data['enrollment_id'] = $enrollment_id;
		$data['keyId'] = $keyId;
		$data['page'] = $page;
		$data['optionArray'] = $optionArray;
		$this->load->view('ajax-quiz-result', $data);
	}
	public function eventBooked() {
		$data = array(
			'title' => 'Booked Event List',
			'page' => 'booked',
		);
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$getAllBookedSql = "SELECT evb.*, evnt.* FROM `event_booked` evb INNER JOIN `event` AS evnt ON evnt.id = evb.event_id WHERE evb.payment_status = 'COMPLETED' AND evb.user_id = '" . $user_id . "'";
		$data['event'] = $this->Commonmodel->fetch_all_join($getAllBookedSql);
		$getBookedSql = "SELECT * FROM `event_booked` WHERE `user_id` = '" . $user_id . "' and `payment_status` = 'COMPLETED'";
		$data['ctn_enrolment'] = $this->db->query($getBookedSql)->num_rows();
		$this->load->view('header', $data);
		$this->load->view('event_booked');
		$this->load->view('footer');
	}
	public function usrReviews() {
		$data = array('title' => 'Reviews','page' => 'reviews');
		$user_id = $this->session->userdata('user_id');
		$isLoggedIn = $this->session->userdata('isLoggedIn');
		$where = array('id' => $user_id);
		$data['user'] = $this->Commonmodel->fetch_row('users', $where);
		$this->load->view('header', $data);
		$this->load->view('reviews');
		$this->load->view('footer');
	}
	public function logout() {
		session_destroy();
		$this->session->set_flashdata('success', 'You have successfully logout!');
		redirect(base_url('login'), 'refresh');
	}
}
