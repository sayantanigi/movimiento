<?php
class Discount extends CI_Controller {
		//============Constructor to call Model====================
		function __construct() {
			
			parent::__construct();
			$this->load->library(array('form_validation','session'));
			if($this->session->userdata('is_logged_in')!=1){
				redirect('supercontrol/home', 'refresh');
			}

			$this->load->model('supercontrol/generalmodel');
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
        	}else{
        		$this->load->view('supercontrol/login');	
        	}
		
		}
		//======================Show Add form for blog add=========
		function add_discount_view(){
			
			$data['title'] = "Add Discount";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/discountadd_view');
			$this->load->view('supercontrol/footer');
		
		}
		//====================== Show Add form for blog add========
		//=======================Insert Page Data==================
		function add_discount(){
			
			$my_date = date("Y-m-d", time()); 
				//=====================+++++++++++++++++++++++===================
				$this->form_validation->set_rules('discount_code','Discount Code', 'required|min_length[1]|max_length[10]');
				$this->form_validation->set_rules('percentage', 'Percentage', 'required|min_length[2]|max_length[4]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">These fields are required..</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/discountadd_view',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);
				}else{
					$data = array(
						'discount_code'=>$this->input->post('discount_code'),
						'percentage' =>$this->input->post('percentage'),
						'add_date' => date('Y-m-d'),
						'status' => 'Y'
					);
					$this->generalmodel->insert_offer($data);
					$query = $this->generalmodel->show_offer();
					$data['ecms'] = $query;
					$data['success_msg'] = '<div class="alert alert-success text-center"> Data successfully inserted!!!</div>';
					$this->load->view('supercontrol/header',$data);
					$this->load->view('supercontrol/showofferlist',$data);
					$this->load->view('supercontrol/footer');
				}
		
		}
		//======================Show News List **** START HERE======
		function show_discount(){
			
			$this->load->database();
			$this->load->model('supercontrol/blog_model');
			$query = $this->generalmodel->show_offer();
			$data['ecms']=$query;
			$data['title']="Discount List";
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/showofferlist');
			$this->load->view('supercontrol/footer');
		
		}
		
		function show_discount_id($id) {
			
			 $id = $this->uri->segment(4); 
			//exit();
			$data['title']="Edit Discount";
			//Loading Database
			$query = $this->generalmodel->show_dicount_id($id);
			$data['ecms'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/offer_edit', $data);
			$this->load->view('supercontrol/footer');
		
		}
		
		function edit_discount(){
				$id = $this->input->post('blog_id');
				$data['title'] = "Discount Edit";
	
				//===========+++++++++++++++++++++++===================
				$this->form_validation->set_rules('discount_code','Discount Code', 'required|min_length[1]|max_length[10]');
				$this->form_validation->set_rules('percentage', 'Percentage', 'required|min_length[2]|max_length[4]');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				//=====================+++++++++++++++++++++++===================
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('supercontrol/header');
					$data['success_msg'] = '<div class="alert alert-success text-center">These fields are required..</div>';
					$this->load->view('supercontrol/header');
            		$this->load->view('supercontrol/offer_edit',$data);
					$this->load->view('supercontrol/footer');
					//redirect('banner/addbanner',$data);
				}else{
					$data = array(
						'discount_code'=>$this->input->post('discount_code'),
						'percentage' =>$this->input->post('percentage')
						
					);
					$upde= $this->generalmodel->offer_edit($id,$data);
					$query = $this->generalmodel->show_offer();
					$data['ecms'] = $query;
					$data['success_msg'] = '<div class="alert alert-success text-center"> Data successfully Updated!!!</div>';
					$this->load->view('supercontrol/header',$data);
					$this->load->view('supercontrol/showofferlist',$data);
					$this->load->view('supercontrol/footer');
				}
		
		}
		//================Update Indivi END HERE====================
		//=================DELETE NEWS==========================
		function delete_discount(){
			
				$id = $this->uri->segment(4);
				$query = $this->generalmodel->delete_discount($id);
				//$query = $this->blog_model->show_discount();
				$data['ecms'] = $query;
				$data['title'] = "Offer List";
				$this->session->set_flashdata('success_delete', 'Deleted Successfully !!!');
				redirect('supercontrol/discount/show_discount',TRUE);
			
		}
		//==============DELETE NEWS=========================
		//==============MULTIPLE DELETE======================
		function delete_multiple_discount(){
			
			$ids = ( explode( ',', $this->input->get_post('ids') ));
			$this->blog_model->delete_mul($ids);
			$data4['msg1'] = '<div class="alert alert-success text-center"> Data successfully delete!!!</div>';
			$this->load->view('supercontrol/header');
			redirect('supercontrol/discount/show_discoun',$data4);
			$this->load->view('supercontrol/footer');
		
		}
		function statusblog ()
		{
			$stat= $this->input->get('stat'); 
			$id= $this->input->get('id');   
		
		$suc=$this->generalmodel->updt_discount($stat,$id);
		if($suc)
		{
			echo "Updated";
		}
		}
		//====================MULTIPLE DELETE=====================
		//======================Logout============================
		public function Logout(){
			
        	$this->session->sess_destroy();
        	redirect('supercontrol/login');
    	
		}
		//======================Logout==========================
}

?>