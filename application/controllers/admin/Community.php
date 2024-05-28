<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Community extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data['header'] = '';
        $this->admin_login();
        $this->load->model('Community_model');
        $this->load->model('Community_cat_model');
    }

    public function index($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Community List';
        $this->data['tab'] = 'community';
        $this->data['main'] = admin_view('community/index');
        $community = $this->Community_model->getAll($offset, $show_per_page);
        //echo $this->db->last_query();
        $this->data['community'] = $community['results'];
        $config['base_url'] = admin_url('community/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $community['total'];
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
    public function category() {
        $this->data['title'] = 'Community Category List';
        $this->data['tab'] = 'comcat_list';
        $this->data['main'] = admin_view('community/category_index');
        $this->data['community_cat'] = $this->db->query("SELECT * FROM community_cat WHERE status IN ('1','2')")->result();
        $this->load->view(admin_view('default'), $this->data);
    }
    public function category_add($id = false) {
        $this->data['title'] = 'Add Category';
        $this->data['tab'] = 'add_comcat';
        $this->data['main'] = admin_view('community/category_add');
        $this->form_validation->set_rules('frm[category_name]', 'Category title', 'required');
        if ($id) {
            $this->data['community_cat'] = $this->db->query("SELECT * FROM community_cat WHERE id = '".$id."'")->row();
            $this->data['title'] = 'Update Category';
        }
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            if ($_FILES['category_image']['name'] != '') {
                $config['upload_path'] = './uploads/community/category/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
                $config['max_size'] = '*';
                $config['overwrite'] = false;
                $config['remove_spaces'] = TRUE;  //it will remove all spaces
                $config['encrypt_name'] = TRUE;   //it wil encrypte the original file name
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('category_image')) {
                    $error = array('error' => $this->upload->display_errors());
                    $msg = '["' . $error['error'] . '", "error", "#e50914"]';
                } else {
                    $fileData = $this->upload->data();
                    $formdata['category_image'] = $fileData['file_name'];
                }
            }
            $id = $this->Community_cat_model->save($formdata);
            if ($id) {
                $msg = '["Category added successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["Sorry, Record not saved!", "error", "#e50914"]';
            }
            $this->session->set_flashdata('msg', $msg);
            redirect(admin_url('community/category'));
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    function delete_category($id = false) {
        if ($id > 0) {
            $checkcathascommunit = $this->db->query("SELECT * FROM community WHERE cat_id = '".$id."'")->result_array();
            if(!empty($checkcathascommunit)) {
                $this->session->set_flashdata('warning', 'Category is belogs to community');
                redirect(admin_url('course/category'));
            } else {
                $this->community_model->delete($id, 'community_cat');
                $this->session->set_flashdata('success', 'Category deleted successfully ');
            }
        }
        redirect(admin_url('community/category'));
    }
    public function add_community($id = false) {
        $this->data['title'] = 'Add Community';
        $this->data['tab'] = 'add_comm';
        $this->data['main'] = admin_view('community/add');
        $this->data['community'] = $this->Community_model->getNew();
        //$this->data['community_cat'] = $this->db->query("SELECT * FROM community_cat WHERE status = '1' AND is_delete = '1'")->result_array();
        $this->data['course_list'] = $this->db->query("SELECT * FROM courses WHERE status = '1' AND (assigned_instrustor IS NOT NULL OR assigned_instrustor != '')")->result_array();
        $this->data['community']->gender = "Male";
        if ($id) {
            $this->data['title'] = 'Update Community';
            $this->data['community'] = $community_v = $this->Community_model->getRow($id);
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
            $formdata['uploaded_by'] = '';
            //print_r($formdata); die();
            $id = $this->Community_model->save($formdata);
            $this->session->set_flashdata("success", "Community saved successfully");
            redirect(admin_url('community'));
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    function activate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('community');
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
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('community');
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
        redirect(admin_url('community'));
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
            redirect(admin_url('community/event_list/'.$com_id));
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    public function event_list($comm_id){
        $this->data['title'] = 'Community Event List';
        $this->data['tab'] = 'community';
        $this->data['main'] = admin_view('community/event_index');
        $this->data['event_list'] = $this->db->query("SELECT * FROM events WHERE community_id = '".$comm_id."'")->result_array();
        $this->load->view(admin_view('default'), $this->data);
    }
    function eventactivate($com_id = false, $id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('community/event_list/'.$com_id);
        if ($id) {
            $c['event_status'] = 1;
            $this->db->where('id', $id);
            $this->db->update('events', $c);
            $this->session->set_flashdata("success", "Event activated");
        }
        redirect($redirect);
    }
    function eventdeactivate($com_id = false, $id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('community/event_list/'.$com_id);
        if ($id) {
            $c['event_status'] = 2;
            $this->db->where('id', $id);
            $this->db->update('events', $c);
            $this->session->set_flashdata("success", "Event deactivated");
        }
        redirect($redirect);
    }
    function eventdelete($com_id, $id) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('community/event_list/'.$com_id);
        if ($id > 0) {
            $c['id'] = $id;
            $this->db->delete('events', $c);
            $this->session->set_flashdata('success', 'Event deleted successfully ');
        }
        redirect($redirect);
    }
}