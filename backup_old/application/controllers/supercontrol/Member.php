<?php
class Member extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/faq_model');
			$this->load->model('supercontrol/generalmodel');
			$this->load->library('image_lib');
			
			 $this->load->model('generalmodel'); 
			
			
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
				redirect('supercontrol/faqadd_view');
        	}else{
        		$this->load->view('supercontrol/login');	
        	}
		}
		//======================Show Add form for faq add **** START HERE========================	
		function faq_add_form(){
			$data['title'] = "Add Faq";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/faqadd_view');
			$this->load->view('supercontrol/footer');
     	}
		
		//====================== Show Add form for faq add ****END HERE========================
		//=======================Insert Page Data============
		function add_cirtificate(){
			$memberid = end($this->uri->segment_array());
			$querymember = $this->generalmodel->getAllData('sm_member','member_id',$memberid,'','');
			$data['membername']=$querymember;
			
			$query = $this->generalmodel->getAllData('sm_course','status','1','','');
			$data['course']=$query;
			$data['title']='Add Cirtificate';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/cirtificateadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
		//=======================Insert Page Data=============
		//===============Generate Cirtificate================
		function generate_cirtificate(){
			$datalist = array(			
					'std_id' => $this->input->post('member_id'),
				    'course_id' => $this->input->post('course_id'),
					'issue_date' => date('Y-m-d',strtotime($this->input->post('issue_date'))),
					'status' => 'Yes'
				);
			//print_r($datalist);
			//exit();	
			$insertdata = $this->generalmodel->show_data_id('sm_generate_cirtificate','','','insert',$datalist);	
			$this->session->set_flashdata('success', 'Cirtificate Generated Successfully');
			redirect($_SERVER['HTTP_REFERER']);
				
		}
		//===============Generate Cirtificate================

		//=======================student_list================\
		function student_list(){
			//$table_name,$primary_key,$wheredata,$limit,$start
			$query = $this->generalmodel->getAllData('sm_member','user_type','std','','');
			$data['userlist']=$query;
			$data['title']='Add Cirtificate';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/student_list',$data);
			$this->load->view('supercontrol/footer');
			
		}


		function instructor_list(){
			//$table_name,$primary_key,$wheredata,$limit,$start
			$query = $this->generalmodel->getAllData('sm_member','user_type','inst','','');
			$data['userlist']=$query;
			$data['title']='Instructor list';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/student_list',$data);
			$this->load->view('supercontrol/footer');
			
		}
		public function instructor_schedule()
		{

			$inst_id=$this->session->userdata('is_logged_in');
			$data['title']='Schedule list';
			$this->load->view('supercontrol/header');
			$data['userlist']=$userlist=$this->generalmodel->fetch_all('sm_instructor_schedule');
			//print_r($userlist); exit();
			
			$this->load->view('supercontrol/schedule_list',$data);
			$this->load->view('supercontrol/footer');
		}
		public function instscheduleStatus()
	    {
	       // echo "sdfsdgfsd";
	         $tbl ="instructor_schedule";
	            $id = $this->input->get('id', TRUE);
	            $val = $this->input->get('val');
	            $field_data = array(
	                       'approved' => $val
	                       );
	            $result = $this->generalmodel->eidt_details1($tbl,$field_data,$id);

	           // echo $this->db->last_query(); exit();
	            if($result)
	            {
	                echo 'Status Changed';
	            }
	    } 
 	public function Deleteinstschedule()
    {
        //echo "sdsdf";
        $id = $this->input->get('id', TRUE);
        $user= $this->generalmodel->delete_ins('sm_instructor_schedule', $id);
        if ($user) {

            echo 'deleted';
        }
    }
         public  function business_list(){
			//$table_name,$primary_key,$wheredata,$limit,$start
			$query = $this->generalmodel->getAllData('sm_member','user_type','busi','','');
			$data['userlist']=$query;
			$data['title']='business list';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/business_list',$data);
			$this->load->view('supercontrol/footer');
			
		}
		public function bus_std_list(){
			//$table_name,$primary_key,$wheredata,$limit,$start
			$query = $this->generalmodel->fetch_all_join("SELECT * FROM sm_member where user_type='std' AND business_id!='0' ORDER BY member_id DESC");
			//echo $this->db->last_query(); exit();
			$data['userlist']=$query;
			$data['title']='Add Cirtificate';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/bus_student_list',$data);
			$this->load->view('supercontrol/footer');
			
		}
                public function delete_member()
                {
                    $id = $this->uri->segment(4);
                    //echo $id; exit();
                    $result=$this->generalmodel->delete_single('sm_member', $id);
                    if($result)
                    {
			$this->session->set_flashdata('success_msg', 'User Delete Successfully');
			redirect($_SERVER['HTTP_REFERER']);
                    }
                    
                }
                //=======================student_list================
		//======================Show Faq List **** START HERE========================
		function show_faq(){
		//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/faq_model');
			//Transfering data to Model
			$query = $this->faq_model->show_faq();
			$data['ecms'] = $query;
			$data['title'] = "Faq List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showfaqlist');
			$this->load->view('supercontrol/footer');
		
	}
	//======================Show Faq List **** END HERE========================

	//================Show Individual by Id for Faq *** START HERE=================
		function show_member_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Member";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/faq_model');
			//Transfering data to Model
			$query = $this->generalmodel->getAllData('sm_member','member_id',$id,'','');
			$data['userlist']=$query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/member_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
		function view_member_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit Member";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/faq_model');
			//Transfering data to Model
			$query = $this->generalmodel->getAllData('sm_member','member_id',$id,'','');
			$data['userlist']=$query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/member_view', $data);
			$this->load->view('supercontrol/footer');
		}
		
		
		function chat_member_id($id) {
			$id = $this->uri->segment(4); 
			
			$details = $this->generalmodel->get_user_by_id($id);
			//echo $this->db->last_query(); exit();
			$data['profile_name'] = $details[0]->first_name ." ". $details[0]->last_name;
			$data['myprofile']=$details;
			
			$data['title'] = "Chat With Member";
			$query = $this->generalmodel->getAllData('sm_member','member_id',$id,'','');
			$data['userlist']=$query;
			$querychatall = $this->generalmodel->chat_all($id);
			$data['allchat']=$querychatall;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/chat_member', $data);
			$this->load->view('supercontrol/footer');
		}
		
		public function chat_data(){
			$uid = $this->input->post('uid');
			//==============Get Parent Category Banner===============
			$details = $this->generalmodel->get_user_by_id($uid);
			$data['profile_name'] = $details[0]->first_name ." ". $details[0]->last_name;
			$data['myprofile']=$details;
		
			
			$record['user_id'] = '0';
			$record['admin_id'] = $uid;
			$record['message'] = $this->input->post('message');
			$record['send_date'] = date('Y-m-d h:i:s');
			$this->generalmodel->do_action('sm_chat','','','insert',$record,'');
			
			
			$details = $this->generalmodel->get_user_by_id($uid);
			//echo $this->db->last_query(); exit();
			$data['profile_name'] = $details[0]->first_name ." ". $details[0]->last_name;
			$data['myprofile']=$details;
			
			$querychatall = $this->generalmodel->chat_all($uid);
			$data['allchat']=$querychatall;
			
			$this->load->view('supercontrol/chat_new',$data);
        }
		
		public function chat_data_refresh(){
			$uid = $this->input->post('uid');
			//==============Get Parent Category Banner===============
			$details = $this->generalmodel->get_user_by_id($uid);
			$data['profile_name'] = $details[0]->first_name ." ". $details[0]->last_name;
			$data['myprofile']=$details;
		
			$details = $this->generalmodel->get_user_by_id($uid);
			//echo $this->db->last_query(); exit();
			$data['profile_name'] = $details[0]->first_name ." ". $details[0]->last_name;
			$data['myprofile']=$details;
			
			$querychatall = $this->generalmodel->chat_all($uid);
			$data['allchat']=$querychatall;
			
			$this->load->view('supercontrol/chat_new',$data);
        }
		
		function edit_member(){
				$data = array(			
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'phoneno' => $this->input->post('phoneno'),
					'gender' => $this->input->post('gender'),
					'user_type' => $this->input->post('user_type'),
					'status' => $this->input->post('status')
					);
			//echo "<pre>"; print_r($data); exit();
			$table_name = 'sm_member';
			$fieldname = 'member_id';
			$id = $this->input->post('member_id');
			$action = 'update';

			$this->session->set_flashdata('edit_message', 'Data Updated Successfully !!!');
			$this->generalmodel->show_data_id($table_name,$id,$fieldname,$action,$data);
			//echo $this->db->last_query(); exit();
			redirect($_SERVER['HTTP_REFERER']);
		}
		
