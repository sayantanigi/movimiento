<?php
class City extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			//$this->load->model('categorymodel', 'cat');
			$this->load->helper('form');
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/city_model');
			$this->load->model('generalmodel');
		

			//****************************backtrace prevent*** START HERE*************************
			$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
            $this->output->set_header('Pragma: no-cache');
			
			//****************************backtrace prevent*** END HERE*************************
			$this->load->library('image_lib');
			 
		}
		//============Constructor to call Model====================
		function index(){
		if($this->session->userdata('is_logged_in')){
		$data['categories'] = $this->city_model->getCategories();
	
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/cityadd_view', $data);
			$this->load->view('supercontrol/footer');
			//redirect('categoryadd_view');
        }else{
        	$this->load->view('supercontrol/login');	
        }
		
		//$data['categories'] = $this->cat->category_menu();
			//$this->load->view('categoryadd_view', $data);
	}
//======================Show Add form for category add **** START HERE========================	
function category_add_form(){
		$data['title'] = "Add Category";
		$this->load->view('supercontrol/header',$data);
		$this->load->view('supercontrol/categoryadd_view');
		$this->load->view('supercontrol/footer');
     }
		
//====================== Show Add form for category add ****END HERE========================
		//=======================Insert Page Data============
		function add_city(){
           $data['categories'] = $this->city_model->getCategories();
			$data = array(
			    'country_id' => $this->input->post('sel_country'),
			'city_name' => $this->input->post('city_name'),
			'userid'=> $this->session->userdata('userid')
			
			);
			//print_r($data); exit();
			$this->load->model('supercontrol/City_model');
			$this->city_model->insert_city($data);
			$this->load->view('supercontrol/header',$data);
			$data['success_msg'] = '<div class="alert alert-success text-center">Data Added Successfully!</div>';
				redirect('supercontrol/city/show_city');
			$this->load->view('supercontrol/cityadd_view',$data);
		
			$this->load->view('supercontrol/footer');
		
		}
		//=======================Insert Page Data============
		
		

		//=======================Insertion Success message for News *** START HERE=========
		function success(){
			$data['h1title'] = 'Add City';
			$data['title'] = 'Add City';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/cityadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
		//=======================Insertion Success message *** END HERE=========	
		//======================Show News List **** START HERE========================
		function show_city(){
		//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/city_model');
			$query = $this->city_model->show_city();
			$data['eloca']=$query;
			
			$data['title']="City List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showcitylist',$data);
			$this->load->view('supercontrol/footer');
	}
//======================Show News List **** END HERE========================
//======================Status change **** START HERE=======================
	function statusnews (){
		$stat= $this->input->get('stat'); 
		$id= $this->input->get('id');   
		$this->load->model('news_model');
		$this->news_model->updt($stat,$id);
	}
//=======================Status change **** END HERE========================	
//================Show Individual by Id for Category *START HERE=================
	function show_city_id($id) {
		$id = $this->uri->segment(4); 
		$data['title'] = "Edit City";
		$this->load->database();
		$this->load->model('supercontrol/city_model');
		$query = $this->city_model->show_city_id($id);
		$data['ecategory'] = $query;
	        $table_name = 'sm_countrys';
			$primary_key = 'country_status';
			$wheredata='1';
			$queryallcat = $this->generalmodel->getAllData($table_name,$primary_key,$wheredata,'','');
			$data['eallcat'] = $queryallcat;
	//	print_r($data['eallcat']);die;
		$this->load->view('supercontrol/header',$data);
		$this->load->view('supercontrol/city_edit', $data);
		$this->load->view('supercontrol/footer');
	}
//================Show Individual by Id for Category *** END HERE================
//================Update Individual Category***** START HERE ====================
	function edit_city(){
				
		
			$datalist = array(			
			'country_id' => $this->input->post('sel_country'),
			'city_name' => $this->input->post('city_name'),
			'sort_order'=> $this->input->post('sort_order')
			);
		
			$id = $this->input->post('id');
			$data['title'] = "City Edit";
		
			$this->load->database();
			
			$this->load->model('supercontrol/city_model');
		
			$query = $this->city_model->city_edit($id,$datalist);
			
			$data1['message'] = 'Updated Successfully';
			$this->session->set_flashdata('success_edit', 'Data Updated Successfully !!!');
			redirect('supercontrol/city/show_city');
	}
//================Update Individual  Category ***** END HERE====================

		//=====================DELETE LOCATION====================
	function delete_city() {

		   $id = $this->uri->segment(4); 
			$this->load->database();
			//Transfering data to Model
             $this->load->model('supercontrol/city_model');
			$this->city_model->delete_city($id);
             	$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/city_model');
			//Transfering data to Model
			$this->session->set_flashdata('success', 'Data Deleted !!!!');
			redirect('supercontrol/city/show_city',TRUE);

	
	}

		//=====================DELETE LOCATION====================

		//====================MULTIPLE DELETE=================
		function delete_multiple(){
		$ids = ( explode( ',', $this->input->get_post('ids') ));
		$this->news_model->delete_mul($ids);
		$this->load->view('header');
		redirect('news/show_news');
		$this->load->view('footer');
		}
		//====================MULTIPLE DELETE=================
//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('supercontrol/login');
    	}
//======================Logout==========================
}

?>