<?php 
class Blog_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_blog($data) {
		$this->load->database();
	    $this->db->insert('sm_blog', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}

function show_blog()
	{
		$sql ="select * from sm_blog ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
	
	function show_blog_list()
	{
		$sql ="select * from sm_blog where blog_status='1'";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	function show_offer_list()
	{
		$sql ="select * from discount";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_blog_id($id){
		$this->db->select('*');
		$this->db->from('sm_blog');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function blog_edit($id, $data){
	
		$this->db->where('id', $id);
		$this->db->update('sm_blog',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_blog set blog_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_bloglist()
	{
		$sql ="select * from sm_blog";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_blog($id,$blog_image){
		$this->db->where('id', $id);
		@unlink("blog/".$blog_image);
		$this->db->delete('sm_blog');	
		}
function delete_mul($ids)//Delete Multiple News
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('id', $did);
			unlink("blog/".$blog_image);
			$this->db->delete('sm_blog');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
		}
	}
?>