<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programme extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->data['header'] = '';
        $this->admin_login();
        $config = array(
			'upload_path' => "./uploads/programme/",
			'upload_url' => base_url() . "./uploads/programme/",
			'allowed_types' => "gif|jpg|png|jpeg"
		);
		$this->load->library('upload', $config);
        $this->load->model('Programme_model');
	}

	public function index($page=1) {
		if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Programme';
        $this->data['tab'] = 'programme_forum';
        $this->data['main'] = admin_view('programme/index');
        $programme = $this->Programme_model->getAll($offset, $show_per_page);
        //echo $this->db->last_query();
        $this->data['programme'] = $programme['results'];
        $config['base_url'] = admin_url('programme/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $programme['total'];
        $config['per_page'] = $show_per_page;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['use_page_numbers'] = true;
        $config['use_page_numbers'] = true;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string'] = true;

        $this->pagination->initialize($config);
        $this->data['paginate'] = $this->pagination->create_links();
		$this->load->view(admin_view('default'),$this->data);
	}
	public function add($id=false) {
        $this->data['title'] = 'Add Programme';
        $this->data['tab'] = 'add_programme_forum';
		$this->data['main'] = admin_view('programme/add');
		$this->data['programme'] = $this->Programme_model->getNew();
        // echo $this->db->last_query();die();
        $this->data['programme']->gender = "Male";
        if ($id) {
            $this->data['programme'] = $programme_v = $this->Programme_model->getRow($id);
            if(!isset($programme_v)){
               show_404();
                exit();
            }
        }
		$this->form_validation->set_rules('frm[title]', 'Programme Name', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            $formdata['status'] = '1';
            $formdata['created_at'] = date('Y-m-d h:i');
			//echo "<pre>"; print_r($formdata); die();
            $id = $this->Programme_model->save($formdata);
			$this->session->set_flashdata("success", "Programme saved successfully");
            redirect(admin_url('programme'));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}
    function activate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('programme');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Programme_model->save($c);
            $this->session->set_flashdata("success", "Programme activated");
        }
        redirect($redirect);
    }
    function deactivate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('programme');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Programme_model->save($c);
            $this->session->set_flashdata("success", "Programme deactivated");
        }
        redirect($redirect);
    }
	function delete($id){
		if ($id > 0) {
            $this->Programme_model->delete($id);
            $this->session->set_flashdata('success', 'Programme deleted successfully ');
        }
        redirect(admin_url('programme'));
	}
}
/* End of file Blog.php */
/* Location: ./application/controllers/admin/teams.php */