//================Show Individual by Id for Faq *** END HERE=================
//================Update Individual faq***** START HERE ====================
		function edit_faq(){
				$datalist = array(			
					'question' => $this->input->post('question'),
				    'answer' => $this->input->post('answer')
				);
				$id = $this->input->post('faq_id');
				$data['title'] = "Faq Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/faq_model');
				//Transfering data to Model
				$query = $this->faq_model->faq_edit($id,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = 'Data Update Successfully';
				$query = $this->faq_model->show_faqlist();
				$data['ecms'] = $query;
				$this->session->set_flashdata('edit_message', 'Faq Updated Successfully !!!!');
				$data['title'] = "Faq Page List";
				/*$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showfaqlist', $data1);
				$this->load->view('supercontrol/footer');*/
				$this->load->view('supercontrol/header',$data);
			//$this->load->view('showbannerlist', $data);
			redirect('supercontrol/faq/show_faq');
			$this->load->view('supercontrol/footer');
			
			
		}
		//================Update Individual  Faq ***** END HERE====================
		//=====================DELETE NEWS====================
			function delete_faq() {
				$id = $this->uri->segment(4);
				$result=$this->faq_model->show_faq_id($id);
				//print_r($result);
				//echo $banner_img;exit();
				//Loading Database
				$this->load->database();
				//Transfering data to Model
				$query = $this->faq_model->delete_faq($id,$faq_image);
				$data['ecms'] = $query;
				$this->session->set_flashdata('delete_message1', 'Faq Deleted Successfully !!!!');
				$this->load->view('supercontrol/header',$data);
				//$this->load->view('showbannerlist', $data);
				redirect('supercontrol/faq/show_faq');
				$this->load->view('supercontrol/footer');
			}

		//=====================DELETE NEWS====================

}

?>