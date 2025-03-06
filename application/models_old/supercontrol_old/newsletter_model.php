<?php 
class Newsletter_model extends CI_Model{
	function __construct() {
        parent::__construct();
		 $this->load->database();	
 }
function show_newsletter()
	{
		$sql ="select * from  sm_newslettermail ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_newsletter_id($id){
		$this->db->select('*');
		$this->db->from('sm_newslettermail');
		$this->db->where('mail_id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function show_supercontrol_mail(){
		$this->db->select('*');
		$this->db->from('sm_admin_mail');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}	
function delete_newsletter($id){
	  $this->db->where('mail_id',$id);
      $this->db->delete('sm_newslettermail'); 
	}
	
function insert_reply($mail_id,$data){
	
		$this->db->where('mail_id',$mail_id);
		$this->db->update('sm_newslettermail',$data);
	}
	
	 function show_admin_mail()
	{   $this->db->select('*');
		$this->db->from('sm_admin_mail');
		$this->db->where('MailId',1);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}
?>