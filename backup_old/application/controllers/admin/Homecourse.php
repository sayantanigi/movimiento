<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Homecourse extends AI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Commonmodel');
        $this->data['title'] = 'Home Course';
        $this->data['tab'] = 'homecourse';
    }
    public function index($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Home Course';
        $this->data['tab'] = 'homecourse';
        $this->data['main'] = admin_view('homecourse/index');
        $getHomecourseSql = "SELECT * FROM `homecourse` ORDER BY `id` DESC";
        $this->data['homecourse'] = $this->Commonmodel->fetch_all_join($getHomecourseSql);
        $this->load->view(admin_view('default'), $this->data);
    }
    public function changeStatus() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'Home course activated successfully!';
            } else {
                $msg = 'Home course deactivated successfully!';
            }
            if ($this->Commonmodel->update_row('homecourse', ['status' => $status], ['id' => $id])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
    public function add($id = false) {
        $this->data['tab'] = 'add_homecourse';
        $this->data['main'] = admin_view('homecourse/add');
        $this->data['homecourse'] = $this->Commonmodel->fetch_all('homecourse');
        if ($id) {
            $this->data['title'] = 'Edit homecourse';
            $where = array('id' => $id);
            $this->data['homecourse'] = $pages = $this->Commonmodel->fetch_row('homecourse', $where);
        } else {
            $this->data['title'] = 'Add Homecourse';
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    public function homecourseSave($id = false) {
        $this->data['tab'] = 'add_homecourse';
        $this->data['main'] = admin_view('homecourse/add');
        $this->data['homecourse'] = $this->Commonmodel->fetch_all('homecourse');
        if ($id) {
            $this->data['title'] = 'Edit Home Course';
            $where = array('id' => $id);
            $this->data['homecourse'] = $pages = $this->Commonmodel->fetch_row('homecourse', $where);
        } else {
            $this->data['title'] = 'Add Home Course';
        }
        $mydata = array('heading' => $this->testInput($this->input->post('heading')), 'sub_heading' => $this->testInput($this->input->post('sub_heading')), 'course_url' => $this->testInput($this->input->post('course_url')), 'status' => 1);
        if ($_FILES['course_icon']['name'] != '') {
            $config['upload_path'] = './uploads/homecourse/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '*';
            $config['overwrite'] = false;
            $config['remove_spaces'] = TRUE;  //it will remove all spaces
            $config['encrypt_name'] = false;   //it wil encrypte the original file name
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('course_icon')) {
                $error = array('error' => $this->upload->display_errors());
                $msg = '["' . $error['error'] . '", "error", "#e50914"]';
            } else {
                // Uploaded file data 
                $fileData = $this->upload->data();
                $mydata['course_icon'] = $fileData['file_name'];
            }
        }
        $gn_user_id = $this->Commonmodel->add_details('homecourse', $mydata);
        if ($gn_user_id) {
            $msg = '["Home Course added successfully!", "success", "#36A1EA"]';
        } else {
            $msg = '["Sorry, Try again!", "error", "#e50914"]';
        }
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('homecourse'), 'refresh');
        $this->load->view(admin_view('default'), $this->data);
    }
    public function homecourseUpdate($id = false) {
        $where = array('id' => $id);
        $this->data['homecourse'] = $pages = $this->Commonmodel->fetch_row('homecourse', $where);
        $old_image = $this->input->post('old_image');
        $email = $this->testInput($this->input->post('email'));
        $password = $this->testInput($this->input->post('password'));
        $status = $this->input->post('status');
        $where = array('id' => $id);
        $mydata = array('heading' => $this->testInput($this->input->post('heading')), 'sub_heading' => $this->testInput($this->input->post('sub_heading')), 'course_url' => $this->testInput($this->input->post('course_url')));
        if ($_FILES['course_icon_edt']['name'] != '') {
            $config['upload_path'] = './uploads/homecourse/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '*';
            $config['overwrite'] = false;
            $config['remove_spaces'] = TRUE;  //it will remove all spaces
            $config['encrypt_name'] = false;   //it wil encrypte the original file name
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('course_icon_edt')) {
                $error = array('error' => $this->upload->display_errors());
                $msg = '["' . $error['error'] . '", "error", "#e50914"]';
            } else {
                // Uploaded file data 
                $fileData = $this->upload->data();
                $mydata['course_icon'] = $fileData['file_name'];
            }
        }
        $gn_user_id = $this->Commonmodel->update_row('homecourse', $mydata, $where);
        if ($old_image && $_FILES['course_icon_edt']['name'] != '') {
            if (file_exists('./uploads/homecourse/' . $old_image)) {
                @unlink('./uploads/homecourse/' . $old_image);
            }
        }
        if ($gn_user_id) {
            $msg = '["Home Course updated successfully!", "success", "#36A1EA"]';
        } else {
            $msg = '["Home Course not updated"!, "error", "#e50914"]';
        }
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('homecourse'), 'refresh');
    }
    public function deletehomecourse($id = false) {
        $where = array('id' => $id);
        $data = $this->Commonmodel->fetch_row('homecourse', $where);
        if (@$data->course_icon && file_exists('./uploads/homecourse/' . @$data->course_icon)) {
            @unlink('./uploads/homecourse/' . @$data->course_icon);
        }
        $this->Commonmodel->delete_single_con('homecourse', $where);
        $msg = '["Home Course deleted successfully.", "success", "#36A1EA"]';
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('homecourse'));
    }
    public function powerspeech($id = false) {
        $this->data['tab'] = 'powerspeech';
        $where = array('id' => '1');
        $this->data['powerspeech'] = $pages = $this->Commonmodel->fetch_row('powerspeech', $where);
        $this->data['main'] = admin_view('powerspeech/add');
        $this->data['title'] = 'powerspeech';
        $this->load->view(admin_view('default'), $this->data);
    }
    public function powerspeech_add() {
        if(empty($this->input->post('id'))) {
            $where = array('id' => $this->input->post('id'));
            $this->data['tab'] = 'powerspeech';
            $this->data['main'] = admin_view('powerspeech/add');
            $this->data['powerspeech'] = $this->Commonmodel->fetch_all('powerspeech');
            $mydata = array(
                'heading' => $this->testInput($this->input->post('heading')),
                'sub_heading' => $this->testInput($this->input->post('sub_heading')),
                'message' => $this->testInput($this->input->post('message'))
            );
            if ($_FILES['course_icon']['name'] != '') {
                $config['upload_path'] = './uploads/powerspeech/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '*';
                $config['overwrite'] = false;
                $config['remove_spaces'] = TRUE;  //it will remove all spaces
                $config['encrypt_name'] = false;   //it wil encrypte the original file name
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('course_icon')) {
                    $error = array('error' => $this->upload->display_errors());
                    $msg = '["' . $error['error'] . '", "error", "#e50914"]';
                } else {
                    $fileData = $this->upload->data();
                    $mydata['icon'] = $fileData['file_name'];
                }
            }
            $gn_user_id = $this->Commonmodel->add_details('powerspeech', $mydata);
            if ($gn_user_id) {
                $msg = '["Data added successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["Sorry, Try again!", "error", "#e50914"]';
            }
            $this->session->set_flashdata('msg', $msg);
            redirect(admin_url('homecourse/powerspeech'), 'refresh');
            $this->load->view(admin_view('default'), $this->data);
        } else {
            $where = array('id' => $this->input->post('id'));
            $this->data['powerspeech'] = $pages = $this->Commonmodel->fetch_row('powerspeech', $where);
            $old_image = $this->input->post('old_image');
            $mydata = array(
                'heading' => $this->testInput($this->input->post('heading')),
                'sub_heading' => $this->testInput($this->input->post('sub_heading')),
                'message' => $this->testInput($this->input->post('message'))
            );
            if ($_FILES['course_icon_edt']['name'] != '') {
                $config['upload_path'] = './uploads/powerspeech/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '*';
                $config['overwrite'] = false;
                $config['remove_spaces'] = TRUE;  //it will remove all spaces
                $config['encrypt_name'] = false;   //it wil encrypte the original file name
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('course_icon_edt')) {
                    $error = array('error' => $this->upload->display_errors());
                    $msg = '["' . $error['error'] . '", "error", "#e50914"]';
                } else {
                    // Uploaded file data 
                    $fileData = $this->upload->data();
                    $mydata['icon'] = $fileData['file_name'];
                }
            }
            $gn_user_id = $this->Commonmodel->update_row('powerspeech', $mydata, $where);
            if ($old_image && $_FILES['course_icon_edt']['name'] != '') {
                if (file_exists('./uploads/powerspeech/' . $old_image)) {
                    @unlink('./uploads/powerspeech/' . $old_image);
                }
            }
            if ($gn_user_id) {
                $msg = '["Data updated successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["Data not updated"!, "error", "#e50914"]';
            }
            $this->session->set_flashdata('msg', $msg);
            redirect(admin_url('homecourse/powerspeech'), 'refresh');
        }
    }
}