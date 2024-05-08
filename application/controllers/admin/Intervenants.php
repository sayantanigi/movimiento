<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intervenants extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->data['header'] = '';
        $this->admin_login();
        $config['upload_path']          = './uploads/intervenants/';
		$config['allowed_types']        = '*';
		//$config['max_size']             = 1024;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
		$this->load->library('upload', $config);
        $this->load->model('Intervenants_model');
	}

	public function index($page=1) {
		if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Intervenants List';
        $this->data['tab'] = 'intervenants';
        $this->data['main'] = admin_view('intervenants/index');
        $intervenants = $this->Intervenants_model->getAll($offset, $show_per_page);
        $this->data['intervenants'] = $intervenants['results'];
        $config['base_url'] = admin_url('intervenants/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $intervenants['total'];
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
        $this->data['title'] = 'Add Intervenants';
        $this->data['tab'] = 'add_intervenants';
		$this->data['main'] = admin_view('intervenants/add');
		$this->data['intervenants'] = $this->Intervenants_model->getNew();
        $this->data['intervenants']->gender = "Male";
        if ($id) {
            $this->data['intervenants'] = $intervenants = $this->Intervenants_model->getRow($id);
            if(!isset($intervenants)){
               show_404();
                exit();
            }
        }
		$this->form_validation->set_rules('frm[name]', 'Name', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			$formdata['id'] = $id;
			//$images = $this->input->post('image');
			if ($this->upload->do_upload('profilePics')) {
				$data = $this->upload->data();
				$formdata['profilePics'] = $data['file_name'];
			}
			//print_r($formdata); die();
			$id = $this->Intervenants_model->save($formdata);
			$this->session->set_flashdata("success", "Intervenants saved successfully");
            redirect(admin_url('intervenants'));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('intervenants');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Intervenants_model->save($c);
            $this->session->set_flashdata("success", "intervenant activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('intervenants');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Intervenants_model->save($c);
            $this->session->set_flashdata("success", "intervenant deactivated");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->Intervenants_model->delete($id);
            $this->session->set_flashdata('success', 'Intervenants deleted successfully ');
        }
        redirect(admin_url('intervenants'));
	}

}

/* End of file intervenants.php */
/* Location: ./application/controllers/admin/intervenants.php */