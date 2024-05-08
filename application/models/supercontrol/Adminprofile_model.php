<?php 
class Adminprofile_model extends CI_Model{
	function __construct() {
        parent::__construct();
		$this->load->database();
    }
function show_adminprofile()
	{
		$sql ="select * from  sm_admin_mail ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_adminprofile_id($MailId){
		
		$this->db->select('*');
		$this->db->from('sm_admin_mail');
		$this->db->where('MailId', $MailId);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function adminprofile_edit($MailId, $data){
        $this->db->where('MailId', $MailId);
		$this->db->update('sm_admin_mail',$data);
	}
function show_adminprofilelist()
	{
		$sql ="select * from sm_admin_mail where MailId=1";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
}
?>