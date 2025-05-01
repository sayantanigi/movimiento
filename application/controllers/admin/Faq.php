<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Faq extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->Adminmodel->loggedIn();
    }
    public function index() {
        $data = array(
            'title' => 'Manage Faq',
            'page' => 'cms',
            'subpage' => 'faq'
        );
        $data['faq'] = $this->Adminmodel->get_all_record('id, question, answer, status', 'faq', '', array('id', 'DESC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/faq/faq_list');
        $this->load->view('admin/footer');
    }

    public function add() {
        $data = array(
            'title' => 'Add Games',
            'page' => 'cms',
            'subpage' => 'faq'
        );
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/faq/add_faq');
        $this->load->view('admin/footer');
    }
    public function addfaq() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('question', 'Question', 'required|trim');
            $this->form_validation->set_rules('answer', 'Qnswer', 'required|trim');
            $this->form_validation->set_rules('status', 'Status', 'required|trim');
            if ($this->form_validation->run() == true) {
                $data = array(
                    'question' => strip_tags($this->input->post('question')),
                    'answer' => $this->input->post('answer'),
                    'status' => strip_tags($this->input->post('status')),
                    'created_at' => date('Y-m-d H:i:s')
                );
                $result = $this->Adminmodel->add('faq', $data);
                if ($result) {
                    $response['status'] = 1;
                    $response['message'] = 'Faq added successfully';
                } else {
                    $response['status'] = 0;
                    $response['message'] = 'Some error ocure.Please try again.';
                }
            } else {
                $response = array(
                    'vali_error' => 1,
                    'question_error' => form_error('question'),
                    'answer_error' => form_error('answer'),
                    'status_error' => form_error('status'),
                );
            }
        }
        echo json_encode($response);
    }

    public function edit($id) {
        $data = array(
            'title' => 'Edit Faq',
            'page' => 'cms',
            'subpage' => 'faq'
        );
        $data['faq'] = $this->Adminmodel->get_by('faq', 'single', array('id' => $id), '', 1);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/faq/edit_faq');
        $this->load->view('admin/footer');
    }

    public function editfaq() {
        $id = strip_tags($this->input->post('id'));
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('question', 'Question', 'required|trim');
            $this->form_validation->set_rules('answer', 'Qnswer', 'required|trim');
            $this->form_validation->set_rules('status', 'Status', 'required|trim');
            if ($this->form_validation->run() == true) {
                $data = array(
                    'question' => strip_tags($this->input->post('question')),
                    'answer' => $this->input->post('answer'),
                    'status' => strip_tags($this->input->post('status')),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $result = $this->Adminmodel->update($data, 'faq', array('id' => $id));
                if ($result) {
                    $response['status'] = 1;
                    $response['message'] = 'Faq updated successfully';
                } else {
                    $response['status'] = 0;
                    $response['message'] = 'Some error ocure.Please try again.';
                }
            } else {
                $response = array(
                    'vali_error' => 1,
                    'question_error' => form_error('question'),
                    'answer_error' => form_error('answer'),
                    'status_error' => form_error('status'),
                );
            }
        }
        echo json_encode($response);
    }

    function delete($id) {
        if (empty($id)) {
            return false;
        }
        $result = $this->db->query('delete from faq where id = ' . $id . '');
        if ($result) {
            $msg = '["faq deleted successfully.", "success", "#A5DC86"]';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/faq'), 'refresh');
        } else {
            $msg = 'error';
            $this->session->set_flashdata('msg', $msg);
            redirect(base_url('admin/faq'), 'refresh');
        }
    }
    public function changestatus() {
        if ($this->input->post('faqId')) {
            $faqId = $this->input->post('faqId');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'faq status is Activate';
            } else {
                $msg = 'faq status is Inctivate';
            }

            if ($this->Adminmodel->update(['status' => $status], 'faq', ['id' => $faqId])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
}
