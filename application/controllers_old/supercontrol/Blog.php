<?php
class Blog extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
			redirect('supercontrol/home', 'refresh');
			}
			$this->load->model('supercontrol/blog_model');
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
			redirect('supercontrol/blog/blog_add_form');
			///supercontrol/blog_add_form
        }else{
        	$this->load->view('supercontrol/login');	
        }
		
		
	}
//======================Show Add form for blog add **** START HERE========================	
function blog_add_form(){
				$data['title'] = "Add Blog";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/blogadd_view');
				$this->load->view('supercontrol/footer');
     }
		
//====================== Show Add form for blog add ****END HERE========================
		//=======================Insert Page Data============
		function add_blog(){
			$my_date = date("Y-m-d", time()); 
			$config = array(
			'upload_path' => "uploads/blog/",
			'upload_url' => base_url() . "uploads/blog/",
			'allowed_types' => "gif|jpg|png|jpeg"
			);
        	$this->load->library('upload', $config);
				//=====================+++++++++++++++++++++++===================
				$this->form_validation->set_rules('blog_title','News Title', 'required');
				$this->form_validation->set_rules('posted_by', 'Posted By', 'required|min_length[1]|max_length[100]');
				$this->form_validation->set_rules('blog_desc', 'blog Description', 'required|min_length[1]|max_length[100000]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">Some Fields Can Not Be Blank</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/blogadd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);
				}else{
					if (!$this->upload->do_upload('userfile')){
            			$data['success_msg'] = '<div class="alert alert-success text-center">You Must Select An Image File!</div>';
						$this->load->view('supercontrol/header');
            			$this->load->view('supercontrol/blogadd_view', $data);
						$this->load->view('supercontrol/footer');
        			}else{
						 $data['userfile'] = $this->upload->data();
						 $filename=$data['userfile']['file_name'];
						 $data = array(
							'blog_title' => $this->input->post('blog_title'),
							'posted_by' => $this->input->post('posted_by'),
							'blog_image' => $filename,
							'blog_desc' => $this->input->post('blog_desc'),
							'date' => $my_date,
							'blog_status' => 1
						);
						$this->blog_model->insert_blog($data);
            			$upload_data = $this->upload->data();
						$query = $this->blog_model->show_blog();
						$data['ecms'] = $query;
            			$data['success_msg'] = '<div class="alert alert-success text-center"> Data successfully inserted!!!</div>';
						$this->load->view('supercontrol/header',$data);
						$this->load->view('supercontrol/showbloglist',$data);
						$this->load->view('supercontrol/footer');
				
					}
				}
		}
		//=======================Insert Page Data============
function view_blog($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit blog";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/blog_model');
			//Transfering data to Model
			$query = $this->blog_model->show_blog_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/blog_view', $data);
			$this->load->view('supercontrol/footer');
		}
//=======================Insertion Success message for News *** START HERE=========
		function success(){
			$data['h1title'] = 'Add Blog';
			
			$data['title'] = 'Add Blog';
			$this->load->view('supercontrol/header');
			$this->load->view('supercontrol/blogadd_view',$data);
			$this->load->view('supercontrol/footer');
		}
//=======================Insertion Success message *** END HERE=========	
//======================Show News List **** START HERE========================
		function show_blog(){
		//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/blog_model');
			//Transfering data to Model
			$query = $this->blog_model->show_blog();
			$data['ecms'] = $query;
			$data['title'] = "Blog List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showbloglist');
			$this->load->view('supercontrol/footer');
		
	}
//======================Show News List **** END HERE========================
//======================Status change **** START HERE========================
	function statusblog ()
		{
			     $stat= $this->input->get('stat'); 
				 $id= $this->input->get('id');   
		$this->load->model('supercontrol/blog_model');
		$this->blog_model->updt($stat,$id);
		}

