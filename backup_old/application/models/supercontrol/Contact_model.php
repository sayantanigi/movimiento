<?php 
class Contact_model extends CI_Model{
	function __construct() {
        parent::__construct();
	$this->load->database();	
}
function show_contact()
	{
		$sql ="select * from sm_user_contact ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_contact_id($id){
		$this->db->select('*');
		$this->db->from('sm_user_contact');
		$this->db->where('ContactId', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function delete_contact($id){

	  $this->db->where('ContactId', $id);

      $this->db->delete('sm_user_contact'); 

	}
		function adminmail(){
		$this->load->database();
		$sql ="select * from sm_admin_mail";
		
		$query1 = $this->db->query($sql);
		return($query1->num_rows() > 0) ? $query1->result(): NULL;
		}
}
?>