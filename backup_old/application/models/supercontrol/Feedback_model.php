<?php 
class Feedback_model extends CI_Model{
	function __construct() {
        parent::__construct();
	$this->load->database();	
}
function show_feedback()
	{
		$sql ="select * from sm_property_feedback order by fid asc";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
function feedback_reply($data,$id){
	
		$this->db->where('fid',$id);
		
		$this->db->update('sm_property_feedback',$data);
	}

function show_feedback_id($id){
		$this->db->select('*');
		$this->db->from('sm_property_feedback');
		$this->db->where('fid', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function delete_feedback($id){

	  $this->db->where('fid', $id);

      $this->db->delete('sm_property_feedback'); 

	}
		function adminmail(){
		$this->load->database();
		$sql ="select * from sm_admin_mail";
		
		$query1 = $this->db->query($sql);
		return($query1->num_rows() > 0) ? $query1->result(): NULL;
		}
}
?>