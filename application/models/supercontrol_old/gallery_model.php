<?php 
class Gallery_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_gallery($data) {
		$this->load->database();
	    $this->db->insert('sm_gallery', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_gallery()
	{
		$sql ="select * from sm_gallery ORDER BY id DESC";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_gallery_id($id){
		$this->db->select('*');
		$this->db->from('sm_gallery');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function gallery_edit($id, $data,$old_file){
	
		$this->db->where('id', $id);
		@unlink("gallery/".$old_file);
		$this->db->update('sm_gallery',$data);
	}
function updt($stat,$id){
	 
		$sql ="update gallery set gallery_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	function gallery_view($id){
		$this->db->select('*');
		$this->db->from('sm_gallery');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return($query->num_rows() > 0) ? $query->result(): NULL;
		
	}
	
	function delete_gallery($id,$gallery_image){
	  $this->db->where('id', $id);
	  unlink("gallery/".$gallery_image);
      $this->db->delete('sm_gallery'); 
	}
function show_gallerylist()
	{
		$sql ="select * from sm_gallery ORDER BY id DESC";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
}
?>