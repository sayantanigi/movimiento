<?php 
class Email_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	
	
	function show_emaillist()
	{
		$sql ="select * from sm_na_email";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	
	function show_email_id($id){
		$this->db->select('*');
		$this->db->from('sm_na_email');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	
	
	function delete_email($id){
		$this->db->where('id', $id);
      $this->db->delete('sm_na_email'); 
	}
	
	function edit_email_individual($id, $data){
		$this->db->where('id', $id);
		$this->db->update('sm_na_email',$data);
	}
	
	
}
?>
