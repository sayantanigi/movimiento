<?php
class Conference extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session'));
		if ($this->session->userdata('isLoggedIn') != 1) {
			redirect('login', 'refresh');
		}
		$this->load->model('supercontrol/Conference_model');
		$this->load->library('image_lib');
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
	}
	/*function index() {
		if ($this->session->userdata('isLoggedIn') != 1) {
			redirect('supercontrol/newsadd_view');
		} else {
			$this->load->view('supercontrol/login');
		}
	}*/
	function conference_add_form() {
		$data['title'] = "Add Conference";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/conferenceadd_view');
		$this->load->view('supercontrol/footer');
	}
	function add_conference() {
		$my_date = date("Y-m-d h:i");
		$config = array(
			'upload_path' => "./uploads/conference/",
			'upload_url' => base_url() . "./uploads/conference/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf|docx",
		);
		$this->load->library('upload', $config);
		$this->form_validation->set_rules('conference_title', 'Conference Title', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('supercontrol/header');
			$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/conferenceadd_view', $data);
			$this->load->view('supercontrol/footer');
		} else {
			$slug = $this->input->post('conference_title');
			if (empty($slug) || $slug == '') {
				$slug = $this->input->post('conference_title');
			}
			$slug = strtolower(url_title($slug));
			if (!$this->upload->do_upload('userfile')) {
				$data = array(
					'title' => $this->input->post('conference_title'),
					'slug' => $slug,
					'uploaded_by' => $this->session->userdata('user_id'),
					'category' => $this->input->post('category'),
					'description' => $this->input->post('conference_desc'),
					'date' => $this->input->post('conference_date'),
					'status' => $this->input->post('status'),
					'created_at' => $my_date
				);
				$this->Conference_model->insert_conference($data);
				$upload_data = $this->upload->data();
				$query = $this->Conference_model->show_conference();
				$data['ecms'] = $query;
				$data['success_msg'] = '<div class="alert alert-success text-center">Your Data Successfully Uploaded!</div>';
				$this->load->view('supercontrol/header', $data);
				$this->load->view('supercontrol/conferenceview', $data);
				$this->load->view('supercontrol/footer');
			} else {
				$data['userfile'] = $this->upload->data();
				$this->upload->do_upload('attachment');
				$data['attachment'] = $this->upload->data();
				//echo "<pre>"; print_r($data); die();
				$filename = $data['userfile']['file_name'];
				$attachment = $data['attachment']['file_name'];
				$data = array(
					'title' => $this->input->post('conference_title'),
					'slug' => $slug,
					'category' => $this->input->post('category'),
					'uploaded_by' => $this->session->userdata('user_id'),
					'description' => $this->input->post('conference_desc'),
					'date' => $this->input->post('conference_date'),
					'image' => $filename,
					'attachment' => $attachment,
					'status' => $this->input->post('status'),
					'created_at' => $my_date
				);
				$this->Conference_model->insert_conference($data);
				$upload_data = $this->upload->data();
				$query = $this->Conference_model->show_conference();
				$data['ecms'] = $query;
				$data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>' . $upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
				$this->load->view('supercontrol/header', $data);
				$this->load->view('supercontrol/conference_view', $data);
				$this->load->view('supercontrol/footer');
			}
		}
		redirect('supercontrol/conference/show_conference');
	}
	function success() {
		$data['h1title'] = 'Add Conference';
		$data['title'] = 'Add Conference';
		$this->load->view('supercontrol/header');
		$this->load->view('supercontrol/conferencesadd_view', $data);
		$this->load->view('supercontrol/footer');
	}
	function show_conference() {
		$this->load->database();
		$this->load->model('supercontrol/Conference_model');
		$query = $this->Conference_model->show_conference();
		$data['ecms'] = $query;
		$data['title'] = "Conference List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/conference_view');
		$this->load->view('supercontrol/footer');
	}
	function statusconference() {
		$stat = $this->input->get('stat');
		$id = $this->input->get('id');
		$this->load->model('supercontrol/Conference_model');
		$this->Conference_model->updt($stat, $id);
	}
	function show_conference_id($id) {
		$id = $this->uri->segment(4);
		$data['title'] = "Edit Conference";
		$this->load->database();
		$this->load->model('supercontrol/Conference_model');
		$query = $this->Conference_model->show_conference_id($id);
		$data['ecms'] = $query;
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/conference_edit', $data);
		$this->load->view('supercontrol/footer');
	}
	function edit_conference() {
		$conference_image = $this->input->post('conference_image');
		$conference_attachment = $this->input->post('conference_attachment');
		$config = array(
			'upload_path' => "./uploads/conference/",
			'upload_url' => base_url() . "./uploads/conference/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf|docx",
		);
		$this->load->library('upload', $config);
		$slug = $this->input->post('conference_title');
		if (empty($slug) || $slug == '') {
			$slug = $this->input->post('conference_title');
		}
		$slug = strtolower(url_title($slug));
		if ($this->upload->do_upload("userfile")) {
			@unlink("uploads/conference/" . $conference_image);
			$data['img'] = $this->upload->data();
			$datalist = array(
				'title' => $this->input->post('conference_title'),
				'slug' => $slug,
				'category' => $this->input->post('category'),
				'uploaded_by' => $this->session->userdata('user_id'),
				'description' => $this->input->post('conference_desc'),
				'date' => $this->input->post('conference_date'),
				'image' => $data['img']['file_name'],
				'status' => $this->input->post('status'),
				'created_at' => date("Y-m-d h:i")
			);
			$id = $this->input->post('conference_id');
			$data['title'] = "Conference Edit";
			$this->load->database();
			$this->load->model('supercontrol/Conference_model');
			$query = $this->Conference_model->conference_edit($id, $datalist);
			$data1['message'] = 'Data Update Successfully';
			$query = $this->Conference_model->show_conferencelist();
			$data['ecms'] = $query;
			$data['title'] = "Conference Page List";
			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/conference_view', $data1);
			$this->load->view('supercontrol/footer');
		} else if ($this->upload->do_upload("attachment")) {
			@unlink("uploads/conference/" . $conference_attachment);
			$data['attachment'] = $this->upload->data();
			$datalist = array(
				'title' => $this->input->post('conference_title'),
				'slug' => $slug,
				'category' => $this->input->post('category'),
				'uploaded_by' => $this->session->userdata('user_id'),
				'description' => $this->input->post('conference_desc'),
				'date' => $this->input->post('conference_date'),
				'attachment' => $data['attachment']['file_name'],
				'status' => $this->input->post('status'),
				'created_at' => date("Y-m-d h:i")
			);
			$id = $this->input->post('conference_id');
			$data['title'] = "Conference Edit";
			$this->load->database();
			$this->load->model('supercontrol/Conference_model');
			$query = $this->Conference_model->conference_edit($id, $datalist);
			$data1['message'] = 'Data Update Successfully';
			$query = $this->Conference_model->show_conferencelist();
			$data['ecms'] = $query;
			$data['title'] = "Conference Page List";
			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/conference_view', $data1);
			$this->load->view('supercontrol/footer');
		} else {
			$datalist = array(
				'title' => $this->input->post('conference_title'),
				'slug' => $slug,
				'category' => $this->input->post('category'),
				'uploaded_by' => $this->session->userdata('user_id'),
				'description' => $this->input->post('conference_desc'),
				'date' => $this->input->post('conference_date'),
				'status' => $this->input->post('status'),
				'created_at' => date("Y-m-d h:i")
			);
			$id = $this->input->post('conference_id');
			$data['title'] = "Conference Edit";
			$this->load->database();
			$this->load->model('supercontrol/Conference_model');
			$query = $this->Conference_model->conference_edit($id, $datalist);
			$data1['message'] = 'Data Update Successfully';
			$query = $this->Conference_model->show_conferencelist();
			$data['ecms'] = $query;
			$data['title'] = "Conference Page List";
			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/conference_view', $data1);
			$this->load->view('supercontrol/footer');
		}
		redirect('supercontrol/conference/show_conference');
	}
	function delete_conference() {
		$id = $this->uri->segment(4);
		$result = $this->Conference_model->show_conference_id($id);
		//print_r($result);
		$conference_image = $result[0]->conference_image;
		//echo $banner_img;exit();
		$this->load->database();
		$query = $this->Conference_model->delete_conference($id, $conference_image);
		$data['ecms'] = $query;
		$this->load->view('supercontrol/header', $data);
		//$this->load->view('showbannerlist', $data);
		redirect('supercontrol/conference/show_conference');
		$this->load->view('supercontrol/footer');
	}
	function delete_multiple() {
		$ids = (explode(',', $this->input->get_post('ids')));
		$this->Conference_model->delete_mul($ids);
		$this->load->view('supercontrol/header');
		redirect('supercontrol/conference/show_conference');
		$this->load->view('supercontrol/footer');
	}
	public function Logout() {
		$this->session->sess_destroy();
		redirect('supercontrol/login');
	}
}
?>