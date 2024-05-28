<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class manipulation_controller extends CI_Controller {

// Load Library.
function __construct() {
	parent::__construct();
	$this->load->library('image_lib');
}

// View "manipulation_view" Page.
public function index() {
	$this->load->view('manipulation_view');
}

// Perform manipuation on image ("crop","resize","rotate","watermark".)
public function value() {
	if ($this->input->post("submit")) {
		$config = array(
			'upload_path' => "uploads1/",
			'upload_url' => base_url() . "uploads/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf"
		);
		$this->load->library('upload', $config);
		if ($this->upload->do_upload("userfile")) {
			 $data['img']	 = $this->upload->data();
			  $data['img']['file_name'];
			//print_r($data);
			exit();
		}else{
				echo "no file choosen";
		}
	
	}
}


}
?>

