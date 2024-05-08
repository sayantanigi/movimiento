<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
error_reporting(0);
class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	function index() {
		$token = base64_decode($this->uri->segment(3));
		if($token!=''){
			$array = array(
				'userid' => $token,
				'is_logged_in'=>1
			);
			$this->session->set_userdata( $array );
		}
		$session_data = $this->session->userdata('logged_in');
		$this->session->userdata('is_logged_in');
		$data['UserName'] = @$session_data['username'];
		$data2['title'] = "Dashbord";
		$this->load->view('supercontrol/header',$data2);
		$this->load->view('supercontrol/home_view', $data);
		$this->load->view('supercontrol/footer',$data);
	}
	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('supercontrol/home', 'refresh');
	}
}
?>