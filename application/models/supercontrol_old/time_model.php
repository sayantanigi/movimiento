<?php
class time_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	public function insert_time($data) {
		$this->load->database();
		
			$config['upload_path'] = './time/';
					
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			
			$config['file_name'] = $imgname;
			
			$this->load->library('upload',$config);
				
			if (!$this->upload->do_upload("time_image"))
			{
				$error = array('error' => $this->upload->display_errors());
			}
			else
			{
				$upload_data = $this->upload->data();
				
			}
								
		
	    $this->db->insert('time', $data);
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function view_time(){
		$sql ="select * from sm_time";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	function edit_time($id,$data){
		
		$this->db->where('id', $id);
		$this->db->update('sm_time',$data);
			
	}
	
	function show_time_id($id){
		$this->db->select('*');
		$this->db->from('sm_time');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function delete_time($id){
				$this->db->where('id',$id);
				//$this->db->select('time_image');
				$result=$this->db->get('sm_time');
				$row = $result->row();
				//print_r($row);
				//$path = './uploads/'.$row->time_image;
				
				//unlink($path);
		
		
	  $this->db->where('id', $id);
      $this->db->delete('sm_time'); 
	}
}
?>