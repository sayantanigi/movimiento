<?php
class Announcement extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/generalmodel');
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
				redirect('supercontrol/announcementadd_view');
			}else{
				$this->load->view('supercontrol/main/login');	
			}
		}
		
		//================Add announcement form=============
		function addannouncementview(){
			$data['title'] = "Add Announcement";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/announcementadd_view');
			$this->load->view('supercontrol/footer');
		}
		//================View Individual Data List=============
		
		
		//=======================Insert Page Data============
		function add_announcement(){
				$this->form_validation->set_rules('announcement_title','Title', 'required');
				$this->form_validation->set_rules('description', 'Description', 'required|min_length[1]|max_length[10000]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/announcementadd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('announcement/addannouncement',$data);
				}else{
					 $data = array(
							'announcement_title' => $this->input->post('sm_announcement_title'),
							'description' => $this->input->post('description'),
							'add_date' => date('Y-m-d H:i:s'),
							'status' => '1'
						);
						
						$this->generalmodel->show_data_id('sm_announsement','','','insert',$data);
						$this->session->set_flashdata('success', 'Data inserted successfully');
            			redirect('supercontrol/announcement/showannouncement','refresh');
				}
		
		}
		
		//======================View announcement====================
		function showannouncement(){
			$query=$this->generalmodel->show_data_id('sm_announsement','','','get','');
			$data['ecms'] = $query;
			$data['title'] = "Announcement";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showannouncementlist');
			$this->load->view('supercontrol/footer');
		}
		//======================View announcement====================
		
		//================View Individual Data List=============
		
		
  		//================Show Individual by Id=================
		function show_announcement_id($id) {
			$id = $this->uri->segment(4); 
			$data['title'] = "Edit Announcement";
			$query=$this->generalmodel->show_data_id('sm_announsement',$id,'id','get','');
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/announcement_edit', $data);
			$this->load->view('supercontrol/footer');
		
		}
		
		
		
  	 	//================Update Individual ====================
		function edit_announcement(){
				$datalist = array(			
					'announcement_title' => $this->input->post('announcement_title'),
					'description' => $this->input->post('description'),
					'status' => $this->input->post('status')
				);
			
				//====================Post Data===================
				$id = $this->input->post('id');
			
				$this->generalmodel->show_data_id('sm_announsement',$id,'id','update',$datalist);
				$this->session->set_flashdata('success', 'Data Updated Successfully');
				redirect('supercontrol/announcement/showannouncement','refresh');
	
		
		}
		//================Update Individual ====================
  		
		//=======================Delete Individual==============
		function delete_announcement($id){
			$id = $this->uri->segment(4); 
			$this->generalmodel->show_data_id('sm_announsement',$id,'id','delete','');
			$this->session->set_flashdata('success', 'Data deleted Successfully');
			redirect('supercontrol/announcement/showannouncement','refresh');
		}
		//======================Delete Individual===============
			
		//====================MULTIPLE DELETE=================
		function delete_multiple(){
		$ids = (explode( ',', $this->input->get_post('ids') ));
		$this->generalmodel->delete_mul_an($ids);
		$this->load->view('supercontrol/header');
		redirect('supercontrol/announcement/showannouncement');
		$this->load->view('supercontrol/footer');
		}
		//====================MULTIPLE DELETE=================
		//=====================DELETE announcement====================
		
		//======================Logout==========================
		public function Logout(){
        	$this->session->sess_destroy();
        	redirect('supercontrol/login');
    	}
		//======================Logout==========================
}

?>

