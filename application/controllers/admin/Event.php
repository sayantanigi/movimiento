<?php
defined('BASEPATH') or exit('No direct script access allowed');
//error_reporting(0);
class Event extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->admin_login();
        $this->load->model('User_model');
        $this->load->model('Commonmodel');
        $this->load->model('Event_model');
        $this->load->model('Cms_model');
        $this->data['title'] = 'Members';
        $this->data['tab'] = 'members';
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
        $this->data['title'] = 'Events';
        $this->data['tab'] = 'event';
        $this->data['main'] = admin_view('event/index');
        $event = $this->Event_model->getAll($offset, $show_per_page);
        $this->data['event'] = $event['results'];
        $config['base_url'] = admin_url('event/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $event['total'];
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
    public function changeStatus() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'Event activated successfully!';
            } else {
                $msg = 'Event deactivated successfully!';
            }
            if ($this->Commonmodel->update_row('event', ['status' => $status], ['id' => $id])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
    public function add($id = false) {
        $this->data['tab'] = 'add_event';
        $this->data['main'] = admin_view('event/add');
        if ($id) {
            $this->data['title'] = 'Edit Event';
            $this->data['event'] = $pages = $this->db->query("SELECT * FROM event WHERE id = '".$id."'")->row();
            if (!isset($pages)) {
                redirect(site_url('error_404'));
                exit();
            }
        } else {
            $this->data['title'] = 'Add Event';
            $this->form_validation->set_rules('event_name', 'Event Name', 'trim|required');
        }
        if ($this->form_validation->run()) {
            $event_name = $this->input->post('event_name');
            $event_desc = $this->input->post('event_desc');
            $event_link = $this->input->post('event_link');
            $event_dt = $this->input->post('event_dt');
            $from_time = $this->input->post('from_time');
            $to_time = $this->input->post('to_time');
            $event_mode = $this->input->post('event_mode');
            $status = $this->input->post('status');
            $slug = $this->input->post('event_name');
            if (empty($slug) || $slug == '') {
                $slug = $this->input->post('event_name');
            }

            $slug = strtolower(url_title($slug));
            // /$mydata['event_slug'] = $this->Cms_model->get_unique_url($slug, $id);
            $mydata = array(
                'event_name' => $event_name,
                'event_slug' => $this->Cms_model->get_unique_url($slug, $id),
                'event_desc' => $event_desc,
                'event_link' => $event_link,
                'event_dt' => $event_dt,
                'from_time' => $from_time,
                'to_time' => $to_time,
                'event_mode' => $event_mode,
                'status' => $status,
                'created_at' => date("Y-m-d h:i:s")
            );
            if ($_FILES['event_img']['name'] != '') {
                $config['upload_path'] = './uploads/event/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '*';
                $config['overwrite'] = false;
                $config['remove_spaces'] = TRUE;  //it will remove all spaces
                $config['encrypt_name'] = false;   //it wil encrypte the original file name
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('event_img')) {
                    $error = array('error' => $this->upload->display_errors());
                    $msg = '["' . $error['error'] . '", "error", "#e50914"]';
                } else {
                    $fileData = $this->upload->data();
                    $mydata['event_img'] = $fileData['file_name'];
                }
            }
            //echo "<pre>"; print_r($mydata); die();
            $result = $this->Commonmodel->add_details('event', $mydata);
            if ($result) {
                $msg = '["Event added successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["User with same role exist!", "error", "#e50914"]';
            }
            $this->session->set_flashdata('msg', $msg);
            redirect(admin_url('event'), 'refresh');
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    public function eventUpdate($id = false) {
        //$this->data['event'] = $this->db->query("SELECT * FROM event WHERE id '".$id."'")->result();
        $this->form_validation->set_rules('event_name', 'Event Name', 'trim|required');
        if ($this->form_validation->run()) {
            $old_image = $this->input->post('old_image');
            $old_video = $this->input->post('old_video');
            $event_name = $this->input->post('event_name');
            $event_desc = $this->input->post('event_desc');
            $event_link = $this->input->post('event_link');
            $event_dt = $this->input->post('event_dt');
            $from_time = $this->input->post('from_time');
            $to_time = $this->input->post('to_time');
            $event_type = $this->input->post('event_type');
            $event_price = $this->input->post('event_price');
            $price_key = $this->input->post('price_key');
            $event_mode = $this->input->post('event_mode');
            $status = $this->input->post('status');
            $where = array('id' => $id);
            $slug = $this->input->post('event_name');
            if (empty($slug) || $slug == '') {
                $slug = $this->input->post('event_name');
            }

            $slug = strtolower(url_title($slug));
            //$mydata['event_slug'] = $this->Cms_model->get_unique_url($slug, $id);
            $mydata = array(
                'event_name' => $event_name,
                'event_slug' => $this->Cms_model->get_unique_url($slug, $id),
                'event_desc' => $event_desc,
                'event_link' => $event_link,
                'event_dt' => $event_dt,
                'from_time' => $from_time,
                'to_time' => $to_time,
                'event_type' => $event_type,
                'event_price' => $event_price,
                'price_key' => $price_key,
                'event_mode' => $event_mode,
                'status' => $status,
                'created_at' => date("Y-m-d h:i:s")
            );
            if ($_FILES['event_img']['name'] != '') {
                $config['upload_path'] = './uploads/event/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '*';
                $config['overwrite'] = false;
                $config['remove_spaces'] = TRUE;  //it will remove all spaces
                $config['encrypt_name'] = false;   //it wil encrypte the original file name
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('event_img')) {
                    $error = array('error' => $this->upload->display_errors());
                    $msg = '["' . $error['error'] . '", "error", "#e50914"]';
                } else {
                    $fileData = $this->upload->data();
                    $mydata['event_img'] = $fileData['file_name'];
                }
            }
            if (!empty($_FILES['videos_file']['name'])) {
                $src = $_FILES['videos_file']['tmp_name'];
                $filEnc = time();
                $avatar = rand(0000, 9999) . "_" . $_FILES['videos_file']['name'];
                $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
                $dest = getcwd() . '/uploads/event/videos_file/' . $avatar1;
                if (move_uploaded_file($src, $dest)) {
                    $file  = $avatar1;
                    @unlink('uploads/event/videos_file/' . $_POST['old_video']);
                }
                if(!empty($file)) {
                    $mydata['video_file'] = $file;
                } else {
                    $link = "";
                }
            }
            $gn_user_id = $this->Commonmodel->update_row('event', $mydata, $where);
            if ($old_image && $_FILES['event_img']['name'] != '') {
                if (file_exists('./uploads/event/' . $old_image)) {
                    @unlink('./uploads/event/' . $old_image);
                }
            }
            if ($gn_user_id) {
                $msg = '["Event updated successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["Event not updated"!, "error", "#e50914"]';
            }
        }
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('event'), 'refresh');
    }
    public function fileUpload() {
        $event_id = $_POST['event_id'];
        if (!empty($_FILES['videos_file']['name'])) {
            $src = $_FILES['videos_file']['tmp_name'];
            $filEnc = time();
            $avatar = rand(0000, 9999) . "_" . $_FILES['videos_file']['name'];
            $avatar1 = str_replace(array('(', ')', ' '), '', $avatar);
            $dest = getcwd() . '/uploads/event/videos_file/' . $avatar1;
            if (move_uploaded_file($src, $dest)) {
                $file  = $avatar1;
                @unlink('uploads/event/videos_file/' . $_POST['old_video']);
            }
            if(!empty($file)) {
                $mydata['video_file'] = $file;
            } else {
                $link = "";
            }
            $gn_user_id = $this->Commonmodel->update_row('event', $mydata, array('id' => $event_id));
            if ($gn_user_id) {
                $msg = 'success';
            } else {
                $msg = 'error';
            }
        }
        echo $msg;
    }
    public function deleteEvent($id = false) {
        $data = $this->db->query("SELECT * FROM event WHERE id = '".$id."'")->row();
        if (@$data->image && file_exists('./uploads/event/' . @$data->image)) {
            @unlink('./uploads/event/' . @$data->image);
        }
        $this->db->query("DELETE FROM event WHERE id = '".$id."'");
        $msg = '["Deleted successfully.", "success", "#36A1EA"]';
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('event'));
    }
    function exportmember() {
        $resall = $this->db->get('users')->result();
        if (is_array($resall) && count($resall)) {
            foreach ($resall as $r) {
                if ($r->status == 1) {
                    $status = "Active";
                } else {
                    $status = "InActive";
                }
                $arr[] = array(
                    'fname' => $r->fname,
                    'lname' => $r->lname,
                    'email' => $r->email,
                    'phone' => $r->phone,
                    'status' => $status,
                    'created_at' => date('d-m-Y', strtotime($r->created_at))
                );
            }
        }
        $this->load->library("Excel");
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $table_columns = array("First Name", "Last Name", "Email", "Phone No", "Status", "Created Date");
        $column = 0;
        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $excel_row = 2;
        if (is_array($arr) && count($arr) > 0) {
            foreach ($arr as $row) {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['fname']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['lname']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['email']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['phone']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['status']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['created_at']);
                $excel_row++;
            }
        }
        $file = "exportmember.xls";
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $file);
        $object_writer->save('php://output');
    }
    public function purchased_events($page=1) {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Event Purchased List';
        $this->data['tab'] = 'purchased_events';
        $this->data['main'] = admin_view('event/purchased_event');
        $products = $this->Event_model->getAlleventpurchesed($offset, $show_per_page);
        $this->data['event_order_details'] = $this->db->query("SELECT * FROM event_booked ORDER BY id DESC")->result_array();
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
}

/* End of file Members.php */
/* Location: ./application/controllers/admin/Members.php */