<?php
class Settings extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/settings_model');
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
			redirect('supercontrol/settings_edit');
        }else{
        	$this->load->view('supercontrol/main/login');	
        }
	}
	//================Show Individual by Id for BLOG *** START HERE=================
		function show_settings_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Social Link";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/settings_model');
			//Transfering data to Model
			$query = $this->settings_model->show_settings_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/settings_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for BLOG *** END HERE=================
//================Update Individual blog***** START HERE ====================
		function edit_settings(){
			
		   $datalist = array(			
				'map' => $this->input->post('map'),
				'address' => $this->input->post('address'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'facebook_link' => $this->input->post('facebook_link'),
				'twitter_link' => $this->input->post('twitter_link'),
				'youtube_link' => $this->input->post('youtube_link'),
				'googleplus_link' => $this->input->post('googleplus_link'),
				'per_hour_classroom' =>$this->input->post('per_hour_classroom'),
				'per_hour_flexibility' =>$this->input->post('per_hour_flexibility'),
				'per_hour_price'=> $this->input->post('per_hour_price')
				);
			   $id = $this->input->post('id');
				$data['title'] = "settings Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/settings_model');
				//Transfering data to Model
				$query = $this->settings_model->settings_edit($id,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = 'Data Update Successfully';
				$query = $this->settings_model->show_settingslist();
				$data['ecms'] = $query;
				$data['title'] = "supercontrol profile Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/settings_edit', $data1);
				$this->load->view('supercontrol/footer');
		  }
//================Update Individual  Blog ***** END HERE====================
//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('supercontrol/login');
    	}
//======================Logout==========================
}

?>

