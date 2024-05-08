<?php
class Faq extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/faq_model');
			$this->load->library('image_lib');
			
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
			redirect('supercontrol/faqadd_view');
        }else{
        	$this->load->view('supercontrol/login');	
        }
		
		
	}
//======================Show Add form for faq add **** START HERE========================	
function faq_add_form(){
				$data['title'] = "Add Faq";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/faqadd_view');
				$this->load->view('supercontrol/footer');
     }
		
//====================== Show Add form for faq add ****END HERE========================
		//=======================Insert Page Data============
		function add_faq(){
			$my_date = date("Y-m-d", time()); 
			$config = array(
			'upload_path' => "faq/",
			'upload_url' => base_url() . "faq/",
			'allowed_types' => "gif|jpg|png|jpeg"
			);
        	$this->load->library('upload', $config);
				//=====================+++++++++++++++++++++++===================
				$this->form_validation->set_rules('question','Question', 'required');
				$this->form_validation->set_rules('answer', 'Answer', 'required');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/faqadd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);
				}else{
						 $data = array(
							'question' => $this->input->post('question'),
							'answer' => $this->input->post('answer'),
							'faq_status' => 1
						);
						$this->faq_model->insert_faq($data);
						$query = $this->faq_model->show_faq();
						$data['ecms'] = $query;
						$this->session->set_flashdata('add_message', 'Faq Added Successfully !!!!');
						/*$this->load->view('supercontrol/header',$data);
						$this->load->view('supercontrol/showfaqlist',$data);
						$this->load->view('supercontrol/footer');*/
						$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/faq/show_faq');
			$this->load->view('supercontrol/footer');
				
					
				}
		}
		//=======================Insert Page Data============

//=======================Insertion Success message for Faq *** START HERE=========
		function success(){
			$data['h1title'] = 'Add Faq';
			
			$data['title'] = 'Add Faq';
			$this->session->set_flashdata('add_message', 'Faq Added Successfully !!!!');
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/faqadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
//=======================Insertion Success message *** END HERE=========	
//======================Show Faq List **** START HERE========================
		function show_faq(){
		//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/faq_model');
			//Transfering data to Model
			$query = $this->faq_model->show_faq();
			$data['ecms'] = $query;
			$data['title'] = "Faq List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showfaqlist');
			$this->load->view('supercontrol/footer');
		
	}
//======================Show Faq List **** END HERE========================
//======================Status change **** START HERE========================
	function statusfaq ()
		{
			     $stat= $this->input->get('stat'); 
				 $id= $this->input->get('id');   
		$this->load->model('supercontrol/faq_model');
		$this->faq_model->updt($stat,$id);
		}

//=======================Status change **** END HERE========================	
//================Show Individual by Id for Faq *** START HERE=================
		function show_faq_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Faq";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/faq_model');
			//Transfering data to Model
			$query = $this->faq_model->show_faq_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/faq_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for Faq *** END HERE=================
//================Update Individual faq***** START HERE ====================
		function edit_faq(){
				$datalist = array(			
					'question' => $this->input->post('question'),
				    'answer' => $this->input->post('answer')
				);
				$id = $this->input->post('faq_id');
				$data['title'] = "Faq Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/faq_model');
				//Transfering data to Model
				$query = $this->faq_model->faq_edit($id,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = 'Data Update Successfully';
				$query = $this->faq_model->show_faqlist();
				$data['ecms'] = $query;
				$this->session->set_flashdata('edit_message', 'Faq Updated Successfully !!!!');
				$data['title'] = "Faq Page List";
				/*$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showfaqlist', $data1);
				$this->load->view('supercontrol/footer');*/
				$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/faq/show_faq');
			$this->load->view('supercontrol/footer');
			
			
		}
//================Update Individual  Faq ***** END HERE====================

		//=====================DELETE NEWS====================

		
			function delete_faq() {
			$id = $this->uri->segment(4);
			$result=$this->faq_model->show_faq_id($id);
			//print_r($result);
			//echo $banner_img;exit();
			//Loading Database
			$this->load->database();

			//Transfering data to Model
			$query = $this->faq_model->delete_faq($id,$faq_image);
			$data['ecms'] = $query;
			$this->session->set_flashdata('delete_message1', 'Faq Deleted Successfully !!!!');
			$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/faq/show_faq');
			$this->load->view('supercontrol/footer');
		}

		//=====================DELETE NEWS====================

		//====================MULTIPLE DELETE=================
		function delete_multiple(){
		$ids = ( explode( ',', $this->input->get_post('ids') ));
		$this->faq_model->delete_mul($ids);
			$this->session->set_flashdata('delete_message', 'Faq Deleted Successfully !!!!');
		$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/faq/show_faq');
			$this->load->view('supercontrol/footer');
		}
		
		function faq_view($id){
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/faq_model');
			//Transfering data to Model
			$query = $this->faq_model->faq_view($id);
			$data['viewfaq'] = $query;
			//echo $sql = $this->db->last_query();
			//exit();
			$data['title'] = "Faq View";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/faq_view',$data);
			$this->load->view('supercontrol/footer');
			
		
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