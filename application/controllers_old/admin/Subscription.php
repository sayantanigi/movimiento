<?php
defined('BASEPATH') or exit('No direct script access allowed');
//error_reporting(0);
class Subscription extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->admin_login();
        $this->load->model('User_model');
        $this->load->model('Commonmodel');
        $this->load->model('Subscription_model');
        $this->load->model('Cms_model');
        $this->data['title'] = 'Subscription';
        $this->data['tab'] = 'subscription';
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
        $this->data['title'] = 'Subscription';
        $this->data['tab'] = 'subscription';
        $this->data['main'] = admin_view('subscription/list');
        $event = $this->Subscription_model->getAll($offset, $show_per_page);
        $this->data['subscription'] = $event['results'];
        $config['base_url'] = admin_url('subscription/list');
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
    public function add($id = false) {
        $this->data['tab'] = 'add_subscription';
        $this->data['main'] = admin_view('subscription/add');
        if ($id) {
            $this->data['title'] = 'Edit Subscription';
            $this->data['subscription'] = $pages = $this->db->query("SELECT * FROM subscription WHERE id = '".$id."'")->row();
            if (!isset($pages)) {
                redirect(site_url('error_404'));
                exit();
            }
        } else {
            $this->data['title'] = 'Add Subscription';
            $this->form_validation->set_rules('subscription_name', 'Subscription Name', 'trim|required');
        }

        if (!empty($_POST)) {
            $subscription_name = $this->input->post('subscription_name');
            $subscription_user_type = $this->input->post('subscription_user_type');
            $subscription_type = $this->input->post('subscription_type');
            $subscription_amount = $this->input->post('subscription_amount');
            $payment_link = $this->input->post('payment_link');
            $price_key = $this->input->post('price_key');
            $subscription_duration = $this->input->post('subscription_duration');
            $subscription_description = $this->input->post('subscription_description');
            $status = $this->input->post('status');

            $mydata = array(
                'subscription_name' => $subscription_name,
                'subscription_user_type' => $subscription_user_type,
                'subscription_type' => $subscription_type,
                'subscription_amount' => $subscription_amount,
                'payment_link' => $payment_link,
                'price_key' => $price_key,
                'subscription_duration' => $subscription_duration,
                'subscription_description' => $subscription_description,
                'status' => $status,
                'created_date' => date("Y-m-d h:i:s")
            );
            $checkdata = $this->db->query("SELECT * FROM subscription WHERE subscription_name LIKE '%".$this->input->post('subscription_name')."%'")->row();
            if(empty($checkdata)) {
                $result = $this->Commonmodel->add_details('subscription', $mydata);
                if ($result) {
                    $msg = '["Subscription added successfully!", "success", "#36A1EA"]';
                } else {
                    $msg = '["subscription with same name already exist!", "error", "#e50914"]';
                }
            } else {
                $msg = '["subscription with same name already exist! Unable to update", "error", "#e50914"]';
            }
            $this->session->set_flashdata('msg', $msg);
            redirect(admin_url('subscription'), 'refresh');
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    public function subscribeUpdate($id = false) {
        if (!empty($_POST)) {
            $subscription_name = $this->input->post('subscription_name');
            $subscription_user_type = $this->input->post('subscription_user_type');
            $subscription_type = $this->input->post('subscription_type');
            $subscription_amount = $this->input->post('subscription_amount');
            $payment_link = $this->input->post('payment_link');
            $price_key = $this->input->post('price_key');
            $subscription_duration = $this->input->post('subscription_duration');
            $subscription_description = $this->input->post('subscription_description');
            $status = $this->input->post('status');
            $where = array('id' => $id);

            $mydata = array(
                'subscription_name' => $subscription_name,
                'subscription_user_type' => $subscription_user_type,
                'subscription_type' => $subscription_type,
                'subscription_amount' => $subscription_amount,
                'payment_link' => $payment_link,
                'price_key' => $price_key,
                'subscription_duration' => $subscription_duration,
                'subscription_description' => $subscription_description,
                'status' => $status,
                'created_date' => date("Y-m-d h:i:s")
            );
            $gn_user_id = $this->Commonmodel->update_row('subscription', $mydata, $where);
            if ($gn_user_id) {
                $msg = '["Subscription updated successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["Subscription not updated"!, "error", "#e50914"]';
            }
        }
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('subscription'), 'refresh');
    }
    public function changeStatus() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'Subscription activated successfully!';
            } else {
                $msg = 'Subscription deactivated successfully!';
            }
            if ($this->Commonmodel->update_row('subscription', ['status' => $status], ['id' => $id])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
    public function deletesubscribe($id = false) {
        $id = $this->input->post('id');
        if (!empty($id)) {
            if ($this->db->query("DELETE FROM subscription WHERE id = '".$id."'")) {
                echo '["Deleted successfully", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
}

/* End of file Subscription.php */
/* Location: ./application/controllers/admin/Subscription.php */