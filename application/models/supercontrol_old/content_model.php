<?php 
class Content_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
   
	public function insert_cms($data) {
		$this->load->database();
	    $this->db->insert('sm_page_content', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	function show_cmslist()
	{
		$sql ="select * from sm_page_content ORDER BY `page_content`.`id` ASC";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	function crop_cmslist()
	{
		$sql ="select * from sm_cms_corp_stu";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	public function insert_crop($data) {
		$this->load->database();
	    $this->db->insert('sm_cms_corp_stu', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
	
	
	
	function show_cms_id($id){
		$this->db->select('*');
		$this->db->from('sm_page_content');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function show_crop_id($id){
		$this->db->select('*');
		$this->db->from('sm_cms_corp_stu');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	function edit_cms($id, $data){
	
		$this->db->where('id', $id);
		$this->db->update('sm_page_content',$data);
	}
	function edit_crop($id, $data){
	
		$this->db->where('id', $id);
		$this->db->update('sm_cms_corp_stu',$data);
	}
	
	
}
?>
