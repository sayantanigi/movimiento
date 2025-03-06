<?php
class Coursequery extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/coursequery_model');
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
			redirect('supercontrol/show_coursequery');
        }else{
        	$this->load->view('supercontrol/login');	
        }
	}

//======================Show Blog List **** START HERE========================
		function show_coursequery(){
		
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/coursequery_model');
			$query = $this->coursequery_model->show_coursequery();
			$query1 = $this->coursequery_model->adminmail();
			$data['supercontrolmail'] = $query1;
			//Transfering data to Model
			$query = $this->coursequery_model->show_coursequery();
			$data['ecms'] = $query;
			$data['title'] = "Contact List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showcoursequerylist');
			$this->load->view('supercontrol/footer');
		
	}
//======================Show Blog List **** END HERE========================
//================Show Individual by Id for BLOG *** START HERE=================
		function show_coursequery_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "View Contact";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/coursequery_model');
			//Transfering data to Model
			$query = $this->coursequery_model->show_coursequery_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/coursequery_view', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for BLOG *** END HERE=================

	function delete_row()
{

  //Loading  Database
           $id = $this->uri->segment(4); 

			$this->load->database();

			//Transfering data to Model
             $this->load->model('supercontrol/coursequery_model');
			$this->coursequery_model->delete_coursequery($id);
             	$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/coursequery_model');
			//Transfering data to Model
			$query = $this->coursequery_model->show_coursequery();
			$data['ecms'] = $query;
			$this->session->set_flashdata('delete_message', 'Course Query Deleted Successfully !!!!');
			redirect('supercontrol/coursequery/show_coursequery',TRUE);
			
}

//================FOR MAIL BACK==================
function send_coursequery(){
					$from_email = $this->input->post('supercontrolmail');
					$to_email = $this->input->post('Email');
					$msg = $this->input->post('reply_message');
					$subject = $this->input->post('reply_subject'); 
					 
					$message="<table width='790px' border='0' cellspacing='2' cellpadding='2' style='font-family:Arial; font-size:15px; color:#000000; border:1px solid #47b9d4'>
					<tr>
					<td colspan='3'><img src='http://site.goigi.me/Oesacademy/img/logo.png' border='0' width='200px'></td>
					</tr>
					<tr>
					<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
					<td colspan='3'><strong>Reply Details  : </strong></td>
					</tr>
					<tr>
					<td colspan='2'>&nbsp;</td>
					<td width='611'>&nbsp;</td>
					</tr>
					<tr>
					<td>Subject</td>
					<td>*</td>
					<td>$subject</td>
					</tr>
					<tr>
					<td>Message</td>
					<td>*</td>
					<td>$msg </td>
					</tr>
					
					<tr>
					<td colspan='3'>&nbsp;</td>
					</tr>
					<tr>
					<td colspan='3'>Oesacademy</td>
					</tr>
					</table>
					";
			
					$headers  = "MIME-Version: 1.0\r\n";			
					$headers = "From: $from_email \n";
					$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
					mail($to_email, $subject, $message, $headers);
					$this->session->set_flashdata('email_message', 'Mail Send Successfully !!!');
					redirect( "supercontrol/coursequery/show_coursequery");

				}
//================FOR MAIL BACK==================

//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('supercontrol/login');
    	}
//======================Logout==========================
}

?>
