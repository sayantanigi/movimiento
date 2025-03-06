<?php
class time extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->model('time_model');
		}
		//============Constructor to call Model====================
		function index(){
			if($this->session->userdata('is_logged_in')){ 
			$data['title'] = "Add time ";
			$this->load->view('header',$data);
			$this->load->helper(array('form'));
			$this->load->view('timeadd_view');
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
		//=======================Insert Profile Data============
		function add_time(){
			
			//Validating Image Field
			//$this->form_validation->set_rules('time_image', 'Image', 'required');
			
			//Validating Name Field
			$this->form_validation->set_rules('day', 'day', 'required|min_length[1]|max_length[25]');
			$this->form_validation->set_rules('entry_time', 'entry_time', 'required|min_length[1]|max_length[25]');
			$this->form_validation->set_rules('exit_time', 'exit_time', 'required|min_length[1]|max_length[25]');
			//Validating Address Field
			//$this->form_validation->set_rules('subtitle', 'Sub Heading', 'required|min_length[1]|max_length[50]');
			
			//Validating Address Field
			//$this->form_validation->set_rules('description', 'Description', 'required|min_length[1]|max_length[300]');
			
			
			
			if ($this->form_validation->run() == FALSE) {
				
			$data['title'] = "Add time";
			$this->load->view('header',$data);
			$this->load->view('timeadd_view');
			$this->load->view('footer');
			
			}else {
				
			//$imgname = $_FILES["time_image"]["name"];
				
			//Setting values for tabel columns
			$data = array(
							'day' => $this->input->post('day'),
							'entry_time' => $this->input->post('entry_time'),
							'exit_time' => $this->input->post('exit_time'),
							//'time_image' => $_FILES["time_image"]["name"],
							'status' => 1
			 );
			
			//Transfering data to Model
			$this->time_model->insert_time($data);
			$data1['message'] = 'Data Inserted Successfully';
			redirect('time/view_time');
			
			}
		}
		//=======================Insert Individual Data============
  		//=======================Insertion Success message=========
		function success(){
			$data['h1title'] = 'Data Inserted Successfully';
			$data['title'] = 'Add time';
			$this->load->view('header');
			$this->load->view('timeadd_view',$data);
			$this->load->view('footer');
		}
		//=======================Insertion Success message=========
		//================View Individual Data List=============
		function view_time(){
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('time_model');
			//Transfering data to Model
			$query = $this->time_model->view_time();
			$data['ecms'] = $query;
			$data['title'] = "time List";
			$this->load->view('header',$data);
			$this->load->view('showtime');
			$this->load->view('footer');
		}
		//================View Individual Data List=============
  		//================Show Individual by Id=================
		function show_time_id($id) {
			$data['title'] = "time Edit";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('time_model');
			//Transfering data to Model
			$query = $this->time_model->show_time_id($id);
			$data['ecms'] = $query;
			$this->load->view('header',$data);
			$this->load->view('timeedit', $data);
			$data['title'] = "Edit Data List";
			$this->load->view('footer');
		}
   		//================Show Individual by Id=================
  	 	//================Update Individual ====================
		function edit_time(){
			//====================Post Data=====================
			 $id = $this->input->post('id');
			//if($_FILES["time_image"]["name"]!='') {
				
				//$imgname = $_FILES["time_image"]["name"];
				
				$this->db->where('id',$id);
				//$this->db->select('time_image');
				$result=$this->db->get('bl_time');
				$row = $result->row();
				//print_r($row);
				//$path = './time/'.$row->time_image;
				
				//unlink($path);
		
			//$config['upload_path'] = './time/';
					
			//$config['allowed_types'] = 'jpg|jpeg|png|gif';
			
			//$config['file_name'] = $imgname;
			
			//$this->load->library('upload',$config);
				
			/*if (!$this->upload->do_upload("time_image"))
			{
				$error = array('error' => $this->upload->display_errors());
			}
			else
			{
				$upload_data = $this->upload->data();
				
			}
				
			} else {
				$imgname = $this->input->post('oldimg');
			}
*/
			

			
			$datalist = array(
							'day' => $this->input->post('day'),
							'entry_time' => $this->input->post('entry_time'),
							'exit_time' => $this->input->post('exit_time'),
							//'time_image' => $imgname,
							'status' => 1
			);
			
			
		
			//====================Post Data===================
			
		
			$data['title'] = "time Edit";
			//loading database
			$this->load->database();
			//Calling Model
			$this->load->model('time_model');
			//Transfering data to Model
			$query = $this->time_model->edit_time($id,$datalist);
			$data1['message'] = 'Data Updated Successfully';
			redirect('time/successupdate');
		}
		//================Update Individual ====================
  		//=======================Update Success message=========
		function successupdate(){
			//loading database
			$this->load->database();
			//Calling Model
			$this->load->model('time_model');
			//Transfering data to Model
			$query = $this->time_model->view_time();
			$data['ecms'] = $query;
			$data['title'] = "time List";
			$datamsg['h1title'] = 'Data Updated Successfully';
			$this->load->view('header',$data);
			$this->load->view('showtime',$datamsg);
			$this->load->view('footer');
		}
		//=======================Update Success message=========
		//=======================Delete Individual==============
		function delete_time($id){
			//Loading  Database
			$this->load->database();
			//Transfering data to Model
			$this->time_model->delete_time($id);
			$data1['message'] = 'Data Deleted Successfully';
			redirect('time/successdelete');
		}
		//======================Delete Individual===============
		//======================Delete Success message==========
		function successdelete(){
			//Loading  Database
			$this->load->database();
			//Calling Model
			$this->load->model('time_model');
			//Transfering data to Model
			$query = $this->time_model->view_time();
			$data['ecms'] = $query;
			$data['title'] = "time List";
			$datamsg['h1title'] = 'Data Updated Successfully';
			$this->load->view('header',$data);
			$this->load->view('showtime');
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

