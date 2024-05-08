<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Portfolio extends AI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Portfolio_model');

		$config['upload_path']          = './uploads/portfolio';
		//$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);
        $this->data['title'] = '';
        $this->data['tab'] = '';
    }
	public function index($page = 1)
	{	
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$show_per_page = 5;
		$offset = ($page - 1) * $show_per_page;
		$this->data['title'] = 'Portfolio List';
		$this->data['tab'] = 'portfolio';
		$this->data['main'] = admin_view('portfolio/index');
		$portfolio = $this->Portfolio_model->getAll($offset, $show_per_page,'portfolio');
		//echo $this->db->last_query();die();
		$this->data['portfolio'] = $portfolio['results'];
		$config['base_url'] = admin_url('portfolio/index');
		$config['num_links'] = 2;
		$config['uri_segment'] = 4;
		$config['total_rows'] = $portfolio['total'];
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
		$this->data['title'] = 'Add Portfolio';
		$this->data['tab'] = 'ad_portfolio';
		$this->data['main'] = admin_view('portfolio/add');
		$this->data['portfolio'] = $this->Master_model->getNew('portfolio');
		if ($id) {
			$this->data['portfolio'] = $portfolio = $this->Master_model->getRow($id,'portfolio');
			if(!isset($portfolio)){
				redirect(site_url('404_override'));
				exit();
			}
		}
		
		if ($this->input->post()) {
			if (!empty($_FILES['image']['name'][0])) {
				$cpt = count($_FILES['image']['name']);
				for($i=0; $i<$cpt; $i++) {
					$src = $_FILES['image']['tmp_name'][$i];
					echo $avatar = str_replace(array('(', ')', ' '), '', rand(0000, 9999) . "_" . $_FILES['image']['name'][$i]);  echo "<br>"; 
					$dest = getcwd() . '/uploads/portfolio/' . $avatar;
					if (move_uploaded_file($src, $dest)) {
						$file  = $avatar;
						@unlink('uploads/portfolio/' . $_POST['image']);
					}
					if(!empty($file)) {
						$image = $file;
					} else {
						$link = "";
					}
					$data_image = array(
						'id' => @$id,
						'portfolioId' => $this->input->post('portfolioId'),
						'image' => $file,
						'status' => 1,
						'created_date' => date("Y-m-d H:i:s"),
					);
					//echo "<pre>"; print_r($data_image);
					$this->Portfolio_model->save($data_image, 'portfolio');
					$this->session->set_flashdata('message', 'Portfolio Created Successfully !');
				}
			}
			$this->session->set_flashdata("success", "Portfolio detail saved");
			redirect(admin_url('portfolio/index'));
		}		
		$this->load->view(admin_view('default'),$this->data);
	}

	function activate($id = false) {
		$redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('portfolio');
		if ($id) {
			$c['id'] = $id;
			$c['status'] = 1;
			$this->Portfolio_model->save($c,'portfolio');
			$this->session->set_flashdata("success", "Portfolio activated");
		}
		redirect($redirect);
	}

	function deactivate($id = false)
	{
		$redirect = isset($_GET['redirect_to']) ? $_GET['redirect_to'] : admin_url('portfolio');
		if ($id) {
			$c['id'] = $id;
			$c['status'] = 0;
			$this->Portfolio_model->save($c,'portfolio');
			$this->session->set_flashdata("success", "Portfolio deactivated");
		}
		redirect($redirect);
	}

	function delete($id){
		if ($id > 0) {
			$this->Portfolio_model->delete($id,'portfolio');
			$this->session->set_flashdata('success', 'Portfolio deleted successfully ');
		}
		redirect(admin_url('portfolio'));
	}
}

/* End of file Gallery.php */
/* Location: ./application/controllers/admin/Gallery.php */