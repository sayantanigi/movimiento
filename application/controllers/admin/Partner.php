<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends AI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Gallery_model');

		$config['upload_path']          = './assets/images/gallery';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);
        $this->data['title'] = '';
        $this->data['tab'] = '';
    }
	public function index($page = 1)
	{	
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$show_per_page = 20;
		$offset = ($page - 1) * $show_per_page;
		$this->data['title'] = 'Partner List';
		$this->data['tab'] = 'gallery';
		$this->data['main'] = admin_view('gallery/index');
		$gallery = $this->Gallery_model->getAll($offset, $show_per_page,'gallery');
		//echo $this->db->last_query();die();
		$this->data['gallery'] = $gallery['results'];
		$config['base_url'] = admin_url('partner/index');
		$config['num_links'] = 2;
		$config['uri_segment'] = 4;
		$config['total_rows'] = $gallery['total'];
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

	public function add($id = false){
		$this->data['title'] = 'Add Partner';
		$this->data['tab'] = 'ad_gallery';
		$this->data['main'] = admin_view('gallery/add');
		$this->data['gallery'] = $this->Master_model->getNew('gallery');
		if ($id) {
			$this->data['gallery'] = $gallery = $this->Master_model->getRow($id,'gallery');
			if(!isset($gallery)){
				redirect(site_url('404_override'));
				exit();
			}
		}
		
		
		if ($this->input->post()) {
			$formdata['id'] = $id;
			$formdata['status'] = $this->input->post('status');
			if ($this->upload->do_upload('image'))
			{
				$data = $this->upload->data();
				$formdata['image'] = $data['file_name'];
			}
			$id = $this->Gallery_model->save($formdata,'gallery');
			//echo $this->db->last_query();die();
			$this->session->set_flashdata("success", "Partner detail saved");
			redirect(admin_url('partner/index'));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

	function activate($id = false)
	{
		$redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('partner');
		if ($id) {
			$c['id'] = $id;
			$c['status'] = 1;
			$this->Gallery_model->save($c,'gallery');
			$this->session->set_flashdata("success", "Partner activated");
		}
		redirect($redirect);
	}

	function deactivate($id = false)
	{
		$redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('partner');
		if ($id) {
			$c['id'] = $id;
			$c['status'] = 0;
			$this->Gallery_model->save($c,'gallery');
			$this->session->set_flashdata("success", "Partner deactivated");
		}
		redirect($redirect);
	}

	function delete($id){
		if ($id > 0) {
			$this->Gallery_model->delete($id,'gallery');
			$this->session->set_flashdata('success', 'Partner deleted successfully ');
		}
		redirect(admin_url('partner'));
	}


	

}

/* End of file Gallery.php */
/* Location: ./application/controllers/admin/Gallery.php */