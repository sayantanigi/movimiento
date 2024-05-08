<?php 
class Banner_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	public function insert_banner($data) {
		$this->load->database();
	    $this->db->insert('sm_banner', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function show_banner()
	{
		$sql ="select * from sm_banner ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	
	function show_banner_id($id){
		$this->db->select('*');
		$this->db->from('sm_banner');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function banner_edit($id, $data, $banner_img){
	
		$this->db->where('id', $id);
		
		$this->db->update('sm_banner',$data);
	}
	
	function updt($stat,$id){
	
		$sql ="update sm_banner set status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	function show_bannerlist()
	{
		$sql ="select * from sm_banner";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	
	function delete_banner($id,$banner_img){
		$this->db->where('id', $id);
		unlink("banner/".$banner_img);
		$this->db->delete('sm_banner');	
		}
}
?>
