<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $favicon;
	public $logo;
	public $cms;
	public $msg;

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('date', 'english');
		$this->load->model('usermodel');
	}


	public function loggedIn()
	{
		if (!$this->session->has_userdata('admin_id') || !$this->session->has_userdata('admin')) {
			$redirectto = urlencode(current_url());
			redirect(base_url('admin/login?redirectto='.$redirectto),'refresh');
		}
	}

	public function isLoggedIn()
	{
		if (!$this->session->has_userdata('user_id') || !$this->session->has_userdata('users')) {
			$redirectto = urlencode(current_url());
			redirect(base_url('login?redirectto='.$redirectto),'refresh');
		}
	}


	public function testInput($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


	public function uw($data)
	{
		$data = $this->testInput($data);
		$data = ucwords(strtolower($data));
		return $data;
	}


	public function uc($data)
	{
		$data = $this->testInput($data);
		$data = strtoupper($data);
		return $data;
	}


	public function lc($data)
	{
		$data = $this->testInput($data);
		$data = strtolower($data);
		return $data;
	}


	public function removeNull($array)
	{
		array_walk_recursive($array, function (&$array, $key){
			$array = (null === $array)? '' : $array;
		});
		return $array;
	}


	public function enc_password($password)
	{
		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		return $encrypted_password;
	}


	public function generate_otp($length = 6)
	{
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}


	public function mail($data)
	{
		$this->load->library('email');

		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		$this->email->from('no_reply@goigi.com', 'Goigi');
		$this->email->to($data['email']);

		$this->email->subject($data['subject'].' | '.'Goigi');
		$this->email->message($data['msg']);

		if ($this->email->send()) {
			return true;
		} else {
			return true;
		}
	}
}