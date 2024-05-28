<?php
class Imageupload extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
    function index()
    {   
	    $this->load->helper('form');
    $data = array();
    $data['title'] = 'Multiple file upload';
        $this->load->view('supercontrol/property_img',$data);
    }
    function doupload() {


		$config['upload_path'] = "./property_img";
		$config['allowed_types'] = '*';
		$config['max_size'] = 0;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload("file"))
		{
			$response = $this->upload->display_errors();
		}
		else
		{
			$response = $this->upload->data();
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($response));


         $this->load->database();
		 $this->load->model('supercontrol/Property_model');
		 $this->load->helper('date');
		 

		
            $db_data = array(
							 'property_id'=>$this->input->post('property_id'),
							 'apartment_image'=> str_replace(" ","_", $_FILES['file']['name']),
							 'date' => date('Y-m-d H:i:s')
							 );
							 

        $this->db->insert('sm_multi_img',$db_data);  
           // print_r($names);
			//redirect('supercontrol/imageupload/property_img/'.$this->input->post('property_id').'/imgup');
			//redirect('index.php/imageupload/property_img/'.$this->input->post('property_id').'');
    }
	
	function property_img($id) {
		/* $id=$this->input->post('id');  */
		
		$this->load->database(); 
			//Calling Model
			$this->load->model('supercontrol/property_model'); //Transfering data to Model
			$query = $this->property_model->show_property_multi_image($id); 
			$data['mulimg'] = $query;
			//echo $this->db->last_query();
		//exit();
		$this->load->view('supercontrol/header',$id);
			$this->load->view('supercontrol/property_img',$data);
			$data['title'] = "Edit property Image";
			$this->load->view('supercontrol/footer_img');
			
					
	}
	
		function property_img_ajax($id) {
		/* $id=$this->input->post('id');  */
		
		$this->load->database(); 
			//Calling Model
			$this->load->model('supercontrol/property_model'); //Transfering data to Model
			$query = $this->property_model->show_property_multi_image($id); 
			$data['mulimg'] = $query;
			//echo $this->db->last_query();
		//exit();
			$this->load->view('supercontrol/property_img_ajax',$data);
			$data['title'] = "Edit property Image";
			
					
	}
	
	function delete_property_img($id){
			//Loading  Database
			$this->load->database();
			$this->load->model('supercontrol/property_model'); $id = $this->uri->segment(4);
			//echo $id; exit();
			$result=$this->property_model->show_property_multi_img($id); 
			//print_r($result); exit();
			$apartment_image = $result[0]->apartment_image;
			$this->property_model->delete_property_img($id,$apartment_image);
			//$data['emember'] = $query; 
			$data1['message'] = 'Data Deleted Successfully'; 
			redirect('supercontrol/imageupload/property_img/'.$this->uri->segment(5).'/imgdlt');
		}
	
	function show_images($id){
		$this->load->database();
			/* Calling Model */
			$$this->load->model('supercontrol/Property_model');
			/* Transfering data to Model */
			$query = $this->Property_model->show_multi_image();
			$data['eimg'] = $query;
			$this->load->view('supercontrol/header',$data);
			$this->load->view('supercontrol/show_membership_plan', $data);
			$data['title'] = "Membership Plan List";
			$this->load->view('supercontrol/footer_img');	
	}
	
	
	
	
}
?>