<?php
class Users extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/userst_model');
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
			redirect('supercontrol/usersadd_view');
        }else{
        	$this->load->view('supercontrol/login');	
        }
		
		
	}
//======================Show Add form for users add **** START HERE========================	
function users_add_form(){
				$query = $this->userst_model->show_countries();
				$data['cntry'] = $query;
				$data['title'] = "Add Users";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/usersadd_view');
				$this->load->view('supercontrol/footer');
     }
		
//====================== Show Add form for users add ****END HERE========================
		//=======================Insert Page Data============
		function add_users(){
			$reg_date = date('Y-m-d H:i a');
			$reg_no = mt_rand(100000000, 999999999);
			$ip_address = $this->input->ip_address();
			$config = array(
			'upload_path' => "uploads/propic",
			'upload_url' => base_url() . "uploads/propic",
			'allowed_types' => "gif|jpg|png|jpeg"
			);
			//echo 'working';exit();
        	$this->load->library('upload', $config);
				//=====================+++++++++++++++++++++++===================
				$this->form_validation->set_rules('first_name','First Name', 'trim|required');
				$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user_registration.email]');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
				$this->form_validation->set_rules('conpassword', 'Confirm Password', 'trim|required|min_length[8]|matches[password]');
				$this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[12]');
				$this->form_validation->set_rules('time_zone', 'Time Zone', 'required');
				$this->form_validation->set_rules('country', 'Country', 'required');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					//echo "aa"; exit();
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/usersadd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);
				}else{
					if (!$this->upload->do_upload('userfile')){
						//cho "aassss"; exit();
            			$data['success_msg'] = '<div class="alert alert-success text-center">You Must Select An Image File!</div>';
						$this->load->view('supercontrol/header');
            			$this->load->view('supercontrol/usersadd_view', $data);
						$this->load->view('supercontrol/footer');
        			}else{
						
						if($this->input->post('user_type_main')==1){
							$data['userfile'] = $this->upload->data();
						 	$filename=$data['userfile']['file_name'];
							//====ARRAY FOR NORMAL USER=======
							$data = array(
									'reg_no' => $reg_no,
									'ip_address' => $ip_address,
									'image' => $filename,	  
									'first_name' => $this->input->post('first_name'),
									'last_name' => $this->input->post('last_name'),
									'email' => $this->input->post('email'),
									'password' => base64_encode($this->input->post('password')),
									'phone' => $this->input->post('phone'),
									'time_zone' => $this->input->post('time_zone'),
									'country' => $this->input->post('country'),
									'user_type_main' => $this->input->post('user_type_main'),
									'user_type_sub' => $this->input->post('user_type_sub'),
									'home_phone' => $this->input->post('home_phone'),
									'phone_pref' => $this->input->post('phone_pref'),
									'business_name' => $this->input->post('business_name'),
									'billing_email' => $this->input->post('billing_email'),
									'default_message' => $this->input->post('default_message'),
									'user_status' => 1,
									'emailverification' => 1,
									'reg_date' => $reg_date
							);
							//print_r($data);exit();
							$this->userst_model->insert_users($data);
							$upload_data = $this->upload->data();
							
							} else {
							//==========FOR exco user================
							$data['userfile'] = $this->upload->data();
						 	$filename=$data['userfile']['file_name'];
							//====ARRAY FOR NORMAL USER=======
							$data = array(
									'reg_no' => $reg_no,
									'ip_address' => $ip_address,	  
									'image' => $filename,	  
									'first_name' => $this->input->post('first_name'),
									'last_name' => $this->input->post('last_name'),
									'email' => $this->input->post('email'),
									'password' => base64_encode($this->input->post('password')),
									'phone' => $this->input->post('phone'),
									'time_zone' => $this->input->post('time_zone'),
									'country' => $this->input->post('country'),
									'user_type_main' => $this->input->post('user_type_main'),
									'address' => $this->input->post('address'),
									'abn_acn_num' => $this->input->post('abn_acn_num'),
									'vehicle' => $this->input->post('vehicle'),
									'contact_preference' => $this->input->post('contact_preference'),
									'device' => $this->input->post('device'),
									'gst_status' => $this->input->post('gst_status'),
									'user_status' => 1,
									'emailverification' => 1,
									'reg_date' => $reg_date
							);
							//print_r($data);exit();
							$this->userst_model->insert_users($data);
							$upload_data = $this->upload->data();
				
							}
							//======MAIL SEND AFTER REGISTRATION======
							$from_email = "info@excodelivery.com";
							$to_email = $this->input->post('email');
							$msgg = 'This is your login credentials for Excodelivery';
							$subject = 'Registration Success Message From Excodedelivery.';
							$data1 = array(
										'name' => $this->input->post('first_name').$this->input->post('last_name'),
										'email' => $this->input->post('email'),
										'phone' => $this->input->post('phone'),
										'password' => $this->input->post('password'),
										'subject' => $subject,
										'msgg' => $msgg,
										'reg_date'=> date('Y-m-d H:i:s')
											);
							//print_r($data1); exit();
							$msg = $this->load->view('supercontrol/mailtemplate',$data1,TRUE);
							$config['mailtype'] = 'html';
							$this->load->library('email');
							$this->email->initialize($config);
							
							$this->email->from($from_email, 'Excodelivery Administrator'); 
							$this->email->to($to_email);
							$this->email->subject($subject); 
							$this->email->message($msg);
							
							if($this->email->send()){
							$this->session->set_flashdata("success", "<b style='color:green;'> User added successfully !!! Also Mail send successful!</b>");
							redirect('supercontrol/users/show_users');
							}
							else{          
							$this->session->set_flashdata("success", "<b style='color:blue;'> User added successfully !!!</b>");
							redirect('supercontrol/users/show_users');
							}
							//======MAIL SEND AFTER REGISTRATION======
					}
				}
		}
		//=======================Insert Page Data============

