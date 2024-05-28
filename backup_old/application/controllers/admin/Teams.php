<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teams extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->data['header'] = '';
        $this->admin_login();
        $config['upload_path']          = './assets/images/teams';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);
        $this->load->model('Teams_model');
	}

	public function index($page=1)
	{
		if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Team Member List';
        $this->data['tab'] = 'teams';
        $this->data['main'] = admin_view('teams/index');
        $products = $this->Teams_model->getAll($offset, $show_per_page);
        $this->data['products'] = $products['results'];
        $config['base_url'] = admin_url('teams/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $products['total'];
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

	public function add($id=false)
	{
        $this->data['title'] = 'Add Teams';
        $this->data['tab'] = 'add_teams';
		$this->data['main'] = admin_view('teams/add');
		$this->data['product'] = $this->Teams_model->getNew();
        $this->data['product']->gender = "Male";
        if ($id) {
            $this->data['product'] = $product = $this->Teams_model->getRow($id);
            if(!isset($product)){
               show_404();
                exit();
            }
        }
		$this->form_validation->set_rules('frm[name]', 'Product title', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			$formdata['id'] = $id;
			//$images = $this->input->post('image');
			if ($this->upload->do_upload('img'))
			{
				$data = $this->upload->data();
				$formdata['img'] = $data['file_name'];
			}
			
			$id = $this->Teams_model->save($formdata);
			$this->session->set_flashdata("success", "Teams saved successfully");
            redirect(admin_url('teams/add/' . $id));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('products');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Teams_model->save($c);
            $this->session->set_flashdata("success", "Products activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('products');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Teams_model->save($c);
            $this->session->set_flashdata("success", "Products deactivated");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->Teams_model->delete($id);
            $this->session->set_flashdata('success', 'Teams deleted successfully ');
        }
        redirect(admin_url('teams'));
	}

}

/* End of file teams.php */
/* Location: ./application/controllers/admin/teams.php */