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
		//$data['community_cat'] = $this->db->query("SELECT * FROM community_cat WHERE status = '1' AND is_delete = '1'")->result_array();
        $data['course_list'] = $this->db->query("SELECT * FROM courses WHERE user_id = '".$this->session->userdata('user_id')."' AND status = '1'")->result_array();
        $data['title'] = 'Community Category List';
        $data['tab'] = 'add_comm';
        $this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/community/add_community', $data);
		$this->load->view('supercontrol/footer');
    }
    function activate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : base_url('supercontrol/community/');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Community_model->save($c);
            $this->session->set_flashdata("success", "Community activated");
        }
        redirect($redirect);
    }
    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : base_url('supercontrol/community/');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Community_model->save($c);
            $this->session->set_flashdata("success", "Community deactivated");
        }
        redirect($redirect);
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
    public function add_event($com_id = false, $id = false) {
        $this->data['title'] = 'Add Community Event';
        $this->data['tab'] = 'add_comm_evnt';
        $this->data['main'] = admin_view('community/add_event');
        if ($id) {
            $this->data['title'] = 'Update Community Event';
            $this->data['event'] = $event_v = $this->db->query("SELECT * FROM events WHERE id = '".$id."'")->row();
            if (!isset($event_v)) {
                show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[event_title]', 'Title title', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $slug = $this->input->post('frm[event_title]');
            if (empty($slug) || $slug == '') {
                $slug = $this->input->post('event_title');
            }
            $formdata['slug'] = strtolower(url_title($slug));
            //$formdata['id'] = $id;
            $formdata['uploaded_by'] = '';
            if ($id) {
                $this->db->where('id', $id);
                $id = $this->db->update('events',$formdata);
                $this->session->set_flashdata("success", "Event updated successfully");
            } else {
                //print_r($formdata); die();
                $id = $this->db->insert('events',$formdata);
                $this->session->set_flashdata("success", "Event saved successfully");
            }
            redirect(base_url('community/event_list/'.$com_id));
        }
        $this->load->view('supercontrol/header', $this->data);
		$this->load->view('supercontrol/community/add_event', $this->data);
		$this->load->view('supercontrol/footer');
    }
    public function event_list($comm_id){
        $this->data['title'] = 'Community Event List';
        $this->data['tab'] = 'community';
        $this->data['main'] = admin_view('community/event_index');
        $this->data['event_list'] = $this->db->query("SELECT * FROM events WHERE community_id = '".$comm_id."'")->result_array();
        $this->load->view('supercontrol/header', $this->data);
		$this->load->view('supercontrol/community/event_list', $this->data);
		$this->load->view('supercontrol/footer');
    }
    function eventactivate($com_id = false, $id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : base_url('community/event_list/'.$com_id);
        if ($id) {
            $c['event_status'] = 1;
            $this->db->where('id', $id);
            $this->db->update('events', $c);
            $this->session->set_flashdata("success", "Event activated");
        }
        redirect($redirect);
    }
    function eventdeactivate($com_id = false, $id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : base_url('community/event_list/'.$com_id);
        if ($id) {
            $c['event_status'] = 2;
            $this->db->where('id', $id);
            $this->db->update('events', $c);
            $this->session->set_flashdata("success", "Event deactivated");
        }
        redirect($redirect);
    }
    function eventdelete($com_id, $id) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : base_url('community/event_list/'.$com_id);
        if ($id > 0) {
            $c['id'] = $id;
            $this->db->delete('events', $c);
            $this->session->set_flashdata('success', 'Event deleted successfully ');
        }
        redirect($redirect);
    }
}
?>