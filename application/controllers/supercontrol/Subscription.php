<?php
ob_start();
error_reporting(0);
class Subscription extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library(array('form_validation', 'session'));
		if ($this->session->userdata('isLoggedIn') != 1) {
			redirect('login', 'refresh');
		}
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
		$data['subscription'] = $this->generalmodel->getAllData('subscription', 'status =', '1', '', '');
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/subscription/showallsubscriptionlist', $data);
		$this->load->view('supercontrol/footer');
	}
	function userSubscription(){
        $getUsename = $this->db->query("SELECT * FROM users WHERE status = '1' and email_verified = '1' AND id = '".$_POST['user_id']."'")->row();
        $getSubDetails = $this->db->query("SELECT * FROM subscription WHERE id = '".$_POST['subscription_id']."'")->row();
        $_SESSION['subscription_id'] = $getSubDetails->id;
		/*$paymentDate = date('Y-m-d H:i:s');
		$n=24;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
		$data = array(
			'employer_id' => $getUsename->id,
			'subscription_id' => $getSubDetails->id,
			'name_of_card' => $getSubDetails->subscription_name,
			'email' => $getUsename->email,
			'amount' => $getSubDetails->subscription_amount,
			'duration' => $getSubDetails->subscription_duration,
			'transaction_id' => "sub_".$randomString,
			'payment_date' => $paymentDate,
			'created_date' => $paymentDate,
			'payment_status' => 'paid',
            'expiry_date' => date('Y-m-d', strtotime('+30 days', strtotime($paymentDate)))
		);
        print_r($data); die();
		$this->Crud_model->SaveData('employer_subscription', $data);
		$insert_id = $this->db->insert_id();
		if(!empty($insert_id)) {
			echo '1';
		} else {
			echo '2';
		}*/
        echo $payment_link = $getSubDetails->payment_link;
	}
    public function stripe($price_key) {
        $data['amount']= base64_decode($price_key);
        $this->load->view('header');
        $this->load->view('supercontrol/subscription/product_form',$data);
        $this->load->view('footer');
    }
    public function thank_you($id) {
        $data['s_id'] = $id;
        $this->load->view('supercontrol/header');
		$this->load->view('supercontrol/subscription/thank_you', $data);
		$this->load->view('supercontrol/footer');
    }
    public function purchased_subscription() {
        $data['sub_data'] = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".@$_SESSION['user_id']."'")->result_array();
        $this->load->view('supercontrol/header');
		$this->load->view('supercontrol/subscription/purchased_subscription', $data);
		$this->load->view('supercontrol/footer');
    }
}
?>