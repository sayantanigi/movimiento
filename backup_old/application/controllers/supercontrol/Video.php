<?php
class Video extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/video_model');
			$this->load->library('image_lib');
			$this->load->database();
			
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
			redirect('supercontrol/video/videolist');
        }else{
        	$this->load->view('supercontrol/login');	
        }
		
		
	}
//======================Show Add form for news add **** START HERE========================	
function add_videoview(){
			$data['title'] = "Add Video";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/videoadd_view');
			$this->load->view('supercontrol/footer');
     }
		
//====================== Show Add form for news add ****END HERE========================
		//=======================Insert Page Data============
		function add_video(){
			$my_date = date("Y-m-d", time()); 
				//=====================+++++++++++++++++++++++===================
				//$this->form_validation->set_rules('category_id','Category', 'required');
				$this->form_validation->set_rules('video_name', 'Video Name', 'required|min_length[1]');
				$this->form_validation->set_rules('video_link', 'Video Link', 'required|min_length[1]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/videoadd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);
				}else{
					 $data = array(
						'video_name' => $this->input->post('video_name'),
						'video_link' => $this->input->post('video_link'),
						'video_description' => $this->input->post('video_description'),
						'add_date' => $my_date,
						'status' => 1
					);
					$this->video_model->insert_video($data);
					$data['success_msg'] = '<div class="alert alert-success text-center"> Video Successfully Added!!!</div>';
					$this->session->set_flashdata('message', 'Video Added Successfully');
					redirect('supercontrol/video/videolist','refresh');
				}
		}
		//=======================Insert Page Data============
		function videolist() {
			$data['title'] = "Video List";
			$query = $this->video_model->show_video();
			$data['evideo'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/videolist', $data);
			$this->load->view('supercontrol/footer');
		}
		//=======================Insertion Success message for News *** START HERE=========
		

		//================Show Individual by Id for News *** START HERE=================
		function show_video_id($id) {
			$id = $this->uri->segment(4); 
			$data['title'] = "Edit video";
			$query = $this->video_model->show_video_id($id);
			$data['ecms'] = $query;
			
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/videoedit', $data);
			$this->load->view('supercontrol/footer');
		}
		
		//================Show Individual by Id for News *** END HERE=================
		//================Update Individual news***** START HERE ====================
		function edit_video(){
			$id = $this->input->post('id'); 
			//=====================+++++++++++++++++++++++===================
				//$this->form_validation->set_rules('category_id','Category', 'required');
				$this->form_validation->set_rules('video_name', 'Video Name', 'required|min_length[1]');
				$this->form_validation->set_rules('video_link', 'Video Link', 'required|min_length[1]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			//=====================+++++++++++++++++++++++===================
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('supercontrol/header');
				$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
				$this->load->view('supercontrol/header');
				$this->load->view('supercontrol/videoadd_view',$data);
				$this->load->view('supercontrol/footer');
			//redirect('banner/addbanner',$data);
			}else{
				$data = array(
					'video_name' => $this->input->post('video_name'),
					'video_link' => $this->input->post('video_link'),
					'video_description' => $this->input->post('video_description'),
					'status' => $this->input->post('status')
				);
				$this->video_model->update_video($id,$data);
				//echo $this->db->last_query();
				//exit();
				$data['success_msg'] = '<div class="alert alert-success text-center"> Video Successfully Added!!!</div>';
				$this->session->set_flashdata('message', 'Video Updated Successfully');
				redirect('supercontrol/video/videolist','refresh');
			}
		}
		//================Update Individual  News ***** END HERE====================

		//=====================DELETE NEWS====================
		function delete_video() {
			$id = $this->uri->segment(4);
			$query = $this->video_model->delete_video($id);
			$this->session->set_flashdata('message', 'Video Deleted Successfully');
			redirect('supercontrol/video/videolist','refresh');
		}

		//=====================DELETE NEWS====================
		//====================MULTIPLE DELETE=================
		function delete_multiple(){
		$ids = ( explode( ',', $this->input->get_post('ids') ));
		$this->video_model->delete_mul($ids);
		$data4['msg1'] = '<div class="alert alert-success text-center">Successfully Deleted!!!</div>';
		$this->load->view('supercontrol/header');
		redirect('supercontrol/video/show_video',$data4);
		$this->load->view('supercontrol/footer');
		}
		//====================MULTIPLE DELETE=================
		
		function add_videcategoryview(){
				//=====================+++++++++++++++++++++++===================
				$this->form_validation->set_rules('category_name','Category Name', 'required');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/videocategoryaddview',$data);
					$this->load->view('supercontrol/footer');
				}else{
					 $data = array(
						'category_name' => $this->input->post('category_name'),
						'status' => 1
					);
					$this->video_model->insert_category($data);
					$data['success_msg'] = '<div class="alert alert-success text-center"> Video Successfully Added!!!</div>';
					$this->session->set_flashdata('message', 'Category Added Successfully');
					redirect('supercontrol/video/categorylist','refresh');
				}
		}
		

		//====================MULTIPLE DELETE=================
		function delete_multiplemenu(){
		$ids = ( explode( ',', $this->input->get_post('ids') ));
		$this->video_model->delete_mulmenu($ids);
		$data4['msg1'] = '<div class="alert alert-success text-center">Successfully Deleted!!!</div>';
		$this->load->view('supercontrol/header');
		redirect('supercontrol/video/show_video',$data4);
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