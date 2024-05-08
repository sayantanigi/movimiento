<?php
class Application extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('individual_model');
	}

	function index(){
		$this->load->library('form_validation');
	 }

}

?>

