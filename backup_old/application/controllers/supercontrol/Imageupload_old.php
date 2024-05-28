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
		 // echo "fff"; exit();
        $name_array = array();
        $count = count($_FILES['userfile']['size']);
        foreach($_FILES as $key=>$value)
        for($s=0; $s<=$count-1; $s++) {
        $_FILES['userfile']['name']=$value['name'][$s];
        $_FILES['userfile']['type']    = $value['type'][$s];
        $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
        $_FILES['userfile']['error']       = $value['error'][$s];
        $_FILES['userfile']['size']    = $value['size'][$s];  
        $config['upload_path'] = './property_img/';
        $config['allowed_types'] = 'gif|jpg|png';
		
/*		$config['upload_path'] = './property_img/corp_img';
        $config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']    = '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['x_axis'] = '100';
		$config['y_axis'] = '300';
*/        $this->load->library('upload', $config);
        $this->upload->do_upload();
        $data = $this->upload->data();
        $name_array[] = $data['file_name'];
           
            $names= implode(',', $name_array);
           $this->load->database();
		 $this->load->model('supercontrol/Property_model');
		 $this->load->helper('date');
		
            $db_data = array(
							 'property_id'=>$this->input->post('property_id'),
							 'apartment_image'=> $names,
							 'date' => date('Y-m-d H:i:s')
							 );
        $this->db->insert('sm_multi_img',$db_data);  
		
		}
           // print_r($names);
			redirect('supercontrol/imageupload/property_img/'.$this->input->post('property_id').'/imgup');
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
			$this->load->view('supercontrol/footer');
			
					
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
			$this->load->view('supercontrol/footer');	
	}
	
	
	
	
}
?>