//=======================Insertion Success message for users *** START HERE=========
		function success(){
			$data['h1title'] = 'Add Users';
			
			$data['title'] = 'Add users';
			$this->session->set_flashdata('add_message', 'users Added Successfully !!!!');
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/usersadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
//=======================Insertion Success message *** END HERE=========	
//======================Show users List **** START HERE========================
		function show_users(){
		//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/userst_model');
			//Transfering data to Model
			$query = $this->userst_model->show_users();
			$data['euser'] = $query;
			$data['title'] = "Users List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showuserslist',$data);
			$this->load->view('supercontrol/footer',$data);
		
	}
//======================Show users List **** END HERE========================
//======================Status change **** START HERE========================
	function statususers ()
		{
			     $stat= $this->input->get('stat'); 
				 $id= $this->input->get('id');   
		$this->load->model('supercontrol/userst_model');
		$this->userst_model->updt($stat,$id);
		}

//=======================Status change **** END HERE========================	
//================Show Individual by Id for users *** START HERE=================
		function show_users_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$query = $this->userst_model->show_countries();
			$data['cntry'] = $query;
			$data['title'] = "Edit users";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/userst_model');
			//Transfering data to Model
			$query = $this->userst_model->show_users_id($id);
			$data['eusr'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/users_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for users *** END HERE=================


//===============ADD IDENTITY PROOF==================

		function add_idproof_id($id){
			$id = $this->uri->segment(4);
			$data['title'] = "Add Identity Users";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/identityaddview', $data);
			$this->load->view('supercontrol/footer');
			}	
		function add_idproof(){
			$id = $this->input->post('userid');
			$config = array(
				'upload_path' => "uploads/idproof/",
				'upload_url' => base_url() . "uploads/idproof/",
				'allowed_types' => "doc|docx|pdf|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				$data['userfile'] = $this->upload->data();
				$filename=$data['userfile']['file_name'];
				$datalist = array(			
							'id_proof' => $filename,
				);
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/userst_model');
				//Transfering data to Model
				$query = $this->userst_model->addidentityproof($id,$datalist);
				$query = $this->userst_model->show_users();
				$data['euser'] = $query;
				$data['title'] = "User List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showuserslist', $data);
				$this->load->view('supercontrol/footer');
				}
			}
		function edit_idproof_id($id){
			$id = $this->uri->segment(4);
			$query = $this->userst_model->show_idproof($id);
			$data['attach'] = $query;
			
			$data['title'] = "Add Identity Users";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/identityeditview', $data);
			$this->load->view('supercontrol/footer');
			}
		function edit_idproof(){
			$filename = $this->input->post('attachment');
			$id = $this->input->post('userid');
			$config = array(
				'upload_path' => "uploads/idproof/",
				'upload_url' => base_url() . "uploads/idproof/",
				'allowed_types' => "doc|docx|pdf|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				@unlink("uploads/idproof/".$filename);
				$data['userfile'] = $this->upload->data();
				$filename=$data['userfile']['file_name'];
				$datalist = array(			
							'id_proof' => $filename,
				);
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/userst_model');
				//Transfering data to Model
				$query = $this->userst_model->addidentityproof($id,$datalist);
				$query = $this->userst_model->show_users();
				$data['euser'] = $query;
				$data['title'] = "User List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showuserslist', $data);
				$this->load->view('supercontrol/footer');
				}
			
			}	
//===============ADD IDENTITY PROOF==================


//================Update Individual users***** START HERE ====================
		function edit_users(){
			 $ip_address = $this->input->ip_address();
			 $imagename = $this->input->post('profileimage');
			 $usrtype = $this->input->post('user_type_main');
			 $config = array(
				'upload_path' => "uploads/propic/",
				'upload_url' => base_url() . "uploads/propic/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if($usrtype==1){
			if ($this->upload->do_upload("userfile")) {
				@unlink("uploads/propic/".$imagename);
				
				$data['userfile'] = $this->upload->data();
				$filename=$data['userfile']['file_name'];
				//============================================
				$datalist = array(			
							'ip_address' => $ip_address,
							'image' => $filename,	  
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'email' => $this->input->post('email'),
							'password' => base64_encode($this->input->post('password')),
							'phone' => $this->input->post('phone'),
							'time_zone' => $this->input->post('time_zone'),
							'country' => $this->input->post('country'),
							'user_type_main' => $this->input->post('user_type_main'),
							'user_type_sub' => $this->input->post('user_type_sub'),
							'home_phone' => $this->input->post('home_phone'),
							'phone_pref' => $this->input->post('phone_pref'),
							'business_name' => $this->input->post('business_name'),
							'billing_email' => $this->input->post('billing_email'),
							'default_message' => $this->input->post('default_message')
				);
				//====================Post Data===================
				//print_r($datalist);
				//exit();
				$id = $this->input->post('uid');
				$data['title'] = "Users Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/userst_model');
				//Transfering data to Model
				$query = $this->userst_model->users_edit($id,$datalist);
				// echo $ddd=$this->db->last_query();
				
				$this->session->set_flashdata("edit_success", "<b style='color:green;'> Users Updated successfully !!!</b>");
				redirect('supercontrol/users/show_users');
				//*********************************
		
			}else{
				$datalist = array(			
							'ip_address' => $ip_address,
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'email' => $this->input->post('email'),
							'password' => base64_encode($this->input->post('password')),
							'phone' => $this->input->post('phone'),
							'time_zone' => $this->input->post('time_zone'),
							'country' => $this->input->post('country'),
							'user_type_main' => $this->input->post('user_type_main'),
							'user_type_sub' => $this->input->post('user_type_sub'),
							'home_phone' => $this->input->post('home_phone'),
							'phone_pref' => $this->input->post('phone_pref'),
							'business_name' => $this->input->post('business_name'),
							'billing_email' => $this->input->post('billing_email'),
							'default_message' => $this->input->post('default_message')
				
				);
				//print_r($datalist);
				//exit();
				$id = $this->input->post('uid');
				$data['title'] = "Users Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/userst_model');
				//Transfering data to Model
				$query = $this->userst_model->users_edit($id,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$this->session->set_flashdata("edit_success", "<b style='color:green;'> Users Updated successfully !!!</b>");
				redirect('supercontrol/users/show_users');
			}
			} else{
				if ($this->upload->do_upload("userfile")) {
				@unlink("uploads/propic/".$imagename);
				
				$data['userfile'] = $this->upload->data();
				$filename=$data['userfile']['file_name'];
				//============================================
				$datalist = array(			
							'ip_address' => $ip_address,	  
							'image' => $filename,	  
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'email' => $this->input->post('email'),
							'password' => base64_encode($this->input->post('password')),
							'phone' => $this->input->post('phone'),
							'time_zone' => $this->input->post('time_zone'),
							'country' => $this->input->post('country'),
							'user_type_main' => $this->input->post('user_type_main'),
							'address' => $this->input->post('address'),
							'abn_acn_num' => $this->input->post('abn_acn_num'),
							'vehicle' => $this->input->post('vehicle'),
							'contact_preference' => $this->input->post('contact_preference'),
							'device' => $this->input->post('device'),
							'gst_status' => $this->input->post('gst_status')
				);
				//====================Post Data===================
				//print_r($datalist);
				//exit();
				$id = $this->input->post('uid');
				$data['title'] = "Exco Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/userst_model');
				//Transfering data to Model
				$query = $this->userst_model->users_edit($id,$datalist);
				// echo $ddd=$this->db->last_query();
				
				$this->session->set_flashdata("edit_success", "<b style='color:green;'> Exco User Updated successfully !!!</b>");
				redirect('supercontrol/users/show_users');
				//*********************************
		
			}else{
				$datalist = array(			
							'ip_address' => $ip_address,	  
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'email' => $this->input->post('email'),
							'password' => base64_encode($this->input->post('password')),
							'phone' => $this->input->post('phone'),
							'time_zone' => $this->input->post('time_zone'),
							'country' => $this->input->post('country'),
							'user_type_main' => $this->input->post('user_type_main'),
							'address' => $this->input->post('address'),
							'abn_acn_num' => $this->input->post('abn_acn_num'),
							'vehicle' => $this->input->post('vehicle'),
							'contact_preference' => $this->input->post('contact_preference'),
							'device' => $this->input->post('device'),
							'gst_status' => $this->input->post('gst_status')
				
				);
				//print_r($datalist);
				//exit();
				$id = $this->input->post('uid');
				$data['title'] = "Exco Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/userst_model');
				//Transfering data to Model
				$query = $this->userst_model->users_edit($id,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$this->session->set_flashdata("edit_success", "<b style='color:green;'> Exco User Updated successfully !!!</b>");
				redirect('supercontrol/users/show_users');
				}
			}
		}
//================Update Individual  users ***** END HERE====================

		//=====================DELETE NEWS====================

		
		function delete_users() {
			$id = $this->uri->segment(4);
			$result=$this->userst_model->show_users_id($id);
			//print_r($result);
			$imagename = $result[0]->image; 
			//echo $banner_img;exit();
			//Loading Database
			$this->load->database();

			//Transfering data to Model
			$query = $this->userst_model->delete_users($id,$imagename);
			$data['euser'] = $query;
			$this->session->set_flashdata('delete_message', 'Users Deleted Successfully !!!!');
			redirect('supercontrol/users/show_users');
		}

		//=====================DELETE NEWS====================

		//====================MULTIPLE DELETE=================
		function delete_multiple(){
		$ids = ( explode( ',', $this->input->get_post('ids') ));
		$this->userst_model->delete_mul($ids);
		$this->session->set_flashdata('delete_message1', 'Users Deleted Successfully !!!!');
			redirect('supercontrol/users/show_users');
		}
		
		function users_view($id){
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/userst_model');
			//Transfering data to Model
			$query = $this->userst_model->users_view_join($id);
			$data['viewusers'] = $query;
			
			//echo $sql = $this->db->last_query();
			//exit();
			$data['title'] = "Users View";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/users_view',$data);
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