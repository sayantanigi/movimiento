<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Banner extends AI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Commonmodel');
        $this->data['title'] = 'Banner';
        $this->data['tab'] = 'banner';
    }

    public function index($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 20;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Banner';
        $this->data['tab'] = 'banner';
        $this->data['main'] = admin_view('banner/index');
        $getBannerSql = "SELECT * FROM `banner` ORDER BY `id` DESC";
        $this->data['banners'] = $this->Commonmodel->fetch_all_join($getBannerSql);
        $this->load->view(admin_view('default'), $this->data);
    }

    public function changeStatus() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'Banner activated successfully!';
            } else {
                $msg = 'Banner deactivated successfully!';
            }
            if ($this->Commonmodel->update_row('banner', ['status' => $status], ['id' => $id])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }


    public function add($id = false) {
        $this->data['tab'] = 'add_banner';
        $this->data['main'] = admin_view('banner/add');
        $this->data['banner'] = $this->Commonmodel->fetch_all('banner');
        if ($id) {
            $this->data['title'] = 'Edit Banner';
            $where = array('id'=>$id);
            $this->data['banner'] = $pages = $this->Commonmodel->fetch_row('banner', $where);
        } else {
            $this->data['title'] = 'Add Banner';
        }
        $this->load->view(admin_view('default'), $this->data);
    }

    public function bannerSave($id = false) {
        $this->data['tab'] = 'add_banner';
        $this->data['main'] = admin_view('banner/add');
        $this->data['banner'] = $this->Commonmodel->fetch_all('banner');
        if ($id) {
            $this->data['title'] = 'Edit Banner';
            $where = array('id'=>$id);
            $this->data['banner'] = $pages = $this->Commonmodel->fetch_row('banner', $where);
        } else {
            $this->data['title'] = 'Add Banner';
        }

        $mydata = array('heading' => $this->testInput($this->input->post('heading')),'sub_heading' => $this->testInput($this->input->post('sub_heading')),'banner_url' => $this->testInput($this->input->post('banner_url')),'status' => 1);

        if ($_FILES['banner_image']['name'] != '') {
            $config['upload_path'] = './uploads/banners/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '*';
            $config['overwrite'] = false;
            $config['remove_spaces'] = TRUE;  //it will remove all spaces
            $config['encrypt_name'] = false;   //it wil encrypte the original file name
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('banner_image')) {
                $error = array('error' => $this->upload->display_errors());
                $msg = '["' . $error['error'] . '", "error", "#e50914"]';
            } else {
                // Uploaded file data 
                $fileData = $this->upload->data();
                $mydata['banner_image'] = $fileData['file_name'];
            }
        }
        $gn_user_id = $this->Commonmodel->add_details('banner', $mydata);
        if ($gn_user_id) {
            $msg = '["Banner added successfully!", "success", "#36A1EA"]';
        } else {
            $msg = '["Sorry, Try again!", "error", "#e50914"]';
        }
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('banner'), 'refresh');
        $this->load->view(admin_view('default'), $this->data);
    }

    public function bannerUpdate($id = false) {
        $where = array('id'=>$id);
        $this->data['banner'] = $pages = $this->Commonmodel->fetch_row('banner', $where);
        $old_image = $this->input->post('old_image');
        $email = $this->testInput($this->input->post('email'));
        $password = $this->testInput($this->input->post('password'));
        $status = $this->input->post('status');
        $where = array('id'=>$id);
        $mydata = array('heading' => $this->testInput($this->input->post('heading')),'sub_heading' => $this->testInput($this->input->post('sub_heading')),'banner_url' => $this->testInput($this->input->post('banner_url')));
        if ($_FILES['banner_image_edt']['name'] != '') {
            $config['upload_path'] = './uploads/banners/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '*';
            $config['overwrite'] = false;
            $config['remove_spaces'] = TRUE;  //it will remove all spaces
            $config['encrypt_name'] = false;   //it wil encrypte the original file name
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('banner_image_edt')) {
                $error = array('error' => $this->upload->display_errors());
                $msg = '["' . $error['error'] . '", "error", "#e50914"]';
            } else {
                // Uploaded file data 
                $fileData = $this->upload->data();
                $mydata['banner_image'] = $fileData['file_name'];
            }
        }
        $gn_user_id = $this->Commonmodel->update_row('banner', $mydata, $where);
        if ($old_image && $_FILES['banner_image_edt']['name'] != '') {
            if (file_exists('./uploads/banners/'.$old_image)) {
                @unlink('./uploads/banners/'.$old_image);
            }
        }
        if ($gn_user_id) {
            $msg = '["Banner updated successfully!", "success", "#36A1EA"]';
        } else {
            $msg = '["Banner not updated"!, "error", "#e50914"]';
        }
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('banner'), 'refresh');
    }
    
    public function deleteBanner($id = false) {
        $where = array('id'=>$id);
        $data = $this->Commonmodel->fetch_row('banner', $where);
        if (@$data->banner_image && file_exists('./uploads/banners/' . @$data->banner_image)) {
            @unlink('./uploads/banners/' . @$data->banner_image);
        }
        $this->Commonmodel->delete_single_con('banner', $where);
        $msg = '["Banner deleted successfully.", "success", "#36A1EA"]';
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('banner'));
    }

}