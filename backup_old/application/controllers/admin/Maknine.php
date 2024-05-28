<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maknine extends AI_Controller {

	public function __construct()
	{
		parent::__construct();
		$config['upload_path']          = './uploads/maknine';
		$config['allowed_types']        = 'gif|jpg|png';
		$this->load->library('upload', $config);
        $this->data['title'] = '';
        $this->data['tab'] = '';
		$this->data['title'] = 'Maknine';
		$this->data['tab'] = 'maknine';
		$this->load->model('Maknine_model');
	}
	public function index($page = 1) {	
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$show_per_page = 5;
		$offset = ($page - 1) * $show_per_page;
		$this->data['title'] = 'Maknine';
		$this->data['tab'] = 'maknine';
		$this->data['main'] = admin_view('maknine/index');
		$maknine = $this->Maknine_model->getAll($offset, $show_per_page,'mak_zeronine');
		//echo $this->db->last_query();die();
		$this->data['maknine'] = $maknine['results'];
		$config['base_url'] = admin_url('maknine/index');
		$config['num_links'] = 2;
		$config['uri_segment'] = 4;
		$config['total_rows'] = $maknine['total'];
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
	public function add($id = false){
		$this->data['title'] = 'Add Image';
		$this->data['tab'] = 'add_maknine';
		$this->data['main'] = admin_view('maknine/add');
		$this->data['maknine'] = $this->Master_model->getNew('mak_zeronine');
		if ($id) {
			$this->data['maknine'] = $maknine = $this->Master_model->getRow($id,'mak_zeronine');
			if(!isset($maknine)){
				redirect(site_url('404_override'));
				exit();
			}
		}
		
		if ($this->input->post()) {
			print_r($this->input->post());
			if (!empty($_FILES['image']['name'][0])) {
				$cpt = count($_FILES['image']['name']);
				for($i=0; $i<$cpt; $i++) {
					$src = $_FILES['image']['tmp_name'][$i];
					$avatar = str_replace(array('(', ')', ' '), '', rand(0000, 9999) . "_" . $_FILES['image']['name'][$i]);  echo "<br>"; 
					$dest = getcwd() . '/uploads/maknine/' . $avatar;
					if (move_uploaded_file($src, $dest)) {
						$file  = $avatar;
						@unlink('uploads/maknine/' . $_POST['image']);
					}
					if(!empty($file)) {
						$image = $file;
					} else {
						$link = "";
					}
					$data_image = array(
						'id' => @$id,
						'image' => $file,
						'presentation_for' => $this->input->post('presentation_for'),
						'status' => 1,
						'created_date' => date("Y-m-d H:i:s"),
					);
					//echo "<pre>"; print_r($data_image);
					$this->Maknine_model->save($data_image, 'mak_zeronine');
					$this->session->set_flashdata('message', 'Image added Successfully !');
				}
			} else {
				$data_image = array(
					'id' => @$id,
					'presentation_for' => $this->input->post('presentation_for'),
					'status' => 1,
					'created_date' => date("Y-m-d H:i:s"),
				);
				print_r($data_image);
				$this->Maknine_model->save($data_image, 'mak_zeronine');
				$this->session->set_flashdata('message', 'Data updated Successfully !');
			}
			$this->session->set_flashdata("success", "Image saved");
			redirect(admin_url('maknine/index'));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}
	function activate($id = false) {
		$redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('maknine');
		if ($id) {
			$c['id'] = $id;
			$c['status'] = 1;
			$this->Maknine_model->save($c,'mak_zeronine');
			$this->session->set_flashdata("success", "Image activated");
		}
		redirect($redirect);
	}
	function deactivate($id = false) {
		$redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('maknine');
		if ($id) {
			$c['id'] = $id;
			$c['status'] = 0;
			$this->Maknine_model->save($c,'mak_zeronine');
			$this->session->set_flashdata("success", "image deactivated");
		}
		redirect($redirect);
	}
	function delete($id){
		if ($id > 0) {
			$this->Maknine_model->delete($id,'mak_zeronine');
			$this->session->set_flashdata('success', 'Image deleted successfully ');
		}
		redirect(admin_url('maknine'));
	}
}