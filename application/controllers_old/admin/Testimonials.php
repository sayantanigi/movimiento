<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->admin_login();
        $this->load->model('Testimonial_model');

		$config['upload_path']          = './assets/images/testimonial';
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
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Testimonials';
        $this->data['tab'] = 'testimonials';
        $this->data['main'] = admin_view('testimonial/index');
        $testimonials = $this->Testimonial_model->getAll($offset, $show_per_page);
        // if ($this->input->get('btnsearch')) {
        //     $q = $this->input->get('q');
        //     if ($q <> '') {
        //         $likes = array(
        //             'first_name' => $q, 'last_name' => $q, 'email_id' => $q
        //         );
        //         $members = $this->Testimonial_model->getAllSearched($offset, $show_per_page, $likes);
        //     }
        // }
        $this->data['testimonials'] = $testimonials['results'];
        $config['base_url'] = admin_url('testimonial/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $testimonials['total'];
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
        $this->data['title'] = 'Add Testimonials';
        $this->data['tab'] = 'add_testimonials';
		$this->data['main'] = admin_view('testimonial/add');
		$this->data['testimonial'] = $this->Testimonial_model->getNew();
        $this->data['testimonial']->gender = "Male";
        if ($id) {
            $this->data['testimonial'] = $testimonial = $this->Testimonial_model->getRow($id);
            if(!isset($testimonial)){
               show_404();
                exit();
            }
        }
		$this->form_validation->set_rules('frm[name]', 'Name', 'required');
		$this->form_validation->set_rules('frm[designation]', 'Designation', 'required');
		if ($this->form_validation->run()) {
			$formdata = $this->input->post('frm');
			$formdata['id'] = $id;
			//$images = $this->input->post('image');
			if ($this->upload->do_upload('image'))
			{
				$data = $this->upload->data();
				$formdata['image'] = $data['file_name'];
			}
			
			$id = $this->Testimonial_model->save($formdata);
			$this->session->set_flashdata("success", "Testimonial detail saved");
            redirect(admin_url('testimonials/add/' . $id));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

    function activate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('testimonials');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Testimonial_model->save($c);
            $this->session->set_flashdata("success", "Testimonial activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false)
    {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('testimonials');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Testimonial_model->save($c);
            $this->session->set_flashdata("success", "Testimonial deactivated");
        }
        redirect($redirect);
    }

	function delete($id){
		if ($id > 0) {
            $this->Testimonial_model->delete($id);
            $this->session->set_flashdata('success', 'Testimonial deleted successfully ');
        }
        redirect(admin_url('testimonials'));
	}

}               

/* End of file Testimonials.php */
/* Location: ./application/controllers/admin/Testimonials.php */