//=======================Status change **** END HERE========================	
//================Show Individual by Id for News *** START HERE=================
		function show_blog_id($id) {
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title'] = "Edit blog";
			//Loading Database
			$this->load->database();
			//Calling Model
			$this->load->model('supercontrol/blog_model');
			//Transfering data to Model
			$query = $this->blog_model->show_blog_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/blog_edit', $data);
			$this->load->view('supercontrol/footer');
		}
		
//================Show Individual by Id for News *** END HERE=================
//================Update Individual blog***** START HERE ====================
		function edit_blog(){
			 $blog_image = $this->input->post('blog_image');
			 $config = array(
				'upload_path' => "uploads/blog/",
				'upload_url' => base_url() . "uploads/blog/",
				'allowed_types' => "gif|jpg|png|jpeg"
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("userfile")) {
				@unlink("uploads/blog/".$blog_image);
				//echo $image_data = $this->upload->data();
				$data['img'] = $this->upload->data();
			 	//echo $data['img']['file_name'];
				//exit();
				//*********************************
				//============================================
				$datalist = array(			
				'blog_title' => $this->input->post('blog_title'),
				'posted_by' => $this->input->post('posted_by'),
				'blog_desc' => $this->input->post('blog_desc'),
				'blog_image' => $data['img']['file_name']
				);
				//echo $gallery_name=$_POST['gallery_name'];
				//====================Post Data===================
				//print_r($datalist);
				//exit();
				$id = $this->input->post('blog_id');
				$data['title'] = "Blog Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/blog_model');
				//Transfering data to Model
				$query = $this->blog_model->blog_edit($id,$datalist);
				// echo $ddd=$this->db->last_query();
				
				$data1['message'] = '<div class="alert alert-success text-center">Data successfully uploaded!!!</div>';
				$query = $this->blog_model->show_bloglist();
				$data['ecms'] = $query;
				$data['title'] = "Blog Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showbloglist', $data1);
				$this->load->view('supercontrol/footer');
				//*********************************
		
			}else{
				$datalist = array(			
					'blog_title' => $this->input->post('blog_title'),
				    'posted_by' => $this->input->post('posted_by'),
				    'blog_desc' => $this->input->post('blog_desc')
				
				);
				$id = $this->input->post('blog_id');
				$data['title'] = "blog Edit";
				//loading database
				$this->load->database();
				//Calling Model
				$this->load->model('supercontrol/blog_model');
				//Transfering data to Model
				$query = $this->blog_model->blog_edit($id,$datalist);
				//echo $ddd=$this->db->last_query();
				//exit();
				$data1['message'] = '<div class="alert alert-success text-center"> Data successfully uploaded!!!</div>';
				$query = $this->blog_model->show_bloglist();
				$data['ecms'] = $query;
				$data['title'] = "blog Page List";
				$this->load->view('supercontrol/header',$data);
				$this->load->view('supercontrol/showbloglist', $data1);
				$this->load->view('supercontrol/footer');
			}
			
		}
//================Update Individual  News ***** END HERE====================

		//=====================DELETE NEWS====================

		
			function delete_blog() {
			$id = $this->uri->segment(4);
			$result=$this->blog_model->show_blog_id($id);
			$blog_image=$result[0]->blog_image; 
			$query = $this->blog_model->delete_blog($id,$blog_image);
			
	        $query = $this->blog_model->show_bloglist();
			$data['ecms'] = $query;
			$data['title'] = "blog Page List";
			$this->session->set_flashdata('success_delete', 'Blog Deleted Successfully !!!');
			redirect('supercontrol/blog/show_blog',TRUE);
		}

		//=====================DELETE NEWS====================

		//====================MULTIPLE DELETE=================
		function delete_multiple(){
		$ids = ( explode( ',', $this->input->get_post('ids') ));
		$this->blog_model->delete_mul($ids);
		$data4['msg1'] = '<div class="alert alert-success text-center"> Data successfully delete!!!</div>';
		$this->load->view('supercontrol/header');
		redirect('supercontrol/blog/show_blog',$data4);
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