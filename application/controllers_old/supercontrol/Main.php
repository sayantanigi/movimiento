<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Main extends CI_Controller{
	public function index() {
		$this->login();
	}

	public function login() {
		$data['title'] = "COURSES";
		$this->load->view('supercontrol/headerlogin');
		$this->load->view('supercontrol/login_view', $data);
		$this->load->view('supercontrol/footerlogin');
	}

	public function login_validation() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'sha1|trim');

		if ($this->form_validation->run()) {
			$data = array(
				'username' => $this->input->post('username'),
				'is_logged_in' => 1
			);
			//$data1['username']=$this->input->post('username');
			$this->session->set_userdata($data);
			$username = $this->session->userdata('UserName');
			redirect('supercontrol/home');
		} else {
			$data['title'] = "Courses";
			$this->load->view('supercontrol/headerlogin');
			$this->load->view('supercontrol/login_view', $data);
			$this->load->view('supercontrol/footerlogin');
		}
	}
	//================================Form Validation==========================================
	//================================Validating supercontrol credentials against database============
	public function validate_credentials() {
		$this->load->model('supercontrol/model_users');
		if ($this->model_users->can_log_in()) {
			//echo $this->db->last_query(); exit();
			return true;
		} else {
			$this->form_validation->set_message('validate_credentials', 'Incorrect Username or password');
			return false;
		}
	}
	//==============================Validating supercontrol credentials against database=============

	//==============================supercontrol reset Password======================================
	public function is_logged_in()
	{
		header("cache-Control: no-store, no-cache, must-revalidate");
		header("cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		$is_logged_in = $this->session->userdata('logged_in');

		if (!isset($is_logged_in) || $is_logged_in !== TRUE) {
			redirect('supercontrol/login');
		}
	}
	public function reset_password()
	{
		$this->load->model('supercontrol/model_users');
		$this->form_validation->set_rules('old_password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('newpassword', 'New Password', 'required|matches[re_password]');
		$this->form_validation->set_rules('re_password', 'Retype Password', 'required');
		if ($this->form_validation->run() == FALSE) {

			$data['title'] = "Supercontrol Reset Password";
			$sessionData = $this->session->userdata('is_logged_in');
			$this->data['id'] = $sessionData['id'];
			$id = $this->input->post('id');
			$this->data['UserName'] = $sessionData['UserName'];

			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/resetpassword', $data);
			$this->load->view('supercontrol/footer');
		} else {
			$this->load->database();
			$id = $this->input->post('id');
			$query = $this->model_users->checkOldPass(md5($this->input->post('old_password')), $id);
			$data['oldpass'] = $query;
			if ($query) {
				$this->load->model('supercontrol/users_model');
				//Transfering data to Model
				$query = $this->users_model->show_pass();
				//$data['emember'] = $query;
				$data['pass'] = $query;
				//print_r($query);
				//print $this->db->last_query(); 

				if ($query) {
					echo $id = $this->input->post('id');
					$query = $this->model_users->saveNewPass(md5($this->input->post('newpassword')), $id);
					//print $this->db->last_query();
					//exit();
					if ($query) {
						redirect('supercontrol/main/reset_success');
					} else {
						redirect('supercontrol/main/change_password');
					}
				}

			} else {
				redirect('supercontrol/main/change_password');
			}
		}
	}

	function reset_success()
	{

		if ($this->session->userdata('is_logged_in') != 1) {
			redirect('supercontrol/home', 'refresh');
		}
		//$this->load->model('supercontrol/gallery_model');
		$this->load->library('image_lib');
		//****************************backtrace prevent*** START HERE*************************
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');

		$data['title'] = "Supercontrol Reset Password";
		$datamsg['titlemessage'] = "Password Reset Successfully";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/resetpassword', $datamsg);
		$this->load->view('supercontrol/footer');
	}

	function change_password()
	{
		if ($this->session->userdata('is_logged_in') != 1) {
			redirect('supercontrol/home', 'refresh');
		}
		//$this->load->model('supercontrol/gallery_model');
		$this->load->library('image_lib');
		//****************************backtrace prevent*** START HERE*************************
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');

		$data['title'] = "Supercontrol Reset Password";
		$datamsg['titlemessage'] = "Old Password does not match";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/resetpassword', $datamsg);
		$this->load->view('supercontrol/footer');
	}

	//==============================supercontrol reset Password======================================

	//==============================supercontrol Logout==============================================
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('supercontrol/main/login');
	}
	//==============================supercontrol Logout==============================================

}
?>