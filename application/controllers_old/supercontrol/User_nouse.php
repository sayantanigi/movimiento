<?php
class User extends CI_Controller {

		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('home', 'refresh');
			}
			//$this->load->model('testimonial_model');
			//$this->load->library('image_lib');
			
			
		//****************************backtrace prevent*** START HERE*************************
			$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
            $this->output->set_header('Pragma: no-cache');
			
		//****************************backtrace prevent*** END HERE*************************
			
			
		}	
	function index()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('supercontrol/settings_edit');
        }else{
        	$this->load->view('supercontrol/main/login');	
        }
	}

    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials()
	{	
        $this->load->model('Users_model');
        $user_name = $this->input->post('user_name');
	    $password = $this->input->post('password');

		$is_valid = $this->Users_model->validate($user_name, $password);
		
		if($is_valid)
		{
			$data = array(
				'user_name' => $user_name,
				'is_logged_in' => 1
			);
		$this->session->set_userdata($data);
		//$username = $this->session->userdata('UserName');
		
			redirect('user/dashboard');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('login', $data);	
		}
	}	
	
function dashboard(){
		
			//Loading Database
			//$this->load->database();
			//Calling Model
			//$this->load->model('Users_model');
			//Transfering data to Model
			//$query = $this->Users_model->show_member();
			//$data['emember'] = $query;
			$data['title'] = "Dashboard";
			$this->load->view('header',$data);
			$this->load->view('home_view');
			$this->load->view('footer');
		
	}
	//=============12-09-2016-Debjit======================
	
	//==============================supercontrol reset Password======================================
     function show_reset_pass(){
		
		
		$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/users_model');
			//Transfering data to Model
			$query = $this->users_model->show_pass();
			//$data['emember'] = $query;
			$data['pass'] = $query;
		
		
			$data['title'] = "Change password";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/resetpassword');
			$this->load->view('supercontrol/footer');
}
   function reset_pass(){
		//$id = $this->uri->segment(3);
		
			   $datalist = array(			
				'UserPassword' => md5($this->input->post('UserPassword'))
				);
		$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/users_model');
			//Transfering data to Model
			$query = $this->users_model->new_pass($datalist);
			//$data['emember'] = $query;
			$this->load->model('supercontrol/users_model');
			//Transfering data to Model
			$query = $this->users_model->show_pass();
			//$data['emember'] = $query;
			$data['pass'] = $query;
		    $this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/resetpassword');
			$this->load->view('supercontrol/footer');	
		   }
		   
 /*  function logout()
	{
		$this->session->sess_destroy();
		
		redirect('supercontrol/supercontrol');
	}*/
public function logout(){
		$this->session->sess_destroy();
		redirect('supercontrol/main/login');
	}
}