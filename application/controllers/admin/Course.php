<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
class Course extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->data['header'] = '';
        $this->admin_login();
        $this->load->model('Course_model');
        $this->load->model('Cms_model');
        $this->load->model('Commonmodel');
    }

    // public function compliance_training($page = 1)
    // {
    //     if (isset($_GET['page'])) {
    //         $page = $_GET['page'];
    //     }
    //     $show_per_page = 10;
    //     $offset = ($page - 1) * $show_per_page;
    //     $this->data['title'] = 'Compliance Training';
    //     $this->data['tab'] = 'comp_list';
    //     $this->data['main'] = admin_view('course/index');
    //     $course = $this->Course_model->getAllcomp($offset, $show_per_page);
    //     $this->data['course'] = $course['results'];
    //     $config['base_url'] = admin_url('course/compliance_training');
    //     $config['num_links'] = 2;
    //     $config['uri_segment'] = 4;
    //     $config['total_rows'] = $course['total'];
    //     $config['per_page'] = $show_per_page;
    //     $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
    //     $config['full_tag_close'] = '</ul>';
    //     $config['num_tag_open'] = '<li>';
    //     $config['num_tag_close'] = '</li>';
    //     $config['first_link'] = 'First';
    //     $config['first_tag_open'] = '<li>';
    //     $config['first_tag_close'] = '</li>';
    //     $config['last_link'] = 'Last';
    //     $config['last_tag_open'] = '<li>';
    //     $config['last_tag_close'] = '</li>';
    //     $config['prev_link'] = 'Prev';
    //     $config['prev_tag_open'] = '<li>';
    //     $config['prev_tag_close'] = '</li>';
    //     $config['next_link'] = 'Next';
    //     $config['next_tag_open'] = '<li>';
    //     $config['next_tag_close'] = '</li>';
    //     $config['cur_tag_open'] = '<li class="active"><a href="#">';
    //     $config['cur_tag_close'] = '</a></li>';
    //     $config['use_page_numbers'] = true;
    //     $config['use_page_numbers'] = true;
    //     $config['page_query_string'] = true;
    //     $config['query_string_segment'] = 'page';
    //     $config['reuse_query_string'] = true;

    //     $this->pagination->initialize($config);
    //     $this->data['paginate'] = $this->pagination->create_links();
    //     $this->load->view(admin_view('default'), $this->data);
    // }

    public function course_list($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'All Course';
        $this->data['tab'] = 'comp_list';
        $this->data['main'] = admin_view('course/index');
        $course = $this->Course_model->getAllCourse($offset, $show_per_page);
        $this->data['course'] = $course['results'];
        $config['base_url'] = admin_url('course/course_list');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $course['total'];
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
                $msg = 'Course activated successfully!';
            } else {
                $msg = 'Course deactivated successfully!';
            }
            if ($this->Commonmodel->update_row('courses', ['status' => $status], ['id' => $id])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
    public function certificate_courses($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Certificate Courses';
        $this->data['tab'] = 'cert_list';
        $this->data['main'] = admin_view('course/index');
        $course = $this->Course_model->getAllcert($offset, $show_per_page);
        $this->data['course'] = $course['results'];
        $config['base_url'] = admin_url('course/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $course['total'];
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
    public function subscription_courses($page = 1) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Subscriptions';
        $this->data['tab'] = 'subscr_list';
        $this->data['main'] = admin_view('course/index');
        $course = $this->Course_model->getAllsubscr($offset, $show_per_page);
        $this->data['course'] = $course['results'];
        $config['base_url'] = admin_url('course/index');
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $course['total'];
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
    public function course_transaction() {
        $this->data['title'] = 'Transaction List';
        $this->data['tab'] = 'trans';
        $this->data['main'] = admin_view('course/txn');
        $this->data['orders'] = $this->db->get('payments')->result();
        $this->load->view(admin_view('default'), $this->data);
    }
    public function add($id = false) {
        $this->data['title'] = 'Add Course';
        $this->data['tab'] = 'add_products';
        $this->data['main'] = admin_view('course/add');
        $this->data['course_cat'] = $this->db->get('sm_category')->result();
        $this->data['course'] = $this->Course_model->getNew();

        if ($id) {
            $this->data['course'] = $course = $this->Course_model->getRow($id);
            if (!isset($course)) {
                show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[title]', 'Course title', 'required');
        $this->form_validation->set_rules('frm[description]', 'Course description', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            $slug = $formdata['title'];
            if (empty($slug) || $slug == '') {
                $slug = $formdata['title'];
            }
            $slug = strtolower(url_title($slug));
            $formdata['slug'] = $this->Cms_model->get_unique_url($slug, $id);
            //$images = $this->input->post('image');
            if ($this->upload->do_upload('image')) {
                $data = $this->upload->data();
                $formdata['image'] = $data['file_name'];
            }
            if ($this->upload->do_upload('video')) {
                $data = $this->upload->data();
                $formdata['video'] = $data['file_name'];
            }
            $id = $this->Course_model->save($formdata);
            //echo $this->db->last_query();die();
            $this->session->set_flashdata("success", "Course detail saved");
            redirect(admin_url('course/add/' . $id));
        }
        $this->load->view(admin_view('default'), $this->data);
    }

    public function add_course($id = false) {
        $this->data['title'] = 'Add Course';
        $this->data['tab'] = 'add_comp';
        $this->data['main'] = admin_view('course/add');
        $this->data['course_mode'] = $this->db->get('sm_mode')->result_array();
        $this->data['course_level'] = $this->db->get('sm_levels')->result_array();
        $this->data['course_cat'] = $this->db->get('sm_category')->result_array();
        $this->data['course'] = $this->Course_model->getNew();
        if ($id) {
            $this->data['title'] = 'Edit Course';
            $this->data['course'] = $course = $this->Course_model->getRow($id);
            if (!isset($course)) {
                show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[title]', 'Course title', 'required');
        $this->form_validation->set_rules('frm[description]', 'Course description', 'required');

        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            // $formdata['cat_id'] = 1;
            $slug = $formdata['title'];

            if (empty($slug) || $slug == '') {
                $slug = $formdata['title'];
            }

            $slug = strtolower(url_title($slug));
            $formdata['slug'] = $this->Cms_model->get_unique_url($slug, $id);
            //$images = $this->input->post('image');
            $config['upload_path'] = './assets/images/courses/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $data = $this->upload->data();
                $formdata['image'] = $data['file_name'];
            }
            $id = $this->Course_model->save($formdata);
            //echo $this->db->last_query();die();
            $this->session->set_flashdata("success", "Course detail saved");
            redirect(admin_url('course/course_list'));
        }
        $this->load->view(admin_view('default'), $this->data);
    }

    public function add_certif_course($id = false) {
        $this->data['title'] = 'Add Course';
        $this->data['tab'] = 'add_cert';
        $this->data['main'] = admin_view('course/add_certificate_course');
        $this->data['course_cat'] = $this->db->get('sm_category')->result();
        $this->data['course'] = $this->Course_model->getNew();

        if ($id) {
            $this->data['course'] = $course = $this->Course_model->getRow($id);
            if (!isset($course)) {
                show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[title]', 'Course title', 'required');
        $this->form_validation->set_rules('frm[description]', 'Course description', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            $formdata['cat_id'] = 2;
            $slug = $formdata['title'];
            if (empty($slug) || $slug == '') {
                $slug = $formdata['title'];
            }
            $slug = strtolower(url_title($slug));
            $formdata['slug'] = $this->Cms_model->get_unique_url($slug, $id);
            //$images = $this->input->post('image');
            $config['upload_path'] = './assets/images/courses/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $data = $this->upload->data();
                $formdata['image'] = $data['file_name'];
            }
            if ($this->upload->do_upload('video')) {
                $data = $this->upload->data();
                $formdata['video'] = $data['file_name'];
            }
            $id = $this->Course_model->save($formdata);
            //echo $this->db->last_query();die();
            $this->session->set_flashdata("success", "Course detail saved");
            redirect(admin_url('course/certificate_courses'));
        }
        $this->load->view(admin_view('default'), $this->data);
    }

    public function add_materials($id) {
        $this->data['title'] = 'Add Course Material';
        $this->data['tab'] = 'add_subscr';
        $this->data['main'] = admin_view('course/add_material');
        $this->data['crsid'] = $crsid = $this->uri->segment(4);
        $this->data['course_id'] = $id;
        $this->data['module'] = $this->db->where('course_id', $crsid)->get('course_modules')->result();
        $this->load->view(admin_view('default'), $this->data);
    }

    public function testInput($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function save_materials($id)  {
        if ($this->input->post('submit') && $this->input->post('module')) {
            $this->form_validation->set_rules('material_type', 'Material Type', 'required');
            if ($this->form_validation->run()) {
                $formdata['course_id'] = $id;
                $mydata = array(
                    'course_id' => @$id,
                    'module' => @$this->testInput($this->input->post('module')),
                    'material_type' => @$this->testInput($this->input->post('material_type')),
                    'video_type' => @$this->testInput($this->input->post('video_type')),
                    'video_url' => @$this->testInput($this->input->post('video_url')),
                    'material_description' => @$this->testInput($this->input->post('material_description')),
                    'created_at' => date("Y-m-d h:i:s"),
                    'status' => @$this->input->post('status')
                );
                if ($_FILES['video_file']['name'] != '') {
                    $config['upload_path'] = './uploads/materials/';
                    $config['allowed_types'] = '*';
                    $config['max_size'] = '*';
                    $config['overwrite'] = false;
                    $config['remove_spaces'] = TRUE;  //it will remove all spaces
                    $config['encrypt_name'] = true;   //it wil encrypte the original file name
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('video_file')) {
                        $error = array('error' => $this->upload->display_errors());
                        $msg = '["' . $error['error'] . '", "error", "#e50914"]';
                    } else {
                        // Uploaded file data 
                        $fileData = $this->upload->data();
                        $mydata['video_file'] = $fileData['file_name'];
                    }
                }
                $insert = $this->Commonmodel->add_details('course_materials', $mydata);
                if ($insert) {
                    $dataOrdering = array(
                        'position_order' => $insert
                    );
                    $this->db->update('course_materials', $dataOrdering, array('id' => $insert));
                }

                if (!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) {
                    // Count total files
                    $countfiles = count($_FILES['files']['name']);
                    // Looping all files
                    for ($i = 0; $i < $countfiles; $i++) {
                        if (!empty($_FILES['files']['name'][$i])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['files']['size'][$i];
                            // Set preference
                            $config['upload_path'] = 'uploads/materials/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['files']['name'][$i];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name
                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $uploadData[$i]['resource_file'] = $fileData['file_name'];
                                $uploadData[$i]['course_id'] = $id;
                                $uploadData[$i]['material_id'] = $insert;
                                $uploadData[$i]['created_at'] = date("Y-m-d h:i:s");
                                $uploadData[$i]['status'] = 1;
                            }
                        }
                    }
                    if (!empty($uploadData)) {
                        $this->Commonmodel->insertBatch('course_resources', $uploadData);
                    }
                }

                if ($this->input->post('material_type') == 'quiz') {
                    $ques = $this->input->post('ques');
                    $ans1 = $this->input->post('ans1');
                    $ans2 = $this->input->post('ans2');
                    $ans3 = $this->input->post('ans3');
                    $ans4 = $this->input->post('ans4');
                    $cor_ans = $this->input->post('cor_ans');
                    for ($k = 0; $k < count($ques); $k++) {
                        $basicdata[] = array(
                            'course_id' => $id,
                            'material_id' => $insert,
                            'question' => $ques[$k],
                            'ans1' => $ans1[$k],
                            'ans2' => $ans2[$k],
                            'ans3' => $ans3[$k],
                            'ans4' => $ans4[$k],
                            'correct_answer' => $cor_ans[$k],
                            'status' => 1,
                            'created_at' => date("Y-m-d h:i:s")
                        );

                        $basicdata[$k]['quiz_file'] = '';
                        if (!empty($_FILES['file_name']['name'][$k])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['file_name']['name'][$k];
                            $_FILES['file']['type'] = $_FILES['file_name']['type'][$k];
                            $_FILES['file']['tmp_name'] = $_FILES['file_name']['tmp_name'][$k];
                            $_FILES['file']['error'] = $_FILES['file_name']['error'][$k];
                            $_FILES['file']['size'] = $_FILES['file_name']['size'][$k];
                            // Set preference
                            $config['upload_path'] = 'uploads/quizs/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['file_name']['name'][$k];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name
                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $basicdata[$k]['quiz_file'] = $fileData['file_name'];
                            }
                        }

                        $basicdata[$k]['ans1_file'] = '';
                        if (!empty($_FILES['option1_file_name']['name'][$k])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['option1_file_name']['name'][$k];
                            $_FILES['file']['type'] = $_FILES['option1_file_name']['type'][$k];
                            $_FILES['file']['tmp_name'] = $_FILES['option1_file_name']['tmp_name'][$k];
                            $_FILES['file']['error'] = $_FILES['option1_file_name']['error'][$k];
                            $_FILES['file']['size'] = $_FILES['option1_file_name']['size'][$k];
                            // Set preference
                            $config['upload_path'] = 'uploads/quizs/answer_files/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['option1_file_name']['name'][$k];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name
                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $basicdata[$k]['ans1_file'] = $fileData['file_name'];
                            }
                        }


                        $basicdata[$k]['ans2_file'] = '';
                        if (!empty($_FILES['option2_file_name']['name'][$k])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['option2_file_name']['name'][$k];
                            $_FILES['file']['type'] = $_FILES['option2_file_name']['type'][$k];
                            $_FILES['file']['tmp_name'] = $_FILES['option2_file_name']['tmp_name'][$k];
                            $_FILES['file']['error'] = $_FILES['option2_file_name']['error'][$k];
                            $_FILES['file']['size'] = $_FILES['option2_file_name']['size'][$k];
                            // Set preference
                            $config['upload_path'] = 'uploads/quizs/answer_files/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['option2_file_name']['name'][$k];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name
                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $basicdata[$k]['ans2_file'] = $fileData['file_name'];
                            }
                        }

                        $basicdata[$k]['ans3_file'] = '';
                        if (!empty($_FILES['option3_file_name']['name'][$k])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['option3_file_name']['name'][$k];
                            $_FILES['file']['type'] = $_FILES['option3_file_name']['type'][$k];
                            $_FILES['file']['tmp_name'] = $_FILES['option3_file_name']['tmp_name'][$k];
                            $_FILES['file']['error'] = $_FILES['option3_file_name']['error'][$k];
                            $_FILES['file']['size'] = $_FILES['option3_file_name']['size'][$k];
                            // Set preference
                            $config['upload_path'] = 'uploads/quizs/answer_files/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['option3_file_name']['name'][$k];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name
                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $basicdata[$k]['ans3_file'] = $fileData['file_name'];
                            }
                        }


                        $basicdata[$k]['ans4_file'] = '';
                        if (!empty($_FILES['option4_file_name']['name'][$k])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['option4_file_name']['name'][$k];
                            $_FILES['file']['type'] = $_FILES['option4_file_name']['type'][$k];
                            $_FILES['file']['tmp_name'] = $_FILES['option4_file_name']['tmp_name'][$k];
                            $_FILES['file']['error'] = $_FILES['option4_file_name']['error'][$k];
                            $_FILES['file']['size'] = $_FILES['option4_file_name']['size'][$k];
                            // Set preference
                            $config['upload_path'] = 'uploads/quizs/answer_files/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['option4_file_name']['name'][$k];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name
                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $basicdata[$k]['ans4_file'] = $fileData['file_name'];
                            }
                        }









                    }
                    // echo "<pre>";
                    //  print_r($basicdata);die;
                    $this->db->insert_batch('course_quiz', $basicdata);
                    // echo $this->db->last_query();die;
                }
                // $this->session->set_flashdata("success", "Course Material saved");
                $msg = '["Course Material added successfully!", "success", "#36A1EA"]';
                $this->session->set_flashdata('msg', $msg);
                redirect(admin_url('course/material_list/' . $id));
            } else {
                redirect(admin_url('course/add_materials/' . $id), 'refresh');
            }
        } else {
            $msg = '["Some error occured, Please try again!", "error", "#e50914"]';
            $this->session->set_flashdata('msg', $msg);

            redirect(admin_url('course/add_materials/' . $id), 'refresh');
        }
    }
    public function material_list($id = null, $module_id = null) {
        $this->data['title'] = 'Course Material List';
        $this->data['tab'] = 'v_mat';
        $this->data['main'] = admin_view('course/material_view');
        if (@$module_id) {
            $this->data['materials'] = $this->db->get_where('course_materials', array('course_id' => $id, 'module' => $module_id))->result();
        } else {
            $this->data['materials'] = $this->db->get_where('course_materials', array('course_id' => $id))->result();
        }
        $this->data['course_id'] = $id;
        $this->data['module_id'] = $module_id;
        $this->load->view(admin_view('default'), $this->data);
    }
    function activate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('products');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 1;
            $this->Course_model->save($c);
            $this->session->set_flashdata("success", "Course activated");
        }
        redirect($redirect);
    }

    function deactivate($id = false) {
        $redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('products');
        if ($id) {
            $c['id'] = $id;
            $c['status'] = 0;
            $this->Course_model->save($c);
            $this->session->set_flashdata("success", "Course deactivated");
        }
        redirect($redirect);
    }

    function delete_compliance($id) {
        if ($id > 0) {
            $this->Course_model->delete($id);
            $this->session->set_flashdata('success', 'Course deleted successfully ');
        }
        redirect(admin_url('course/course_list'));
    }

    public function deleteCourse($id = false) {
        $data = $this->db->get_where('courses', array('id' => $id))->row();

        if (@$data->image && file_exists('./assets/images/courses/' . @$data->image)) {
            @unlink('./assets/images/courses/' . @$data->image);
        }

        $this->Course_model->delete($id);
        $msg = '["Deleted successfully.", "success", "#36A1EA"]';

        $this->session->set_flashdata('msg', $msg);

        redirect(admin_url('course/course_list'));
    }

    public function deleteMaterialFile($id = false, $course_id = false, $material_id = false) {
        $data = $this->db->get_where('course_resources', array('id' => $id))->row();

        if (@$data->resource_file && file_exists('./uploads/materials/' . @$data->resource_file)) {
            @unlink('./uploads/materials/' . @$data->resource_file);
        }

        $this->Commonmodel->delete_single_con('course_resources', array('id' => $id));
        $msg = '["Deleted successfully.", "success", "#36A1EA"]';

        $this->session->set_flashdata('msg', $msg);

        redirect(admin_url('course/update_material/' . $course_id . "/" . $material_id));
    }

    function delete_cert($id)
    {
        if ($id > 0) {
            $this->Course_model->delete($id);
            $this->session->set_flashdata('success', 'Course deleted successfully ');
        }
        redirect(admin_url('course/certificate_courses'));
    }

    function delete_subscr($id)
    {
        if ($id > 0) {
            $this->Course_model->delete($id);
            $this->session->set_flashdata('success', 'Course deleted successfully ');
        }
        redirect(admin_url('course/subscription_courses'));
    }

    public function mode() {
        $this->data['title'] = 'Course Mode List';
        $this->data['tab'] = 'mode_list';
        $this->data['main'] = admin_view('course/mode_index');
        $this->data['mode'] = $this->db->get_where('sm_mode', array('mode_status' => 1))->result();
        $this->load->view(admin_view('default'), $this->data);
    }
    public function mode_add($id = false) {
        $this->data['title'] = 'Add Mode';
        $this->data['tab'] = 'add_mode';
        $this->data['main'] = admin_view('course/mode_add');
        $this->data['mode'] = $this->Course_model->getNew('sm_mode');
        if ($id) {
            $this->data['mode'] = $mode = $this->Course_model->getRow($id, 'sm_mode');
            $this->data['title'] = 'Update Mode';
            if (!isset($mode)) {
                show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[mode_title]', 'Mode title', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            $formdata['mode_status'] = 1;
            $id = $this->Course_model->save($formdata, 'sm_mode');
            //echo $this->db->last_query();die();
            $this->session->set_flashdata("success", "Mode detail updated");
            if ($id) {
                $msg = '["Mode added successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["Sorry, Record not saved!", "error", "#e50914"]';
            }
            $this->session->set_flashdata('msg', $msg);
            redirect(admin_url('course/mode'));
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    function delete_mode($id = false) {
        if ($id > 0) {
            $this->Course_model->delete($id, 'sm_mode');
            $this->session->set_flashdata('success', 'Mode deleted successfully ');
        }
        $msg = '["Deleted successfully.", "success", "#36A1EA"]';
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('course/mode'));
    }
    public function level() {
        $this->data['title'] = 'Course Level List';
        $this->data['tab'] = 'level_list';
        $this->data['main'] = admin_view('course/level_index');
        $this->data['level'] = $this->db->get_where('sm_levels', array('level_status' => 1))->result();
        $this->load->view(admin_view('default'), $this->data);
    }
    public function level_add($id = false) {
        $this->data['title'] = 'Add Level';
        $this->data['tab'] = 'add_level';
        $this->data['main'] = admin_view('course/level_add');
        $this->data['level'] = $this->Course_model->getNew('sm_levels');
        if ($id) {
            $this->data['level'] = $course = $this->Course_model->getRow($id, 'sm_levels');
            $this->data['title'] = 'Update Level';
            if (!isset($course)) {
                show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[level_title]', 'Level Name', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            $formdata['level_status'] = 1;
            $id = $this->Course_model->save($formdata, 'sm_levels');
            //echo $this->db->last_query();die();
            $this->session->set_flashdata("success", "Level updated");
            if ($id) {
                $msg = '["Level added successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["Sorry, Record not saved!", "error", "#e50914"]';
            }
            $this->session->set_flashdata('msg', $msg);
            redirect(admin_url('course/level'));
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    function delete_level($id = false) {
        if ($id > 0) {
            $this->Course_model->delete($id, 'sm_levels');
            $this->session->set_flashdata('success', 'Level deleted successfully ');
        }
        $msg = '["Deleted successfully.", "success", "#36A1EA"]';
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('course/level'));
    }
    public function category() {
        $this->data['title'] = 'Course Category List';
        $this->data['tab'] = 'cat_list';
        $this->data['main'] = admin_view('course/category_index');
        $this->data['course'] = $this->db->query("SELECT * FROM sm_category")->result();
        $this->load->view(admin_view('default'), $this->data);
    }
    public function category_add($id = false) {
        $this->data['title'] = 'Add Category';
        $this->data['tab'] = 'add_cat';
        $this->data['main'] = admin_view('course/category_add');
        $this->data['course'] = $this->Course_model->getNew('sm_category');
        if ($id) {
            $this->data['course'] = $course = $this->Course_model->getRow($id, 'sm_category');
            $this->data['title'] = 'Update Category';
            if (!isset($course)) {
                show_404();
                exit();
            }
        }
        $this->form_validation->set_rules('frm[category_name]', 'Category title', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['id'] = $id;
            // /$formdata['status'] = 1;
            $slug = $formdata['category_name'];
            if (empty($slug) || $slug == '') {
                $slug = $formdata['category_name'];
            }
            $slug = strtolower(url_title($slug));
            $formdata['category_link'] = $this->Cms_model->get_unique_url($slug, $id);
            $id = $this->Course_model->save($formdata, 'sm_category');
            //echo $this->db->last_query();die();
            $this->session->set_flashdata("success", "Category detail updated");
            if ($id) {
                $msg = '["Category added successfully!", "success", "#36A1EA"]';
            } else {
                $msg = '["Sorry, Record not saved!", "error", "#e50914"]';
            }
            $this->session->set_flashdata('msg', $msg);
            redirect(admin_url('course/category'));
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    function delete_category($id = false) {
        if ($id > 0) {
            $this->Course_model->delete($id, 'sm_category');
            $this->session->set_flashdata('success', 'Category deleted successfully ');
        }
        $msg = '["Deleted successfully.", "success", "#36A1EA"]';
        $this->session->set_flashdata('msg', $msg);
        redirect(admin_url('course/category'));
    }
    public function add_course_syllabus($id = false) {
		$this->data['title'] = 'Add Course Syllabus';
        $this->data['tab'] = 'ad_comp_chapter';
        $this->data['main'] = admin_view('course/syllabus_add');
        $this->data['coursed'] = $this->db->get('courses')->result();
        $this->data['course'] = $this->Course_model->getNew('course_syllabus');
        $this->data['course_id'] = $id;
        $this->load->view(admin_view('default'), $this->data);
	}
    public function save_syllabus($id = false) {
        $this->form_validation->set_rules('frm[syllabus_name]', 'Syllabus Title', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['course_id'] = $id;
            $this->Course_model->save($formdata, 'course_syllabus');
            $this->session->set_flashdata("success", "Syllabus created successfully!");
            redirect(admin_url('course/syllabus_list/' . $id));
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    public function update_syllabus($course_id, $id) {
        $this->data['title'] = 'Update Course Syllabus';
        $this->data['tab'] = 'upd_comp_chapter';
        $this->data['course_id'] = $course_id;
        $this->data['module_id'] = $id;
        $this->data['main'] = admin_view('course/syllabus_update');
        $this->data['course'] = $this->db->get_where('course_syllabus', array('id' => $id))->row();
        $this->load->view(admin_view('default'), $this->data);
    }
    public function update_save_syllabus($course_id, $id) {
        $this->form_validation->set_rules('frm[syllabus_name]', 'Syllabus Title', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['course_id'] = $course_id;
            $this->db->update('course_syllabus', $formdata, array('id' => $id));
            //echo $this->db->last_query(); die();
            $this->session->set_flashdata("success", "Syllabus Updated Successfully");
            redirect(admin_url('course/syllabus_list/' . $course_id));
        }
    }
    public function change_syllabus_status($course_id, $id) {
        if ($course_id && $id) {
            $checkStatus = $this->db->query("SELECT * FROM course_syllabus WHERE id = '".$id."' AND course_id = '".$course_id."'")->result_array();
            if($checkStatus[0]['status'] == '0' || empty($checkStatus[0]['status'])) {
                $this->db->query("UPDATE course_syllabus SET status = '1' WHERE id = '".$id."' AND course_id = '".$course_id."'");
            } else {
                $this->db->query("UPDATE course_syllabus SET status = '0' WHERE id = '".$id."' AND course_id = '".$course_id."'");
            }
            //echo $this->db->last_query(); die();
            $this->session->set_flashdata('success', 'Status changed successfully!');
        } else {
            $this->session->set_flashdata('error', 'Sorry, Status is not changed!');
        }
        redirect(admin_url('course/syllabus_list/' . $course_id));
    }
    public function delete_syllabus($course_id, $id) {
        if ($course_id && $id) {
            $this->Course_model->delete($id, 'course_syllabus');
            //echo $this->db->last_query(); die();
            $this->session->set_flashdata('success', 'Syllabus deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Sorry, Syllabus is not deleted!');
        }
        redirect(admin_url('course/syllabus_list/' . $course_id));
    }
    public function syllabus_list($id = false) {
        $this->data['title'] = 'Course Syllabus List';
        $this->data['tab'] = 'v_chapter';
        $this->data['course_id'] = $id;
        $this->data['main'] = admin_view('course/syllabus_list');
        //$this->data['list'] = $this->db->order_by('position_order', 'ASC')->get_where('course_modules', array('course_id' => $id))->result();
        $this->data['list'] = $this->db->query("SELECT * FROM course_syllabus WHERE course_id = '".$id."' ORDER BY id ASC")->result();
        $this->load->view(admin_view('default'), $this->data);
    }
    public function add_module($id = false) {
        $this->data['title'] = 'Add Course Module';
        $this->data['tab'] = 'ad_comp_chapter';
        $this->data['main'] = admin_view('course/module_add');
        $this->data['coursed'] = $this->db->get('courses')->result();
        $this->data['course'] = $this->Course_model->getNew('course_modules');
        $this->data['course_id'] = $id;
        /*$this->form_validation->set_rules('frm[name]', 'Chapter Name', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['course_id'] = $id;
            $this->Course_model->save($formdata, 'course_modules');
            $this->session->set_flashdata("success", "Chapter detail Saved");
            redirect(admin_url('course/view_chapter_course/' . $id));
        }*/
        $this->load->view(admin_view('default'), $this->data);
    }
    public function save_module($id = false) {
        $this->form_validation->set_rules('frm[name]', 'Chapter Name', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['course_id'] = $id;
            if ($_FILES['module_image']['name'] != '') {
                $config['upload_path'] = './uploads/modules/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
                $config['max_size'] = '*';
                $config['overwrite'] = false;
                $config['remove_spaces'] = TRUE;  //it will remove all spaces
                $config['encrypt_name'] = TRUE;   //it wil encrypte the original file name
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('module_image')) {
                    $error = array('error' => $this->upload->display_errors());
                    $msg = '["' . $error['error'] . '", "error", "#e50914"]';
                } else {
                    $fileData = $this->upload->data();
                    $formdata['module_image'] = $fileData['file_name'];
                }
            }
            $formdata['created_at'] = date("Y-m-d H:i:s");
            $insert = $this->Course_model->save($formdata, 'course_modules');
            $lastId = $this->db->insert_id();
            if ($insert) {
                $dataOrdering = array(
                    'position_order' => $lastId
                );
                $this->db->update('course_modules', $dataOrdering, array('id' => $lastId));
            }
            $this->session->set_flashdata("success", "Module created successfully!");
            redirect(admin_url('course/module_list/' . $id));
        }
        $this->load->view(admin_view('default'), $this->data);
    }
    public function add_cert_chapters($id = false) {
        $this->data['title'] = 'Add Course Chapter';
        $this->data['tab'] = 'ad_cert_chapter';
        $this->data['main'] = admin_view('course/cert_chapter_add');
        $this->data['coursed'] = $this->db->where('cat_id', 2)->get('courses')->result();
        //$this->data['course'] = $this->Course_model->getNew('chapters');
        $this->data['course'] = $this->Course_model->getNew('chapters');
        // $this->form_validation->set_rules('frm[course_id]', 'Course Name', 'required');
        $this->form_validation->set_rules('frm[name]', 'Chapter Name', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['course_id'] = $id;
            $this->Course_model->save($formdata, 'course_modules');
            //echo $this->db->last_query();die();
            $this->session->set_flashdata("success", "Chapter detail Saved");
            redirect(admin_url('course/view_cert_chapters/' . $id));
        }
        $this->load->view(admin_view('default'), $this->data);
    }

    public function view_cert_chapters($id = false)
    {

        $this->data['title'] = 'Course Chapter List';
        $this->data['tab'] = 'v_cert_chapter';
        $this->data['main'] = admin_view('course/chapter_index');
        $this->data['chap'] = $this->db->get_where('course_modules', array('course_id' => $id))->result();
        $this->load->view(admin_view('default'), $this->data);
    }

    public function module_list($id = false)
    {
        $this->data['title'] = 'Course Module List';
        $this->data['tab'] = 'v_chapter';
        $this->data['course_id'] = $id;
        $this->data['main'] = admin_view('course/module_list');
        $this->data['list'] = $this->db->order_by('position_order', 'ASC')->get_where('course_modules', array('course_id' => $id))->result();
        $this->load->view(admin_view('default'), $this->data);
    }

    public function save_module_pref($crsid = false)
    {
        // echo $id;
        // echo "<pre>";print_r($_POST);
        $pref = $this->input->post('pref');
        $i = 1;
        foreach ($pref as $key => $value) {
            $formdata['preference'] = $i++;;

            $this->db->update('course_modules', $formdata, array('id' => $value));
        }
        redirect(admin_url('course/module_list/' . $crsid));
    }

    public function save_module_ordering($course_id = false)
    {

        $position = $this->input->post('position');

        $i = 1;
        foreach ($position as $k => $v) {

            $data = array(
                'position_order' => $i
            );

            $this->db->update('course_modules', $data, array('id' => $v));

            $i++;
        }
    }

    public function view_material_module($id, $module)
    {

        $this->data['title'] = 'Course Material Format';
        $this->data['tab'] = 'v_mat';
        $this->data['main'] = admin_view('course/module_material_view');
        $this->data['matr'] = $this->db->order_by('position_order', 'ASC')->get_where('course_materials', array('module' => $module))->result();
        $this->data['quesquz'] = $this->db->get_where('course_quiz', array('course_id' => $id))->result();
        $this->load->view(admin_view('default'), $this->data);
    }
    public function save_chapter_pref($crsid = false, $module = false)
    {
        // echo $crsid;
        // echo "<pre>";print_r($_POST);die;
        $pref = $this->input->post('pref');
        $i = 1;
        foreach ($pref as $key => $value) {
            $formdata['preference'] = $i++;;

            $this->db->update('course_materials', $formdata, array('id' => $value));
        }
        redirect(admin_url('course/view_material_module/' . $crsid . '/' . $module));
    }
    public function update_module($course_id, $id) {
        $this->data['title'] = 'Update Course Module';
        $this->data['tab'] = 'upd_comp_chapter';
        $this->data['course_id'] = $course_id;
        $this->data['module_id'] = $id;
        $this->data['main'] = admin_view('course/module_update');
        $this->data['course'] = $this->db->get_where('course_modules', array('id' => $id))->row();
        /*$this->form_validation->set_rules('frm[course_id]', 'Course Name', 'required');
        $this->form_validation->set_rules('frm[name]', 'Chapter Name', 'required');

        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['course_id'] = $course_id;

            $this->db->update('course_modules', $formdata, array('id' => $id));

            $this->session->set_flashdata("success", "Chapter detail Saved");
            redirect(admin_url('course/module_list/' . $course_id));
        }*/
        $this->load->view(admin_view('default'), $this->data);
    }

    public function update_save_module($course_id, $id) {
        $this->form_validation->set_rules('frm[name]', 'Chapter Name', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            $formdata['course_id'] = $course_id;
            $old_image = $this->input->post('old_image');
            if ($_FILES['module_image']['name'] != '') {
                $config['upload_path'] = './uploads/modules/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
                $config['max_size'] = '*';
                $config['overwrite'] = false;
                $config['remove_spaces'] = TRUE;  //it will remove all spaces
                $config['encrypt_name'] = TRUE;   //it wil encrypte the original file name
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('module_image')) {
                    $error = array('error' => $this->upload->display_errors());
                    $msg = '["' . $error['error'] . '", "error", "#e50914"]';
                } else {
                    // Uploaded file data 
                    $fileData = $this->upload->data();
                    $formdata['module_image'] = $fileData['file_name'];
                }
            }
            if ($old_image && $_FILES['module_image']['name'] != '') {
                if (file_exists('./uploads/modules/' . $old_image)) {
                    @unlink('./uploads/modules/' . $old_image);
                }
            }
            $this->db->update('course_modules', $formdata, array('id' => $id));
            $this->session->set_flashdata("success", "Chapter detail Saved");
            redirect(admin_url('course/module_list/' . $course_id));
        }
    }

    public function delete_module($course_id, $id)
    {

        if ($course_id && $id) {

            $data = $this->db->get_where('course_modules', array('id' => $id))->row();

            if (@$data->module_image && file_exists('./uploads/modules/' . @$data->module_image)) {
                @unlink('./uploads/modules/' . @$data->module_image);
            }

            $this->Course_model->delete($id, 'course_modules');
            $this->session->set_flashdata('success', 'Module deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Sorry, Module is not deleted!');
        }

        redirect(admin_url('course/module_list/' . $course_id));
    }

    public function update_material($corssid, $qid)
    {

        $this->data['title'] = 'Update Course Material';
        $this->data['tab'] = 'products';
        $this->data['main'] = admin_view('course/edit_material');
        $this->data['course_str'] = $this->Course_model->getRow($qid, 'course_materials');
        $this->data['module'] = $this->db->where('course_id', $corssid)->get('course_modules')->result();

        $this->data['course_id'] = $corssid;
        $this->data['material_id'] = $qid;

        $this->load->view(admin_view('default'), $this->data);
    }

    public function save_edit_material($course_id, $id)
    {

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('module', 'Module', 'required');

            if ($this->form_validation->run()) {

                $where = array('id' => $id);
                $old_file = $this->input->post('old_file');

                $mydata = array(
                    'module' => @$this->testInput($this->input->post('module')),
                    'video_url' => @$this->testInput($this->input->post('video_url')),
                    'material_description' => @$this->testInput($this->input->post('material_description')),
                    'status' => @$this->input->post('status')
                );

                if ($_FILES['video_file']['name'] != '') {

                    $config['upload_path'] = './uploads/materials/';
                    $config['allowed_types'] = '*';
                    $config['max_size'] = '*';
                    $config['overwrite'] = false;
                    $config['remove_spaces'] = TRUE;  //it will remove all spaces
                    $config['encrypt_name'] = true;   //it wil encrypte the original file name

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('video_file')) {

                        $error = array('error' => $this->upload->display_errors());
                        $msg = '["' . $error['error'] . '", "error", "#e50914"]';
                    } else {
                        // Uploaded file data 
                        $fileData = $this->upload->data();
                        $mydata['video_file'] = $fileData['file_name'];
                    }
                }

                if ($old_file && $_FILES['video_file']['name'] != '') {
                    if (file_exists('./uploads/materials/' . $old_file)) {
                        @unlink('./uploads/materials/' . $old_file);
                    }
                }

                $update = $this->Commonmodel->update_row('course_materials', $mydata, $where);

                if (!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) {
                    // Count total files
                    $countfiles = count($_FILES['files']['name']);

                    // Looping all files
                    for ($i = 0; $i < $countfiles; $i++) {

                        if (!empty($_FILES['files']['name'][$i])) {

                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                            // Set preference
                            $config['upload_path'] = 'uploads/materials/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['files']['name'][$i];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name

                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);


                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $uploadData[$i]['resource_file'] = $fileData['file_name'];
                                $uploadData[$i]['course_id'] = $course_id;
                                $uploadData[$i]['material_id'] = $id;
                                $uploadData[$i]['created_at'] = date("Y-m-d h:i:s");
                                $uploadData[$i]['status'] = 1;
                            }
                        }
                    }

                    if (!empty($uploadData)) {
                        $this->Commonmodel->insertBatch('course_resources', $uploadData);
                    }
                }

                $ques = $this->input->post('ques');
                $ans1 = $this->input->post('ans1');
                $ans2 = $this->input->post('ans2');
                $ans3 = $this->input->post('ans3');
                $ans4 = $this->input->post('ans4');
                $cor_ans = $this->input->post('cor_ans');
                $old_image = $this->input->post('old_image');
                $ans1_old_image = $this->input->post('ans1_old_image');
                $ans2_old_image = $this->input->post('ans2_old_image');
                $ans3_old_image = $this->input->post('ans3_old_image');
                $ans4_old_image = $this->input->post('ans4_old_image');

                // echo $old_image."--";


                if (!empty($ques)) {
                    $this->Commonmodel->delete_single_con('course_quiz', array('material_id' => $id));

                    for ($k = 0; $k < count($ques); $k++) {
                        $basicdata[] = array(
                            'course_id'         => $course_id,
                            'material_id'       => $id,
                            'question'          => $ques[$k],
                            'ans1'              => $ans1[$k],
                            'ans2'              => $ans2[$k],
                            'ans3'              => $ans3[$k],
                            'ans4'              => $ans4[$k],
                            'correct_answer'    => $cor_ans[$k],
                            'status'            => 1,
                            'created_at'        => date("Y-m-d h:i:s")
                        );

                        // echo $old_image[$k];die;
                        if (empty($old_image[$k])) {
                            $basicdata[$k]['quiz_file'] = '';
                        } else {
                            $basicdata[$k]['quiz_file'] = $old_image[$k];
                        }
                        if (!empty($_FILES['file_name']['name'][$k])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['file_name']['name'][$k];
                            $_FILES['file']['type'] = $_FILES['file_name']['type'][$k];
                            $_FILES['file']['tmp_name'] = $_FILES['file_name']['tmp_name'][$k];
                            $_FILES['file']['error'] = $_FILES['file_name']['error'][$k];
                            $_FILES['file']['size'] = $_FILES['file_name']['size'][$k];
                            // Set preference
                            $config['upload_path'] = 'uploads/quizs/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['files']['name'][$k];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name
                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $basicdata[$k]['quiz_file'] = $fileData['file_name'];
                            }
                        }


                        if ($old_image[$k] && $_FILES['file_name']['name'][$k] != '') {
                            if (file_exists('./uploads/quizs/'.$old_image[$k])) {
                                @unlink('./uploads/quizs/'.$old_image[$k]);
                            }
                        }




                        if (empty($ans1_old_image[$k])) {
                            $basicdata[$k]['ans1_file'] = '';
                        } else {
                            $basicdata[$k]['ans1_file'] = $ans1_old_image[$k];
                        }
                        if (!empty($_FILES['option1_file_name']['name'][$k])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['option1_file_name']['name'][$k];
                            $_FILES['file']['type'] = $_FILES['option1_file_name']['type'][$k];
                            $_FILES['file']['tmp_name'] = $_FILES['option1_file_name']['tmp_name'][$k];
                            $_FILES['file']['error'] = $_FILES['option1_file_name']['error'][$k];
                            $_FILES['file']['size'] = $_FILES['option1_file_name']['size'][$k];
                            // Set preference
                            $config['upload_path'] = 'uploads/quizs/answer_files/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['option1_file_name']['name'][$k];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name
                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $basicdata[$k]['ans1_file'] = $fileData['file_name'];
                            }
                        }


                        if ($ans1_old_image[$k] && $_FILES['option1_file_name']['name'][$k] != '') {
                            if (file_exists('./uploads/quizs/answer_files/'.$ans1_old_image[$k])) {
                                @unlink('./uploads/quizs/answer_files/'.$ans1_old_image[$k]);
                            }
                        }



                        if (empty($ans2_old_image[$k])) {
                            $basicdata[$k]['ans2_file'] = '';
                        } else {
                            $basicdata[$k]['ans2_file'] = $ans2_old_image[$k];
                        }
                        if (!empty($_FILES['option2_file_name']['name'][$k])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['option2_file_name']['name'][$k];
                            $_FILES['file']['type'] = $_FILES['option2_file_name']['type'][$k];
                            $_FILES['file']['tmp_name'] = $_FILES['option2_file_name']['tmp_name'][$k];
                            $_FILES['file']['error'] = $_FILES['option2_file_name']['error'][$k];
                            $_FILES['file']['size'] = $_FILES['option2_file_name']['size'][$k];
                            // Set preference
                            $config['upload_path'] = 'uploads/quizs/answer_files/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['option2_file_name']['name'][$k];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name
                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $basicdata[$k]['ans2_file'] = $fileData['file_name'];
                            }
                        }


                        if ($ans2_old_image[$k] && $_FILES['option2_file_name']['name'][$k] != '') {
                            if (file_exists('./uploads/quizs/answer_files/'.$ans2_old_image[$k])) {
                                @unlink('./uploads/quizs/answer_files/'.$ans2_old_image[$k]);
                            }
                        }


                        if (empty($ans3_old_image[$k])) {
                            $basicdata[$k]['ans3_file'] = '';
                        } else {
                            $basicdata[$k]['ans3_file'] = $ans3_old_image[$k];
                        }
                        if (!empty($_FILES['option3_file_name']['name'][$k])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['option3_file_name']['name'][$k];
                            $_FILES['file']['type'] = $_FILES['option3_file_name']['type'][$k];
                            $_FILES['file']['tmp_name'] = $_FILES['option3_file_name']['tmp_name'][$k];
                            $_FILES['file']['error'] = $_FILES['option3_file_name']['error'][$k];
                            $_FILES['file']['size'] = $_FILES['option3_file_name']['size'][$k];
                            // Set preference
                            $config['upload_path'] = 'uploads/quizs/answer_files/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['option3_file_name']['name'][$k];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name
                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $basicdata[$k]['ans3_file'] = $fileData['file_name'];
                            }
                        }


                        if ($ans3_old_image[$k] && $_FILES['option3_file_name']['name'][$k] != '') {
                            if (file_exists('./uploads/quizs/answer_files/'.$ans3_old_image[$k])) {
                                @unlink('./uploads/quizs/answer_files/'.$ans3_old_image[$k]);
                            }
                        }


                        if (empty($ans4_old_image[$k])) {
                            $basicdata[$k]['ans4_file'] = '';
                        } else {
                            $basicdata[$k]['ans4_file'] = $ans4_old_image[$k];
                        }
                        if (!empty($_FILES['option4_file_name']['name'][$k])) {
                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['option4_file_name']['name'][$k];
                            $_FILES['file']['type'] = $_FILES['option4_file_name']['type'][$k];
                            $_FILES['file']['tmp_name'] = $_FILES['option4_file_name']['tmp_name'][$k];
                            $_FILES['file']['error'] = $_FILES['option4_file_name']['error'][$k];
                            $_FILES['file']['size'] = $_FILES['option4_file_name']['size'][$k];
                            // Set preference
                            $config['upload_path'] = 'uploads/quizs/answer_files/';
                            $config['allowed_types'] = '*';
                            $config['max_size'] = '*'; // max_size in kb
                            $config['file_name'] = $_FILES['option4_file_name']['name'][$k];
                            $config['overwrite'] = false;
                            $config['remove_spaces'] = true;  //it will remove all spaces
                            $config['encrypt_name'] = false;   //it wil encrypte the original file name
                            //Load upload library
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            // File upload
                            if ($this->upload->do_upload('file')) {
                                // Get data about the file
                                $fileData = $this->upload->data();
                                $basicdata[$k]['ans4_file'] = $fileData['file_name'];
                            }
                        }


                        if ($ans4_old_image[$k] && $_FILES['option4_file_name']['name'][$k] != '') {
                            if (file_exists('./uploads/quizs/answer_files/'.$ans4_old_image[$k])) {
                                @unlink('./uploads/quizs/answer_files/'.$ans4_old_image[$k]);
                            }
                        }





                    }

                 
                    $this->db->insert_batch('course_quiz', $basicdata);
                }

                $msg = '["Course Material updated successfully!", "success", "#36A1EA"]';
                $this->session->set_flashdata('msg', $msg);

                redirect(admin_url('course/material_list/' . $course_id));
            } else {
                redirect(admin_url('course/update_material/' . "/" . $course_id . "/" . $id), 'refresh');
            }
        } else {
            $msg = '["Some error occured, Please try again!", "error", "#e50914"]';
            $this->session->set_flashdata('msg', $msg);

            redirect(admin_url('course/update_material/' . "/" . $course_id . "/" . $id), 'refresh');
        }
    }

    public function edit_question($corssid, $qid)
    {

        $this->data['title'] = 'Update Question';
        $this->data['tab'] = 'add_products';
        $this->data['main'] = admin_view('course/question_edit');
        $this->data['quizq'] = $this->Course_model->getRow($qid, 'course_quiz');
        $this->form_validation->set_rules('frm[ques]', 'Question', 'required');
        if ($this->form_validation->run()) {
            $formdata = $this->input->post('frm');
            //print_r($_POST);die;

            $this->db->update('course_quiz', $formdata, array('id' => $qid));
            //echo $this->db->last_query();die();
            $this->session->set_flashdata("success", "Question detail saved");
            redirect(admin_url('course/material_list/' . $corssid));
        }
        $this->load->view(admin_view('default'), $this->data);
    }

    function delete_material($id, $course_id)
    {
        if ($id > 0) {
            $result = $this->db->get_where('course_resources', array('material_id' => $id))->result();

            if (!empty($result)) {
                foreach ($result as $key => $value) {
                    if (@$value->resource_file && file_exists('./uploads/materials/' . @$value->resource_file)) {
                        @unlink('./uploads/materials/' . @$value->resource_file);
                    }
                }
            }

            $data = $this->db->get_where('course_materials', array('id' => $id))->row();

            if (@$data->video_file && file_exists('./uploads/materials/' . @$data->video_file)) {
                @unlink('./uploads/materials/' . @$data->video_file);
            }

            $this->Commonmodel->delete_single_con('course_resources', array('material_id' => $id));
            $this->Commonmodel->delete_single_con('course_quiz', array('material_id' => $id));

            $this->Course_model->delete($id, 'course_materials');
            $this->session->set_flashdata('success', 'Course Material deleted successfully');
        }
        redirect(admin_url('course/material_list/' . $course_id));
    }

    public function purchaseCourse() {
        //print_r($_POST); die();
        $member = $this->input->post('member');
        $course_id = $this->input->post('assigncourseID');
        $getCoursePrice = $this->db->query('select price from courses where id ="'.$course_id.'"')->result_array();
        $enrollment_price = @$getCoursePrice[0]['price'];
        $price_cents = number_format((float)$enrollment_price, 2, '.', '');;
        $currency = 'USD';
        $currency_symbol = '$';
        //$transaction_id	= $randomString;
        for ($i=0; $i< count($member); $i++) {
            $n=29;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($j = 0; $j < $n; $j++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
            //echo "INSERT INTO course_enrollment (`course_id`, `user_id`, `enrollment_price`, `price_cents`, `currency`, `currency_symbol`, `payment_status`, `transaction_id`) VALUES ('$course_id', '$member[$i]', '$enrollment_price', '$price_cents', '$currency', '$currency_symbol', 'COMPLETED', '$randomString')"; die();
            $this->db->query("INSERT INTO course_enrollment (`course_id`, `user_id`, `enrollment_price`, `price_cents`, `currency`, `currency_symbol`, `payment_status`, `transaction_id`) VALUES ('$course_id', '$member[$i]', '$enrollment_price', '$price_cents', '$currency', '$currency_symbol', 'COMPLETED', '$randomString')");
        }
        echo '1';
    }
    public function assignInstructortoCourse() {
        //print_r($_POST); die();
        $member = $this->input->post('member');
        $course_id = $this->input->post('assigncourseID');
        if(!empty($member) || !empty($course_id)) {
            $query = $this->db->query("UPDATE courses SET assigned_instrustor = '".$member."' WHERE id = '".$course_id."'");
            echo '1';
        } else {
            echo "2";
        }
    }

    public function purchased_course($page=1) {
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $show_per_page = 10;
        $offset = ($page - 1) * $show_per_page;
        $this->data['title'] = 'Course Purchased List';
        $this->data['tab'] = 'purchased_course';
        $this->data['main'] = admin_view('course/purchased_course');
        $course = $this->Course_model->getAllcoursepurchesed($offset, $show_per_page);
        $this->data['course_order_details'] = $this->db->query("SELECT * FROM course_enrollment ORDER BY enrollment_id DESC")->result_array();
        $config['num_links'] = 2;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $course['total'];
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

/* End of file Products.php */
/* Location: ./application/controllers/admin/Products.php */
