<?php
defined('BASEPATH') or exit('No direct script access allowed');
//error_reporting(0);
class Email_templete extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->admin_login();
        $this->load->model('User_model');
        $this->load->model('Commonmodel');
        $this->load->model('Email_templete_model');
        $this->load->model('Cms_model');
        $this->data['title'] = 'Email Templete';
        $this->data['tab'] = 'email_templete';
        $config['upload_path'] = './assets/images/profile';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);
    }
    public function index($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Email Template';
        $this->data['tab'] = 'email_templete';
        $this->data['main'] = admin_view('email_templete/index');
        $email_templete = $this->Email_templete_model->getAll($offset, $show_per_page);
        $this->data['email_templete'] = $email_templete['results'];
        $config['base_url'] = admin_url('email_templete/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $email_templete['total'];
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
    public function add($id = false) {
        $this->data['tab'] = 'add_email_templete';
        $this->data['main'] = admin_view('email_templete/add');
        if ($id) {
            $this->data['title'] = 'Edit Email Template';
            $this->data['email_templete'] = $pages = $this->db->query("SELECT * FROM email_templete WHERE id = '".$id."'")->row();
            if (!isset($pages)) {
                redirect(site_url('error_404'));
                exit();
            }
        } else {
            $this->data['title'] = 'Add Email Template';
            $this->form_validation->set_rules('name', 'Email Template Name', 'trim|required');
        }
        if ($this->form_validation->run()) {
            $name = $this->input->post('name');
            $subject = $this->input->post('subject');
            $content = $this->input->post('content');
            $status = $this->input->post('status');
            $mydata = array(
                'name' => $name,
                'subject' => $subject,
                'content' => $content,
                'status' => $status,
                'created_date' => date("Y-m-d h:i:s")
            );
            /*if ($_FILES['email_templete_img']['name'] != '') {
                $config['upload_path'] = './uploads/email_templete/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '*';
                $config['overwrite'] = false;
                $config['remove_spaces'] = TRUE;  //it will remove all spaces
                $config['encrypt_name'] = false;   //it wil encrypte the original file name
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('email_templete_img')) {
                    $error = array('error' => $this->upload->display_errors());
                    $msg = '["' . $error['error'] . '", "error", "#e50914"]';
                } else {
                    $fileData = $this->upload->data();
                    $mydata['email_templete_img'] = $fileData['file_name'];
                }
            }*/
            //echo "<pre>"; print_r($mydata); die();
            $result = $this->Commonmodel->add_details('email_templete', $mydata);
            if ($result) {
                $msg = '["Email Template added successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["Email Template already exist!", "error", "#e50914"]';
            }
            $this->session->set_flashdata('msg', $msg);
            redirect(admin_url('email_templete'), 'refresh');
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    public function email_templeteUpdate($id = false) {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        if ($this->form_validation->run()) {
            $name = $this->input->post('name');
            $subject = $this->input->post('subject');
            $content = $this->input->post('content');
            $status = $this->input->post('status');
            $where = array('id' => $id);
            $mydata = array(
                'name' => $name,
                'subject' => $subject,
                'content' => $content,
                'status' => $status,
                'created_date' => date("Y-m-d h:i:s")
            );
            $gn_user_id = $this->Commonmodel->update_row('email_templete', $mydata, $where);
            if ($gn_user_id) {
                $msg = '["Email Template updated successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["Email Template not updated"!, "error", "#e50914"]';
            }
        }
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('email_templete'), 'refresh');
    }

    public function ck_upload() {
        if(isset($_FILES['upload']['name'])) {
            $file = $_FILES['upload']['name'];
            $filetmp = $_FILES['upload']['tmp_name'];
            //echo 'sayantan'.$file; die;
            //echo dirname(__FILE__); die;
            move_uploaded_file($filetmp,'uploads/ckeditor/'.$file);
            $function_number=$_GET['CKEditorFuncNum'];
            $url=base_url().'uploads/ckeditor/'.$file;
            $message='';
            echo "<script>window.parent.CKEDITOR.tools.callFunction('".$function_number."','".$url."','".$message."');</script>";     
        }
    }
    public function changeStatus() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'Email Template activated successfully!';
            } else {
                $msg = 'Email Template deactivated successfully!';
            }
            if ($this->Commonmodel->update_row('email_templete', ['status' => $status], ['id' => $id])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
    public function deleteEvent($id = false) {
        $data = $this->db->query("SELECT * FROM email_templete WHERE id = '".$id."'")->row();
        // if (@$data->image && file_exists('./uploads/event/' . @$data->image)) {
        //     @unlink('./uploads/event/' . @$data->image);
        // }
        $this->db->query("DELETE FROM email_templete WHERE id = '".$id."'");
        $msg = '["Deleted successfully.", "success", "#36A1EA"]';
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('email_templete'));
    }
}