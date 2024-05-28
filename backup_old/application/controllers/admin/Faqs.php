<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Faqs extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Faq_model');
        $this->admin_login();
        $this->data['title'] = 'FAQS';
        $this->data['tab'] = 'faqs';
        $config['upload_path'] = './assets/images/faq';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);
    }
    public function add($id = false) {
        $this->data['main'] = admin_view('faqs/add');
        $this->data['faq'] = $this->Faq_model->getNew();
        $this->data['faq']->gender = "Male";
        $this->data['tab'] = 'add_faqs';
        if ($id) {
            $this->data['faq'] = $faq = $this->Faq_model->getRow($id);
            if (!isset($faq)) {
                redirect(site_url('404_override'));
                exit();
            }
        }
        if ($this->input->post('submit') != "") {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            $id = $this->Faq_model->save($formdata);
            $this->session->set_flashdata("success", "FAQ detail saved");
            redirect(admin_url('faqs'));
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    public function index($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['main'] = admin_view('faqs/index');
        $contact = $this->Master_model->getAll($offset, $show_per_page, 'faqs');
        $this->data['faqs'] = $contact['results'];
        $config['base_url'] = admin_url('faqs/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $contact['total'];
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
        $this->load->view(admin_view('default'), $this->data);
    }
    function delete($id) {
        if ($id > 0) {
            $this->Faq_model->delete($id, 'faqs');
            $this->session->set_flashdata('success', 'Faqs deleted successfully ');
        }
        redirect(admin_url('faqs'));
    }
}
/* End of file Faqs.php */
/* Location: ./application/controllers/admin/Faqs.php */