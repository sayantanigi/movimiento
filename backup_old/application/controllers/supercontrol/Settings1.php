<?php
class Settings extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->model('settings_model');
		}
		//============Constructor to call Model====================
		function index(){
			if($this->session->userdata('is_logged_in')){ 
			$data['title'] = "Settings";
			$this->load->view('header',$data);
			$this->load->helper(array('form'));
			$this->load->view('showsettings');
			$this->load->view('footer');
			}else{
               redirect('main');
            }
		}
		
		public function is_logged_in(){
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        //header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        $is_logged_in = $this->session->userdata('logged_in');
        
        if(!isset($is_logged_in) || $is_logged_in!==TRUE){
            redirect('login');
        }
    }
		
		//================View Settings Data List=============
		function view_settings(){
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('settings_model');
			//Transfering data to Model
			$query = $this->settings_model->view_settings();
			$data['ecms'] = $query;
			$data['title'] = "Settings Data List";
			$this->load->view('header',$data);
			$this->load->view('showsettings');
			$this->load->view('footer');
		}
  		
		
  		//================Show Individual by Id=================
		function show_settings_id($id) {
			$data['title'] = "Settings Edit";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('settings_model');
			//Transfering data to Model
			$query = $this->settings_model->show_settings_id($id);
			$data['ecms'] = $query;
			$this->load->view('header',$data);
			$this->load->view('settingsedit', $data);
			$data['title'] = "Edit Data List";
			$this->load->view('footer');
		}
   		//================Show Individual by Id=================
  	 	//================Update Individual ====================
		function edit_settings(){
			//====================Post Data=====================
			$datalist = array(
							'title' => $this->input->post('title'),
							'phonenumber' => $this->input->post('phonenumber'),
							'email' => $this->input->post('email'),
							'fb_link' => $this->input->post('fb_link'),
							'twitter_link' => $this->input->post('twitter_link'),
							'gplus_link' => $this->input->post('gplus_link'),
							'v_link' => $this->input->post('v_link'),
							'address' => $this->input->post('address'),
							'map' => mysql_real_escape_string(stripcslashes($this->input->post('map')))
							
			);
			//====================Post Data===================
			
			$id=$this->input->post('id');
			$data['title'] = "Settings Edit";
			//loading database
			$this->load->database();
			//Calling Model
			$this->load->model('settings_model');
			//Transfering data to Model
			$query = $this->settings_model->edit_settings($id,$datalist);
			$data1['message'] = 'Data Inserted Successfully';
			redirect('settings/successupdate');
		}
		//================Update Individual ====================
  		//=======================Update Success message=========
		function successupdate(){
			//loading database
			$this->load->database();
			//Calling Model
			$this->load->model('settings_model');
			//Transfering data to Model
			$query = $this->settings_model->view_settings();
			$data['ecms'] = $query;
			$data['title'] = "Individual Data List";
			$datamsg['h1title'] = 'Data Updated Successfully';
			$this->load->view('header',$data);
			$this->load->view('showsettings',$datamsg);
			$this->load->view('footer');
		}
		//=======================Update Success message=========
		//=======================Delete Individual==============
		function delete_social($id){
			//Loading  Database
			$this->load->database();
			//Transfering data to Model
			$this->social_model->delete_social($id);
			$data1['message'] = 'Data Inserted Successfully';
			redirect('social/successdelete');
		}
		//======================Delete Individual===============
		//======================Delete Success message==========
		function successdelete(){
			//Loading  Database
			$this->load->database();
			//Calling Model
			$this->load->model('social_model');
			//Transfering data to Model
			$query = $this->social_model->view_social();
			$data['ecms'] = $query;
			$data['title'] = "Individual Data List";
			$datamsg['h1title'] = 'Data Updated Successfully';
			$this->load->view('header',$data);
			$this->load->view('showsocial');
			$this->load->view('footer');
		}
  		//======================Delete Success message==========
		//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('login');
    	}
		//======================Logout==========================
}

?>

