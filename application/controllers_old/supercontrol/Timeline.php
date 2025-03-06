<?php
class Timeline extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/timeline_model');
			$this->load->library('image_lib');
			$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
            $this->output->set_header('Pragma: no-cache');
			
			//****************************backtrace prevent*** END HERE*************************
			
		}
		//============Constructor to call Model====================
		function index(){
			if($this->session->userdata('is_logged_in')){
				redirect('supercontrol/timelineadd_view');
			}else{
				$this->load->view('supercontrol/main/login');	
			}
		}
		
		
		//=======================Insert Page Data============
		function add_timeline(){
						 $data = array(
							'timeline_heading' => $this->input->post('timeline_heading'),
							'timeline_sub_heading' => $this->input->post('timeline_sub_heading'),
							'timeline_description' => $this->input->post('timeline_description'),
							'status' => 1
						);
						$this->timeline_model->insert_timeline($data);
						$query = $this->timeline_model->show_timeline();
						$data['ecms'] = $query;
            			$data['success_msg'] = '<div class="alert alert-success text-center">Event Successfully Added</div>';
						$this->load->view('supercontrol/header',$data);
						$this->load->view('supercontrol/showtimelinelist',$data);
						$this->load->view('supercontrol/footer');
				
		}
		//=======================Insert Page Data============
  		//=======================Insertion Success message=========
		function success(){
			$data['h1title'] = 'Data Inserted Successfully';
			$data['title'] = 'Add timeline';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/timelineadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
		//=======================Insertion Success message=========	
		
		
		//================Add timeline form=============
		function addtimeline(){
			
			$data['title'] = "timeline add";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/timelineadd_view');
			$this->load->view('supercontrol/footer');
		}
		//================View Individual Data List=============
		
		//================View Individual Data List=============
  		//================Show Individual by Id=================
		function show_timeline_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Timeline";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/timeline_model');
			//Transfering data to Model
			$query = $this->timeline_model->show_timeline_id($id);
			
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/timeline_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
		
		function statustimeline (){
		$stat= $this->input->get('stat'); 
		$id= $this->input->get('id');   
		$this->load->model('supercontrol/timeline_model');
		$this->timeline_model->updt($stat,$id);
		}
   		//================Show Individual by Id=================
  	 	//================Update Individual ====================
		function edit_timeline(){
				$datalist = array(			
				'timeline_heading' => $this->input->post('timeline_heading'),
				'timeline_sub_heading' => $this->input->post('timeline_sub_heading'),
				'timeline_description' => $this->input->post('description')
				);
			
				$id = $this->input->post('timeline_id');
				$data['title'] = "Timeline Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/timeline_model');
				//Transfering data to Model
				$query = $this->timeline_model->timeline_edit($id,$datalist);
				$data1['message'] = 'Data Update Successfully';
				$query = $this->timeline_model->show_timelinelist();
				$data['ecms'] = $query;
				$data['title'] = "Timeline Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showtimelinelist', $data1);
				$this->load->view('supercontrol/footer');
		}
		//================Update Individual ====================
  		//=======================Update Success message=========
		function successupdate(){
			//loading database
			$this->load->database();
			//Calling Model
			$this->load->model('cms_model');
			//Transfering data to Model
			$query = $this->cms_model->view_cms();
			$data['ecms'] = $query;
			$data['title'] = "Individual Data List";
			$datamsg['h1title'] = 'Data Updated Successfully';
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showcmslist',$datamsg);
			$this->load->view('supercontrol/footer');
		}
		//=======================Update Success message=========
		//=======================Delete Individual==============
		function delete_cms($id){
			//Loading  Database
			$this->load->database();
			//Transfering data to Model
			$this->cms_model->delete_cms($id);
			$data1['message'] = 'Data Deleted Successfully';
			redirect('individual/successdelete');
		}
		//======================Delete Individual===============
		
		//======================Show CMS========================
		function showtimeline(){
		
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/timeline_model');
			//Transfering data to Model
			$query = $this->timeline_model->show_timeline();
			$data['ecms'] = $query;
			$data['title'] = "timelineList";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showtimelinelist');
			$this->load->view('supercontrol/footer');
		
	}
		//======================Show CMS========================
		
		//=====================DELETE timeline====================

		
			function delete_timeline() {
			$id = $this->uri->segment(4);
			//Loading Database
			$this->load->database();

			//Transfering data to Model
			$query = $this->timeline_model->delete_timeline($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			//$this->load->view('showtimelinelist', $data);
			redirect('supercontrol/timeline/showtimeline');
			$this->load->view('supercontrol/footer');
		}

		//=====================DELETE timeline====================
		
		//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('supercontrol/login');
    	}
		//======================Logout==========================
}

?>

