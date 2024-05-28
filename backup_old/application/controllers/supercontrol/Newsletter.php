<?php
class Newsletter extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->model('supercontrol/newsletter_model');
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
			redirect('supercontrol/newsletter/show_newsletter');
        }else{
        	$this->load->view('supercontrol/login');	
        }
	}
//======================Show Blog List **** START HERE========================
		function show_newsletter(){
		
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/newsletter_model');
			
			$query1 = $this->newsletter_model->show_supercontrol_mail();
			$data['supercontrol'] = $query1;
			$query = $this->newsletter_model->show_newsletter();
					
			$data['ecms'] = $query;
			$data['title'] = "Newsletter List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/shownewsletterlist',$data);
			$this->load->view('supercontrol/footer');
		
	}
//======================Show Blog List **** END HERE========================
//================Show Individual by Id for BLOG *** START HERE=================
		function show_newsletter_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "View Newsletter ";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/newsletter_model');
			//Transfering data to Model
			$query = $this->newsletter_model->show_newsletter_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/newsletter_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for BLOG *** END HERE=================

	function delete_row()
{ //Loading  Database
           $id = $this->uri->segment(4); 
			//echo $id; exit();
			$this->load->database();
            //Transfering data to Model
             $this->load->model('supercontrol/newsletter_model');
			 $this->newsletter_model->delete_newsletter($id);
             	$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/newsletter_model');
			//Transfering data to Model
			$query = $this->newsletter_model->show_newsletter();
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header');
            $this->load->view('supercontrol/shownewsletterlist',$data);
            $this->load->view('supercontrol/footer');
}

           function send_newsletter(){
				
				 $date1 = date('d-m-Y g:i:s a');  
				 
				 $this->form_validation->set_rules('mail_address','Mail Address','required');
				 $this->form_validation->set_rules('reply_subject','Reply Subject','required'); 
				 $this->form_validation->set_rules('reply_message','Reply Message','required');
			
				 			
			           if($this->form_validation->run()==FALSE){
                           $this->session->set_flashdata('success', 'Please Fill up all Field ');
			               redirect('supercontrol/newsletter/show_newsletter');
                       }
           else{
		 	    
                	$data = array(
					 'reply_subject' => $this->input->post('reply_subject'),
					 'reply_message' => $this->input->post('reply_message'),
					 'reply_status' => 'Yes',
					 'reply_date' =>$date1
			    	);	
				//print_r($data);
				//exit();		
				//$id=$this->input->post('ContactId');
				//$this->load->model('contact_model');
				$mail_id=$this->input->post('mail_id');
				$this->newsletter_model->insert_reply($mail_id,$data);
				//echo $this->db->last_query(); exit();
				
		
			    $from_email = $this->input->post('supercontrol_mail');
				$to_email = $this->input->post('mail_address');
				
			  $data1 = array(
						 'reply_subject' => $this->input->post('reply_subject'),
					     'reply_message' => $this->input->post('reply_message'),
					      'reply_date' =>$date1
				   );
			$msg = $this->load->view('supercontrol/mailtemplate3',$data1,TRUE);
		    $config['mailtype'] = 'html';
		    $this->load->library('email');
		    $this->email->initialize($config);
		    $msg = $msg;
		    $subject = 'Reply Message From AITrader';   
            $this->email->from($this->input->post('supercontrol_mail'), 'AITrader supercontrolistrator'); 
		    $this->email->to($to_email);
            $this->email->bcc($from_email);
            $this->email->subject($subject); 
            $this->email->message($msg);
			   
            if($this->email->send()){
                $query = $this->newsletter_model->show_newsletter();
				$this->session->set_flashdata('success', 'Message Sent successfully!!!!');
			    redirect('supercontrol/newsletter/show_newsletter');
		        }
          else{          
		         $query = $this->newsletter_model->show_newsletter();
				 $this->session->set_flashdata('success', 'Meassage can not sent!!!!');
			     redirect('supercontrol/newsletter/show_newsletter');
	          }
	     }
			}	
	

//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('login');
    	}
//======================Logout==========================
}
?>