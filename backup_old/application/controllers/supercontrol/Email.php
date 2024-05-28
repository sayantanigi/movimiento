<?php
class Email extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->model('email_model');
			//$this->load->library('image_lib');
		}
		//============Constructor to call Model====================
		function index(){
			if($this->session->userdata('is_logged_in')){ 
			$this->load->database();
			//Calling Model
			$this->load->model('email_model');
			//Transfering data to Model
			$query = $this->email_model->show_emaillist();
			$data['eemail'] = $query;
			$data['title'] = "Email List";
			$this->load->view('header',$data);
			$this->load->helper(array('form'));
			$this->load->view('showemaillist', $data);
			$this->load->view('footer');
			}else{
               redirect('login');

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
		
  		
		
		
		
		
		//================View Individual Data List=============
		//================Show Individual by Id=================
		function show_email_id($id) {
			$data['title'] = "Edit Email";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('email_model');
			//Transfering data to Model
			$query = $this->email_model->show_email_id($id);
			$data['eemail'] = $query;
			$this->load->view('header',$data);
			$this->load->view('email_edit', $data);
			$data['title'] = "Edit Email List";
			$this->load->view('footer');
		}
  		//================Show Individual by Id=================
		
   		//================Show Individual by Id=================
  	 	//================Update Individual ====================
		
		function edit_email(){
			//***************************
			//====================Post Data=====================
			$datalist = array(
							'status' => $this->input->post('status')
							
			);
			//====================Post Data===================
			
			$id=$this->input->post('id');
			$data['title'] = "Email Edit";
			//loading database
			$this->load->database();
			//Calling Model
			$this->load->model('email_model');
			//Transfering data to Model
			$query = $this->email_model->edit_email_individual($id,$datalist);
			$data1['message'] = 'Data Updated Successfully';
			redirect('email/successupdate');
			//****************************
			
			
		}
		//================Update Individual ====================
  		//=======================Update Success message=========
		function successupdate(){
			//loading database
			$this->load->database();
			//Calling Model
			$this->load->model('email_model');
			//Transfering data to Model
			$query = $this->email_model->show_emaillist();
			$data['eemail'] = $query;
			$data['title'] = "Email  List";
			$datamsg['h1title'] = 'Data Updated Successfully';
			$this->load->view('header',$data);
			$this->load->view('showemaillist',$datamsg);
			$this->load->view('footer');
		}
		//=======================Update Success message=========
		//=======================Delete Individual==============
		function delete_email($id){
			//Loading  Database
			$this->load->database();
			//Transfering data to Model
			$this->email_model->delete_email($id);
			$data1['message'] = 'Data deleted Successfully';
			redirect('email/successdelete');
		}
		//======================Delete Individual===============
		//======================Delete Success message==========
		function successdelete(){
			//Loading  Database
			$this->load->database();
			//Calling Model
			$this->load->model('cms_model');

			//Transfering data to Model
			$query = $this->email_model->show_emaillist();
			$data['eemail'] = $query;
			$data['title'] = "Email List";
			$this->load->view('header',$data);
			$this->load->helper(array('form'));
			$this->load->view('showemaillist', $data);
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

