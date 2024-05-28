<?php
class Service extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			//$this->load->model('categorymodel', 'cat');
			$this->load->helper('form');
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/service_model','cat');
			$this->load->library('image_lib');
			/*function __construct() {
			parent::__construct();
			$this->load->model('categorymodel', 'cat');
			$this->load->helper('form');
			}*/

			//****************************backtrace prevent*** START HERE*************************
			$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
            $this->output->set_header('Pragma: no-cache');
			
			//****************************backtrace prevent*** END HERE*************************
		}
		//============Constructor to call Model====================
		function index()
	{
		if($this->session->userdata('is_logged_in')){
			$data['categories'] = $this->cat->category_menu();
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/serviceadd_view', $data);
			$this->load->view('supercontrol/footer');
			//redirect('serviceadd_view');
        }else{
        	$this->load->view('supercontrol/login');	
        }
		
		//$data['categories'] = $this->cat->category_menu();
			//$this->load->view('serviceadd_view', $data);
	}
//======================Show Add form for service add **** START HERE========================	
function service_add_form(){
				$data['title'] = "Add Services";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/serviceadd_view');
				$this->load->view('supercontrol/footer');
     }
		
//====================== Show Add form for service add ****END HERE========================
		//=======================Insert Page Data============
		function add_service(){
					$data = array(
					'category_name' => $this->input->post('name'),
					'parent_id' => $this->input->post('pid'),
					);
					//print_r($data); exit();
					$this->load->model('supercontrol/service_model');
					$this->service_model->insert_service($data);
					$this->load->view('supercontrol/header',$data);
					//$this->load->view('service/success',$data);
					$data['categories'] = $this->cat->category_menu();
					$data['success_msg'] = '<div class="alert alert-success text-center">Data Added Successfully!</div>';
					$this->load->view('supercontrol/serviceadd_view',$data);
					//redirect('service',$data);
					$this->load->view('supercontrol/footer');
			}
		//=======================Insert Page Data============
		
		

//=======================Insertion Success message for News *** START HERE=========
		function success(){
			$data['h1title'] = 'Add service';
			
			$data['title'] = 'Add service';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/serviceadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
//=======================Insertion Success message *** END HERE=========	
//======================Show News List **** START HERE========================
		function show_service(){
		//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/service_model');
			$query = $this->service_model->show_service();
			 //echo $ddd=$this->db->last_query();
			 //exit();
			//========================================
			//****************************************
			/*$data['categorieslisting'] = $this->cat->category_listing();*/
			//========================================
			$data['eserv'] = $query;
			$data['title'] = "service List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showservicelist',$data);
			$this->load->view('supercontrol/footer');
		
	}
//======================Show News List **** END HERE========================
//======================Status change **** START HERE========================
	function statusnews ()
		{
			     $stat= $this->input->get('stat'); 
				 $id= $this->input->get('id');   
		$this->load->model('news_model');
		$this->news_model->updt($stat,$id);
		}

//=======================Status change **** END HERE========================	
//================Show Individual by Id for service *** START HERE=================
		function show_service_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit service";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/service_model');
			//Transfering data to Model
			$query = $this->service_model->show_service_id($id);
			$data['eserv'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/service_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for service *** END HERE=================
//================Update Individual service***** START HERE ====================
		function edit_service(){
				$datalist = array(			
					'category_name' => $this->input->post('category_name'),
				);
				$id = $this->input->post('category_id');
				$data['title'] = "Service Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/service_model');
				//Transfering data to Model
				$query = $this->service_model->service_edit($id,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = 'Updated Successfully';
				$query = $this->service_model->show_servicelist();
				$data['eserv'] = $query;
				$data['title'] = "service Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showservicelist', $data1);
				$this->load->view('supercontrol/footer');
		}
//================Update Individual  service ***** END HERE====================

		//=====================DELETE service====================
			function delete_service() {
			$this->load->model('supercontrol/service_model');
			$id = $this->uri->segment(4);
			$result=$this->service_model->show_service_id($id);
			//Loading Database
			$this->load->database();
			if($query = $this->service_model->delete_service($id)){
				$data2['message'] = 'Deleted Successfully';
				$data['title'] = "service Page List";
				$data['eserv'] = $query;
				$data['title'] = "service Page List";
				$this->session->set_flashdata('success', 'Data Deleted !!!!');
				redirect('supercontrol/service/show_service',TRUE);
			}else{
       			$this->session->set_flashdata('success','You Can Not Delete A Parent Category');
				redirect('supercontrol/service/show_service',TRUE);
    		}
			
		}

		//=====================DELETE service====================

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