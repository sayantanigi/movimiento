<?php
class News extends CI_Controller {
	//============Constructor to call Model====================
	function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation', 'session'));
		if ($this->session->userdata('isLoggedIn') != 1) {
			redirect('login', 'refresh');
		}
		$this->load->model('supercontrol/News_model');
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
	function news_add_form() {
		$data['title'] = "Add News";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/newsadd_view');
		$this->load->view('supercontrol/footer');
	}
	function add_news() {
		$my_date = date("Y-m-d h:i");
		$config = array(
			'upload_path' => "./uploads/blog/",
			'upload_url' => base_url() . "./uploads/blog/",
			'allowed_types' => "gif|jpg|png|jpeg"
		);
		$this->load->library('upload', $config);
		$this->form_validation->set_rules('news_title', 'News Title', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('supercontrol/header');
			$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/newsadd_view', $data);
			$this->load->view('supercontrol/footer');
		} else {
			$slug = $this->input->post('news_title');
			if (empty($slug) || $slug == '') {
				$slug = $this->input->post('news_title');
			}
			$slug = strtolower(url_title($slug));
			if (!$this->upload->do_upload('userfile')) {
				$data = array(
					'title' => $this->input->post('news_title'),
					'slug' => $slug,
					'uploaded_by' => $this->session->userdata('user_id'),
					'popular' => $this->input->post('popular'),
					'description' => $this->input->post('news_desc'),
					'status' => $this->input->post('status'),
					'created_at' => $my_date
				);
				$this->News_model->insert_news($data);
				$upload_data = $this->upload->data();
				$query = $this->News_model->show_news();
				$data['ecms'] = $query;
				$data['success_msg'] = '<div class="alert alert-success text-center">Your Data Successfully Uploaded!</div>';
				$this->load->view('supercontrol/header', $data);
				$this->load->view('supercontrol/shownewslist', $data);
				$this->load->view('supercontrol/footer');
			} else {
				$data['userfile'] = $this->upload->data();
				$filename = $data['userfile']['file_name'];
				$data = array(
					'title' => $this->input->post('news_title'),
					'slug' => $slug,
					'uploaded_by' => $this->session->userdata('user_id'),
					'popular' => $this->input->post('popular'),
					'description' => $this->input->post('news_desc'),
					'image' => $filename,
					'status' => $this->input->post('status'),
					'created_at' => $my_date
				);
				$this->News_model->insert_news($data);
				$upload_data = $this->upload->data();
				$query = $this->News_model->show_news();
				$data['ecms'] = $query;
				$data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>' . $upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
				$this->load->view('supercontrol/header', $data);
				$this->load->view('supercontrol/shownewslist', $data);
				$this->load->view('supercontrol/footer');
			}
		}
		redirect('supercontrol/news/show_news');
	}
	function success() {
		$data['h1title'] = 'Add News';
		$data['title'] = 'Add News';
		$this->load->view('supercontrol/header');
		$this->load->view('supercontrol/newsadd_view', $data);
		$this->load->view('supercontrol/footer');
	}
	function show_news() {
		$this->load->database();
		$this->load->model('supercontrol/News_model');
		$query = $this->News_model->show_news();
		$data['ecms'] = $query;
		$data['title'] = "News List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/shownewslist');
		$this->load->view('supercontrol/footer');
	}
	function statusnews() {
		$stat = $this->input->get('stat');
		$id = $this->input->get('id');
		$this->load->model('supercontrol/News_model');
		$this->News_model->updt($stat, $id);
	}
	function show_news_id($id) {
		$id = $this->uri->segment(4);
		$data['title'] = "Edit News";
		$this->load->database();
		$this->load->model('supercontrol/News_model');
		$query = $this->News_model->show_news_id($id);
		$data['ecms'] = $query;
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/news_edit', $data);
		$this->load->view('supercontrol/footer');
	}
	function edit_news() {
		$news_image = $this->input->post('news_image');
		$config = array(
			'upload_path' => "./uploads/blog/",
			'upload_url' => base_url() . "./uploads/blog/",
			'allowed_types' => "gif|jpg|png|jpeg"
		);
		$this->load->library('upload', $config);
		$slug = $this->input->post('news_title');
		if (empty($slug) || $slug == '') {
			$slug = $this->input->post('news_title');
		}
		$slug = strtolower(url_title($slug));
		if ($this->upload->do_upload("userfile")) {
			@unlink("uploads/blog/" . $news_image);
			$data['img'] = $this->upload->data();
			$datalist = array(
				'title' => $this->input->post('news_title'),
				'slug' => $slug,
				'uploaded_by' => $this->session->userdata('user_id'),
				'popular' => $this->input->post('popular'),
				'description' => $this->input->post('news_desc'),
				'image' => $data['img']['file_name'],
				'status' => $this->input->post('status'),
				'created_at' => date("Y-m-d h:i")
			);
			$id = $this->input->post('news_id');
			$data['title'] = "News Edit";
			$this->load->database();
			$this->load->model('supercontrol/News_model');
			$query = $this->News_model->news_edit($id, $datalist);
			$data1['message'] = 'Data Update Successfully';
			$query = $this->News_model->show_newslist();
			$data['ecms'] = $query;
			$data['title'] = "News Page List";
			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/shownewslist', $data1);
			$this->load->view('supercontrol/footer');
		} else {
			$datalist = array(
				'title' => $this->input->post('news_title'),
				'slug' => $slug,
				'uploaded_by' => $this->session->userdata('user_id'),
				'popular' => $this->input->post('popular'),
				'description' => $this->input->post('news_desc'),
				'status' => $this->input->post('status'),
				'created_at' => date("Y-m-d h:i")
			);
			$id = $this->input->post('news_id');
			$data['title'] = "News Edit";
			$this->load->database();
			$this->load->model('supercontrol/News_model');
			$query = $this->News_model->news_edit($id, $datalist);
			$data1['message'] = 'Data Update Successfully';
			$query = $this->News_model->show_newslist();
			$data['ecms'] = $query;
			$data['title'] = "News Page List";
			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/shownewslist', $data1);
			$this->load->view('supercontrol/footer');
		}
		redirect('supercontrol/news/show_news');
	}
	function delete_news() {
		$id = $this->uri->segment(4);
		$result = $this->News_model->show_news_id($id);
		//print_r($result);
		$news_image = $result[0]->news_image;
		//echo $banner_img;exit();
		$this->load->database();
		$query = $this->News_model->delete_news($id, $news_image);
		$data['ecms'] = $query;
		$this->load->view('supercontrol/header', $data);
		//$this->load->view('showbannerlist', $data);
		redirect('supercontrol/news/show_news');
		$this->load->view('supercontrol/footer');
	}
	function delete_multiple() {
		$ids = (explode(',', $this->input->get_post('ids')));
		$this->News_model->delete_mul($ids);
		$this->load->view('supercontrol/header');
		redirect('supercontrol/news/show_news');
		$this->load->view('supercontrol/footer');
	}
	public function Logout() {
		$this->session->sess_destroy();
		redirect('supercontrol/login');
	}
}
?>