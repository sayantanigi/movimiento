<?php
class Country extends CI_Controller
{
	//============Constructor to call Model====================
	function __construct()
	{
		parent::__construct();
		//$this->load->model('categorymodel', 'cat');
		$this->load->helper('form');
		$this->load->library(array('form_validation', 'session'));
		if ($this->session->userdata('is_logged_in') != 1) {
			redirect('supercontrol/home', 'refresh');
		}
		$this->load->model('supercontrol/country_model', 'countrys');
		$this->load->model('generalmodel');
		//****************************backtrace prevent*** START HERE*************************
		$this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
		$this->output->set_header('Pragma: no-cache');
		//****************************backtrace prevent*** END HERE*************************
		$this->load->library('image_lib');
	}
	//============Constructor to call Model====================
	function index()
	{
		if ($this->session->userdata('is_logged_in')) {
			$this->load->view('supercontrol/header', $data);
			$this->load->view('supercontrol/countryadd_view', $data);
			$this->load->view('supercontrol/footer');
			//redirect('categoryadd_view');
		} else {
			$this->load->view('supercontrol/login');
		}
	}
	//======================Show Add form for category add **** START HERE========================	
	function category_add_form()
	{
		$data['title'] = "Add Country";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/countryadd_view');
		$this->load->view('supercontrol/footer');
	}

	//====================== Show Add form for category add ****END HERE========================
	//=======================Insert Page Data============
	function add_country()
	{
		$data = array(
			'country_name' => $this->input->post('country_name'),
			'userid' => $this->session->userdata('userid')
		);

		//print_r($data); exit();
		$this->load->model('supercontrol/country_model');
		$this->country_model->insert_country($data);
		$this->load->view('supercontrol/header', $data);

		$data['success_msg'] = '<div class="alert alert-success text-center">Data Added Successfully!</div>';
		$this->load->view('supercontrol/countryadd_view', $data);

		$this->load->view('supercontrol/footer');

	}
	//=======================Insert Page Data============



	//=======================Insertion Success message for News *** START HERE=========
	function success()
	{
		$data['h1title'] = 'Add Country';
		$data['title'] = 'Add Country';
		$this->load->view('supercontrol/header');
		$this->load->view('supercontrol/countryadd_view', $data);
		$this->load->view('supercontrol/footer');
	}
	//=======================Insertion Success message *** END HERE=========	
	//======================Show News List **** START HERE========================
	function show_country()
	{
		//Loading Database
		$this->load->database();
		//Calling Model
		$this->load->model('supercontrol/country_model');
		$query = $this->country_model->show_country();
		//========================================
		//****************************************
		//========================================
		$data['ecms'] = $query;
		$data['title'] = "Country List";
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/showcountrylist', $data);
		$this->load->view('supercontrol/footer');
	}
	//======================Show News List **** END HERE========================
//======================Status change **** START HERE========================
	function statusnews()
	{
		$stat = $this->input->get('stat');
		$id = $this->input->get('id');
		$this->load->model('news_model');
		$this->news_model->updt($stat, $id);
	}

	//=======================Status change **** END HERE========================	
//================Show Individual by Id for Category *** START HERE=================
	function show_category_id($id)
	{
		$id = $this->uri->segment(4);
		//exit();
		$data['title'] = "Edit Country";
		//Loading Database
		$this->load->database();
		//Calling Model
		$this->load->model('supercontrol/country_model');
		//Transfering data to Model
		$query = $this->country_model->show_country_id($id);
		$data['ecategory'] = $query;
		$this->load->view('supercontrol/header', $data);
		$this->load->view('supercontrol/country_edit', $data);
		$this->load->view('supercontrol/footer');
	}

	//================Show Individual by Id for Category *** END HERE=================
//================Update Individual Category***** START HERE ====================
	function edit_country()
	{
		$datalist = array(
			'country_name' => $this->input->post('country_name'),
			'sorting_order' => $this->input->post('sorting_order'),
		);
		$id = $this->input->post('id');
		$data['title'] = "Country Edit";
		//loading database
		$this->load->database();
		//Calling Model
		$this->load->model('supercontrol/country_model');
		//Transfering data to Model
		$query = $this->country_model->category_edit($id, $datalist);
		//echo $ddd=$this->db->last_query();
		//exit();
		$data1['message'] = 'Updated Successfully';
		$this->session->set_flashdata('success_edit', 'Data Updated Successfully !!!');
		redirect('supercontrol/country/show_country');
	}
	//================Update Individual  Category ***** END HERE====================
//=====================DELETE LOCATION====================
	function delete_country()
	{
		$id = $this->uri->segment(4);
		$this->load->database();
		//Transfering data to Model
		$this->load->model('supercontrol/country_model');
		$this->country_model->delete_country($id);
		$this->load->database();
		//Calling Model
		$this->load->model('supercontrol/country_model');
		//Transfering data to Model

		$this->session->set_flashdata('success', 'Data Deleted !!!!');
		redirect('supercontrol/country/show_country', TRUE);
	}
	//=====================DELETE LOCATION====================
	//====================MULTIPLE DELETE=================
	function delete_multiple()
	{
		$ids = (explode(',', $this->input->get_post('ids')));
		$this->news_model->delete_mul($ids);
		$this->load->view('header');
		redirect('news/show_news');
		$this->load->view('footer');
	}
	//====================MULTIPLE DELETE=================
//======================Logout==========================
	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('supercontrol/login');
	}
	//======================Logout==========================
}
?>