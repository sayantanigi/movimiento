<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Admin_Controller extends CI_Controller
{
    var $is_login;
    function __construct()
    {
        parent::__construct();

        $this->data['active_tabs']     = 'dashboard';
        $this->data['dashboard_title'] = 'Dashboard';
        $this->load->library(array(
            'pagination'
        ));
    }

    
    function admin_login(){
        if (!$this->session->userdata('userid')) {
            $this->session->set_flashdata('errormsg', 'Session out!! Please login agin');
            redirect(admin_url('users/login'));
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
}

class AI_Controller extends CI_Controller
{
    var $data, $login, $email;
    var $user = false;
    var $city = false;
    var $cart = array();
    function __construct()
    {
        parent::__construct();

        $this->data['seo_description'] = '';
        $this->data['seo_keywords']    = '';
        $this->data['og_image']        = base_url('assets/img/logo.png');
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

    
}

