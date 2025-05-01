<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->session->userdata('bayhill')) {
			redirect('login');
		}
	}
	public function index() {
        $loggedinUID = $_SESSION['bayhill']['user_id'];
        $getPurchasedCourseList = $this->db->query("SELECT * FROM booking WHERE user_id = '".$loggedinUID."'")->result();
        $data = array(
            'title' => 'Bay Hill Driving School',
            'page' => 'User Dashboard',
            'subpage' => 'User Dashboard',
            'getPurchasedCourseList' => $getPurchasedCourseList
        );
        $this->load->view('header', $data);
		$this->load->view('users/dashboard');
		$this->load->view('footer');
	}
    public function logout() {
	    unset($_SESSION['bayhill']);
        $this->session->set_flashdata('message', 'You have logged out.');
        redirect('login');
	}
}