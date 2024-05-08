<?php 
class Testimonial_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_testimonial($data) {
		$this->load->database();
	    $this->db->insert('sm_testimonial', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_testimonial()
	{
		$sql ="select * from sm_testimonial ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_testimonial_id($id){
		$this->db->select('*');
		$this->db->from('sm_testimonial');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function testimonial_edit($id, $data,$testimonial_image){
	
		$this->db->where('id', $id);
		$this->db->update('sm_testimonial',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_testimonial set testimonial_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_testimoniallist()
	{
		$sql ="select * from sm_testimonial";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
			function testimonial_view($id){
		$this->db->select('*');
		$this->db->from('sm_testimonial');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return($query->num_rows() > 0) ? $query->result(): NULL;
		
	}
	
	function delete_testimonial($id,$testimonial_image){
	  $this->db->where('id', $id);
	  @unlink("testimonial/".$testimonial_image);
      $this->db->delete('sm_testimonial'); 
	}
	
}
?>