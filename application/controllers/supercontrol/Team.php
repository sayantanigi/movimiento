<?php
class Team extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/team_model');
			$this->load->database();
			$this->load->library('image_lib');
				//****************************backtrace prevent*** START HERE*************************
			$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
            $this->output->set_header('Pragma: no-cache');
			
			
			//****************************backtrace prevent*** END HERE*************************
		}
		//============Constructor to call Model====================
		function index(){
		if($this->session->userdata('is_logged_in')){
			redirect('supercontrol/team/add_team');
        }else{
        	$this->load->view('supercontrol/main/login');	
        }
	}
	//*********===============team Section===============********//
		function addteamview(){
			$data['title'] = "Add Team";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/teamadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
		//====================Insert Page Data===============
		//====================Add team Type=================
		function add_team(){
			$config = array(
				'upload_path' => "uploads/team/",
				'upload_url' => base_url() . "uploads/team/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			
			//load upload class library
        	$this->load->library('upload', $config);
				//=====================+++++++++++++++++++++++===================
				$this->form_validation->set_rules('mem_name','Member Name', 'required');
				$this->form_validation->set_rules('mem_desig', 'Member Designation', 'required|min_length[1]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/teamadd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);
				}else{
					if (!$this->upload->do_upload('userfile')){
            			$data['success_msg'] = '<div class="alert alert-success text-center">You Must Select An Image File!</div>';
						$this->load->view('supercontrol/header');
            			$this->load->view('supercontrol/teamadd_view', $data);
						$this->load->view('supercontrol/footer');
        			}else{
						 $data['userfile'] = $this->upload->data();
						 $filename=$data['userfile']['file_name'];
						 $data = array(
							'mem_name' => $this->input->post('mem_name'),
							'mem_description' => $this->input->post('mem_description'),
							'mem_desig' => $this->input->post('mem_desig'),
							'mem_phone' => $this->input->post('mem_phone'),
							'mem_email' => $this->input->post('mem_email'),
							'mem_fblink' => $this->input->post('mem_fblink'),
							'mem_twlink' => $this->input->post('mem_twlink'),
							'mem_lilink' => $this->input->post('mem_lilink'),
							'mem_instalink' => $this->input->post('mem_instalink'),
							'mem_gpluslink' => $this->input->post('mem_gpluslink'),
							'add_date' => date('Y-m-d H:i:s'),
							'mem_image' => $filename,
							'status' => 1
						);
						$this->team_model->insert_team($data);
            			$upload_data = $this->upload->data();
						$this->session->set_flashdata('success_add', 'Team Member  Added Successfully !!!!');
						redirect('supercontrol/team/showteam');
				
					}
				}
		}
		//====================Add team Type=================
		//==================Show team Type==================
		function showteam(){
			$data['title'] = "Team Member List";
			$query = $this->team_model->show_team();
			$data['team'] = $query;
			$data['title'] = "Team Member List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/teamlist',$data);
			$this->load->view('supercontrol/footer');
		}
		//==================Show team Type==================
		//==================Edit category====================
		function edit_team(){
		//============================================
		 $member_image = $this->input->post('member_image');
			$config = array(
				'upload_path' => "uploads/team/",
				'upload_url' => base_url() . "uploads/team/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				//echo $path = base_url(). "banner/";exit();
				//echo $path1 = "banner/"; 
				@unlink("uploads/team/".$member_image);
				
				//echo $image_data = $this->upload->data();
				$data['img'] = $this->upload->data();
				//*********************************
				//============================================
				$datalist = array(			
				//**********************************************
				'mem_name' => $this->input->post('mem_name'),
				'mem_description' => $this->input->post('mem_description'),
				'mem_desig' => $this->input->post('mem_desig'),
				'mem_fblink' => $this->input->post('mem_fblink'),
				'mem_phone' => $this->input->post('mem_phone'),
				'mem_email' => $this->input->post('mem_email'),
				'mem_twlink' => $this->input->post('mem_twlink'),
				'mem_lilink' => $this->input->post('mem_lilink'),
				'mem_instalink' => $this->input->post('mem_instalink'),
				'mem_gpluslink' => $this->input->post('mem_gpluslink'),
				'mem_image' => $data['img']['file_name'],
				'status' => $this->input->post('status')
				//**********************************************
				);
				//print_r($datalist); exit();
				 $member_image = $this->input->post('member_image');
				//====================Post Data===================
				
				$id = $this->input->post('member_id');
				$data['title'] = "Edit Team Member";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/team_model');
				//Transfering data to Model
				$query = $this->team_model->team_edit($id,$datalist);
				$data1['message'] = 'Data Update Successfully';
				$query = $this->team_model->show_team();
				$data['eteam'] = $query;
				$data['title'] = "Team Member List";
				$this->session->set_flashdata('success_update', 'Team Updated Successfully !!!!');
				redirect('supercontrol/team/showteam',TRUE);
				/*$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showteamlist', $data1);
				$this->load->view('supercontrol/footer');*/
				//*********************************
		
			}else{
				$datalist = array(			
				//**********************************************
				'mem_name' => $this->input->post('mem_name'),
				'mem_description' => $this->input->post('mem_description'),
				'mem_desig' => $this->input->post('mem_desig'),
				'mem_fblink' => $this->input->post('mem_fblink'),
				'mem_phone' => $this->input->post('mem_phone'),
				'mem_email' => $this->input->post('mem_email'),
				'mem_twlink' => $this->input->post('mem_twlink'),
				'mem_lilink' => $this->input->post('mem_lilink'),
				'mem_instalink' => $this->input->post('mem_instalink'),
				'mem_gpluslink' => $this->input->post('mem_gpluslink'),
				'status' => $this->input->post('status')
				//**********************************************
				);
				//print_r($datalist);
				//exit();
				//====================Post Data===================
				$member_image = $this->input->post('member_image');
				$id = $this->input->post('member_id');
				$data['title'] = "Team Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/team_model');
				//Transfering data to Model
				$query = $this->team_model->team_edit($id,$datalist);
				$data1['message'] = 'Data Update Successfully';
				$query = $this->team_model->show_team();
				$data['eteam'] = $query;
				$data['title'] = "Team Page List";
				$this->session->set_flashdata('success_update', 'team Updated Successfully !!!!');
				redirect('supercontrol/team/showteam',TRUE);
			}
			
		}
		
		//================Show Category By Id================
		function show_team_id($id) {
			$id = $this->uri->segment(4); 
			$data['title'] = "Edit Team Member";
			
			$query = $this->team_model->show_team_id($id);
			$data['eteam'] = $query;
			
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/team_edit', $data);
			$this->load->view('supercontrol/footer');
		}
   		//================Show Category By Id================
		//================Delete Category====================	
		function delete_team($id){
			$id = $this->uri->segment(4);
			$result=$this->team_model->delete_team($id); 
			$this->session->set_flashdata('success_delete','team Deleted Successfully !!!!');
			redirect('supercontrol/team/showteam');
		}
	//*********===============team Section===============********//
	
	//======================Logout==========================
	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('supercontrol/home', 'refresh');
	}
		//======================Logout==========================
}

?>
