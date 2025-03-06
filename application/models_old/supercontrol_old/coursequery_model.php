<?php 
class Coursequery_model extends CI_Model{
	function __construct() {
        parent::__construct();
	$this->load->database();	
}
function show_coursequery()
	{
		$sql ="select * from sm_course_query ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_coursequery_id($id){
		$this->db->select('*');
		$this->db->from('sm_course_query');
		$this->db->where('ContactId', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function delete_coursequery($id){

	  $this->db->where('ContactId', $id);

      $this->db->delete('sm_course_query'); 

	}
		function adminmail(){
		$this->load->database();
		$sql ="select * from sm_admin_mail";
		
		$query1 = $this->db->query($sql);
		return($query1->num_rows() > 0) ? $query1->result(): NULL;
		}
}
?>