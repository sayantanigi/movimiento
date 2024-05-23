<?php
ob_start();
error_reporting(0);
class Community extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library(array('form_validation', 'session'));
		if ($this->session->userdata('isLoggedIn') != 1) {
			redirect('login', 'refresh');
		}
		$this->load->model('Community_model');
		$this->load->library('form_validation');
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->library('image_lib');

	}
	public function index() {
		$user = $this->session->userdata('user_id');
		$data['community'] = $this->db->get_where('community', array('uploaded_by' => $user, 'is_delete' => '1'))->result();
		$data['title'] = "Community List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/community/community_list', $data);
		$this->load->view('supercontrol/footer');
	}
    public function add_community($id = false) {
		if ($id) {
            $data['title'] = 'Update Community';
            $data['community'] = $community_v = $this->Community_model->getRow($id);
            if (!isset($community_v)) {
                show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[title]', 'Title title', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $slug = $this->input->post('frm[title]');
            if (empty($slug) || $slug == '') {
                $slug = $this->input->post('title');
            }
            $formdata['slug'] = strtolower(url_title($slug));
            $formdata['id'] = $id;
            $formdata['uploaded_by'] = $this->session->userdata('user_id');
            //print_r($formdata); die();
            $id = $this->Community_model->save($formdata);
            $this->session->set_flashdata("success", "Community saved successfully");
            redirect(base_url('supercontrol/community'));
        }
		$data['community_cat'] = $this->db->query("SELECT * FROM community_cat WHERE status = '1' AND is_delete = '1'")->result_array();
        $data['title'] = 'Community Category List';
        $data['tab'] = 'add_comm';
        $this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/community/add_community', $data);
		$this->load->view('supercontrol/footer');
    }
	function delete($id) {
        if ($id > 0) {
            $this->Community_model->delete($id);
            $this->session->set_flashdata('success', 'Community deleted successfully ');
        }
        redirect(base_url('supercontrol/community'));
    }
	public function Logout() {
		$this->session->sess_destroy();
		redirect('supercontrol/login');
	}
}
?>