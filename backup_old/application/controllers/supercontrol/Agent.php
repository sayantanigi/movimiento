<?php
class Agent extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/agent_model');
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
			redirect('supercontrol/agentadd_view');
        }else{
        	$this->load->view('supercontrol/login');	
        }
		
		
	}
//======================Show Add form for agent add **** START HERE========================	
function agent_add_form(){
				$data['title'] = "Add Agent";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/agentadd_view');
				$this->load->view('supercontrol/footer');
     }
		
//====================== Show Add form for agent add ****END HERE========================
		//=======================Insert Page Data============
		function add_agent(){
			$my_date = date("Y-m-d", time()); 
			$config = array(
			'upload_path' => "agent/",
			'upload_url' => base_url() . "agent/",
			'allowed_types' => "gif|jpg|png|jpeg"
			);
        	$this->load->library('upload', $config);
				//=====================+++++++++++++++++++++++===================
				$this->form_validation->set_rules('agent_title','Agent Title', 'required');
				$this->form_validation->set_rules('designation', 'Designation', 'required|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('agent_desc', 'Agent Description', 'required|min_length[1]|max_length[100000]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/agentadd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);
				}else{
					if (!$this->upload->do_upload('userfile')){
            			$data['success_msg'] = '<div class="alert alert-success text-center">You Must Select An Image File!</div>';
						$this->load->view('supercontrol/header');
            			$this->load->view('supercontrol/agentadd_view', $data);
						$this->load->view('supercontrol/footer');
        			}else{
						 $data['userfile'] = $this->upload->data();
						 $filename=$data['userfile']['file_name'];
						 $data = array(
							'agent_title' => $this->input->post('agent_title'),
							'designation' => $this->input->post('designation'),
							'agent_image' => $filename,
							'agent_desc' => $this->input->post('agent_desc'),
							'date' => $my_date,
							'agent_status' => 1
						);
						$this->agent_model->insert_agent($data);
            			$upload_data = $this->upload->data();
						$query = $this->agent_model->show_agent();
						$data['ecms'] = $query;
						$this->session->set_flashdata('add_message', 'Agent Added Successfully !!!!');
            			$data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>' . $upload_data['file_name'] . '</strong> was successfully uploaded!</div>';
						/*$this->load->view('supercontrol/header',$data);
						$this->load->view('supercontrol/showagentlist',$data);
						$this->load->view('supercontrol/footer');*/
						$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/agent/show_agent');
			$this->load->view('supercontrol/footer');
				
					}
				}
		}
		//=======================Insert Page Data============

//=======================Insertion Success message for Agent *** START HERE=========
		function success(){
			$data['h1title'] = 'Add Agent';
			
			$data['title'] = 'Add Agent';
			$this->session->set_flashdata('add_message', 'Agent Added Successfully !!!!');
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/agentadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
//=======================Insertion Success message *** END HERE=========	
//======================Show Agent List **** START HERE========================
		function show_agent(){
		//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/agent_model');
			//Transfering data to Model
			$query = $this->agent_model->show_agent();
			$data['ecms'] = $query;
			$data['title'] = "Agent List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showagentlist');
			$this->load->view('supercontrol/footer');
		
	}
//======================Show Agent List **** END HERE========================
//======================Status change **** START HERE========================
	function statusagent ()
		{
			     $stat= $this->input->get('stat'); 
				 $id= $this->input->get('id');   
		$this->load->model('supercontrol/agent_model');
		$this->agent_model->updt($stat,$id);
		}

//=======================Status change **** END HERE========================	
//================Show Individual by Id for Agent *** START HERE=================
		function show_agent_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Agent";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/agent_model');
			//Transfering data to Model
			$query = $this->agent_model->show_agent_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/agent_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for Agent *** END HERE=================
//================Update Individual agent***** START HERE ====================
		function edit_agent(){
			 $agent_image = $this->input->post('agent_image');
			 $config = array(
				'upload_path' => "agent/",
				'upload_url' => base_url() . "agent/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				@unlink("agent/".$agent_image);
				//echo $image_data = $this->upload->data();
				$data['img'] = $this->upload->data();
			 	//echo $data['img']['file_name'];
				//exit();
				//*********************************
				//============================================
				$datalist = array(			
				'agent_title' => $this->input->post('agent_title'),
				'designation' => $this->input->post('designation'),
				'agent_desc' => $this->input->post('agent_desc'),
				'agent_image' => $data['img']['file_name']
				);
				//echo $gallery_name=$_POST['gallery_name'];
				//====================Post Data===================
				//print_r($datalist);
				//exit();
				$id = $this->input->post('agent_id');
				$data['title'] = "Agent Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/agent_model');
				//Transfering data to Model
				$query = $this->agent_model->agent_edit($id,$datalist);
				// echo $ddd=$this->db->last_query();
				
				$data1['message'] = 'Data Update Successfully';
				$query = $this->agent_model->show_agentlist();
				$data['ecms'] = $query;
				$data['title'] = "Agent Page List";
				/*$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showagentlist', $data1);
				$this->load->view('supercontrol/footer');*/
				$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/agent/show_agent');
			$this->load->view('supercontrol/footer');
				//*********************************
		
			}else{
				$datalist = array(			
					'agent_title' => $this->input->post('agent_title'),
				    'designation' => $this->input->post('designation'),
				    'agent_desc' => $this->input->post('agent_desc')
				
				);
				$id = $this->input->post('agent_id');
				$data['title'] = "Agent Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/agent_model');
				//Transfering data to Model
				$query = $this->agent_model->agent_edit($id,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = 'Data Update Successfully';
				$query = $this->agent_model->show_agentlist();
				$data['ecms'] = $query;
				$this->session->set_flashdata('edit_message', 'Agent Updated Successfully !!!!');
				$data['title'] = "Agent Page List";
				/*$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showagentlist', $data1);
				$this->load->view('supercontrol/footer');*/
				$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/agent/show_agent');
			$this->load->view('supercontrol/footer');
			}
			
		}
//================Update Individual  Agent ***** END HERE====================

		//=====================DELETE NEWS====================

		
			function delete_agent() {
			$id = $this->uri->segment(4);
			$result=$this->agent_model->show_agent_id($id);
			//print_r($result);
			$agent_image = $result[0]->agent_image; 
			//echo $banner_img;exit();
			//Loading Database
			$this->load->database();

			//Transfering data to Model
			$query = $this->agent_model->delete_agent($id,$agent_image);
			$data['ecms'] = $query;
			$this->session->set_flashdata('delete_message', 'Agent Deleted Successfully !!!!');
			$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/agent/show_agent');
			$this->load->view('supercontrol/footer');
		}

		//=====================DELETE NEWS====================

		//====================MULTIPLE DELETE=================
		function delete_multiple(){
		$ids = ( explode( ',', $this->input->get_post('ids') ));
		$this->agent_model->delete_mul($ids);
		$this->session->set_flashdata('delete_message1', 'Agent Deleted Successfully !!!!');
		$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/agent/show_agent');
			$this->load->view('supercontrol/footer');
		}
		
		function agent_view($id){
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/agent_model');
			//Transfering data to Model
			$query = $this->agent_model->agent_view($id);
			$data['viewagent'] = $query;
			//echo $sql = $this->db->last_query();
			//exit();
			$data['title'] = "Agent View";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/agent_view',$data);
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