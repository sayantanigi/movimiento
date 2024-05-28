<?php 
class Information_model extends CI_Model{
	function __construct() {
        parent::__construct();
	$this->load->database();	
}
function show_information()
	{
		$sql ="select * from sm_user_information ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_information_id($id){
		$this->db->select('*');
		$this->db->from('sm_user_information');
		$this->db->where('information_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function delete_information($id){

	  $this->db->where('information_id', $id);

      $this->db->delete('sm_user_information'); 

	}
		function adminmail(){
		$this->load->database();
		$sql ="select * from sm_admin_mail";
		
		$query1 = $this->db->query($sql);
		return($query1->num_rows() > 0) ? $query1->result(): NULL;
		}
}
?>