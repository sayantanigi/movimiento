<?php 
class Partners_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	public function insert_partners($data) {
		$this->load->database();
	    $this->db->insert('sm_partners', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function show_partners()
	{
		$sql ="select * from sm_partners ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	
	function show_partners_id($id){
		$this->db->select('*');
		$this->db->from('sm_partners');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function partners_edit($id, $data, $partners_img){
		$this->db->where('id', $id);
		$this->db->update('sm_partners',$data);
	}
	
	function updt($stat,$id){
	
		$sql ="update sm_partners set status=$stat where id=$id ";
		$query = $this->db->query($sql);
	}
	function show_partnerslist()
	{
		$sql ="select * from sm_partners";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	
	function delete_partners($id,$partners_img){
		$this->db->where('id', $id);
		unlink("uploads/partners/".$partners_img);
		$this->db->delete('sm_partners');	
		}
}
?>
