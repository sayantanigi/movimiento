<?php
ob_start();
class Category extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library(array('form_validation', 'session'));
		if($this->session->userdata('isLoggedIn') != TRUE){
			redirect('login', 'refresh');
		}
		$this->load->model('supercontrol/category_model');
		$this->load->model('generalmodel');
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->library('image_lib');
	}
	function index() {
		$data['categories'] = $this->category_model->category_menu();
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/categoryadd_view', $data);
		$this->load->view('supercontrol/footer');
	}
	function category_add_form() {
		$data['title'] = "Add Category";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/categoryadd_view');
		$this->load->view('supercontrol/footer');
	}
	function add_category() {
		$my_date = date("Y-m-d", time());
		$config = array(
			'upload_path' => "uploads/categoryimage/",
			'upload_url' => base_url() . "uploads/categoryimage/",
			'allowed_types' => "gif|jpg|png|jpeg"
		);
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('userfile')) {
			$data = array(
				'category_name' => $this->input->post('name'),
				'userid' => $this->session->userdata('user_id')
			);
			//print_r($data); exit();
			$this->load->model('supercontrol/category_model');
			$this->category_model->insert_category($data);
			$this->load->view('supercontrol/header', $data);
			$data['categories'] = $this->category_model->category_menu();
			$data['success_msg'] = '<div class="alert alert-success text-center">Data Added Successfully!</div>';
			$this->load->view('supercontrol/categoryadd_view', $data);
			$this->load->view('supercontrol/footer');
			redirect('supercontrol/category/show_category', 'refresh');
		} else {
			$data['userfile'] = $this->upload->data();
			$filename = $data['userfile']['file_name'];
			$data = array(
				'category_name' => $this->input->post('name'),
				'sort_order' => $this->input->post('sort_order'),
				'parent_id' => $this->input->post('pid'),
				'category_image' => $filename
			);
			//print_r($data); exit();
			$this->load->model('supercontrol/category_model');
			$this->category_model->insert_category($data);
			$this->load->view('supercontrol/header', $data);
			//$this->load->view('category/success',$data);
			$data['categories'] = $this->category_model->category_menu();
			$data['success_msg'] = '<div class="alert alert-success text-center">Data Added Successfully!</div>';
			$this->load->view('supercontrol/categoryadd_view', $data);
			//redirect('category',$data);
			$this->load->view('supercontrol/footer');
			redirect('supercontrol/category/show_category', 'refresh');
		}
	}
	function success() {
		$data['h1title'] = 'Add Category';
		$data['title'] = 'Add Category';
		$this->load->view('supercontrol/header');
		$this->load->view('supercontrol/categoryadd_view', $data);
		$this->load->view('supercontrol/footer');
	}
	function show_category() {
		$this->load->database();
		$this->load->model('supercontrol/category_model');
		$query = $this->category_model->show_category();
		$data['eloca'] = $query;
		$data['title'] = "Category List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showcategorylist', $data);
		$this->load->view('supercontrol/footer');
	}
	function statusnews() {
		$stat = $this->input->get('stat');
		$id = $this->input->get('id');
		$this->load->model('news_model');
		$this->news_model->updt($stat, $id);
	}
	function show_category_id($id) {
		$data['title'] = "Edit Category";
		$queryallcat = $this->db->query("SELECT * FROM sm_category WHERE id = '".$id."'")->result_array();
		//echo $this->db->last_query(); exit();
		$data['eallcat'] = $queryallcat;
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/category_edit', $data);
		$this->load->view('supercontrol/footer');
	}
	function edit_category() {
		$datalist = array(
			'category_name' => $this->input->post('category_name')
		);
		$id = $this->input->post('category_id');
		$data['title'] = "Category Edit";
		$query = $this->category_model->category_edit($id, $datalist);
		//echo $ddd=$this->db->last_query(); exit();
		$data1['message'] = 'Updated Successfully';
		$this->session->set_flashdata('success', 'Data Updated Successfully !!!');
		redirect('supercontrol/category/show_category', $data1);
	}
	//================Update Individual  Category ***** END HERE====================

	//=====================DELETE LOCATION====================
	function delete_category($id) {
		$query = $this->db->query("SELECT * FROM sm_category WHERE id = '".$id."'")->num_rows();
		if ($query > 0) {
			$this->db->query("DELETE FROM sm_category WHERE id = '".$id."'");
			$data2['message'] = 'Deleted Successfully';
			$data['title'] = "Category Page List";
			$data['eloca'] = $query;
			$data['title'] = "Category Page List";
			$this->session->set_flashdata('success', 'Data Deleted !!!!');
			redirect('supercontrol/category/show_category', TRUE);
		} else {
			$this->session->set_flashdata('success', 'You Can Not Delete A Parent Category');
			redirect('supercontrol/category/show_category', TRUE);
		}
	}
	//=====================DELETE LOCATION====================
	//====================MULTIPLE DELETE=================
	function delete_multiple() {
		$ids = (explode(',', $this->input->get_post('ids')));
		$this->news_model->delete_mul($ids);
		$this->load->view('header');
		redirect('news/show_news');
		$this->load->view('footer');
	}
}

?>