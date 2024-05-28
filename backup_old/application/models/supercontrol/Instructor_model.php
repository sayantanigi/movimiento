<?php 
class Instructor_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_instructor($data) {
		$this->load->database();
	    $this->db->insert('sm_blog', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_member()
	{
		$this->db->select('*');
		$this->db->from('sm_member');
		$this->db->where('user_type', 'inst');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function show_member_id($uid)
	{
		$this->db->select('*');
		$this->db->from('sm_member');
		$this->db->where('user_type', 'inst');
		$this->db->where('member_id', $uid);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}	
	
function show_course()
	{
		$this->db->select('*');
		$this->db->from('sm_course');
		$this->db->where('status','1');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function show_course_id($cid)
	{
		$this->db->select('*');
		$this->db->from('sm_course');
		$this->db->where('course_id',$cid);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	function show_course_inst($cid)
	{
		$this->db->select('*');
		$this->db->from('sm_course_instructor');
		$this->db->where('course_id',$cid);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}		
function show_instructor()
	{
		$this->db->select('*');
		$this->db->from('sm_course_instructor');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}	
		

function show_mode()
	{
		$this->db->select('*');
		$this->db->from('sm_mode');
		$this->db->where('mode_status',1);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function show_mode_id($mid)
	{
		$this->db->select('*');
		$this->db->from('sm_mode');
		$this->db->where('id',$mid);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}		

	
	function show_blog_list()
	{
		$sql ="select * from sm_blog where blog_status='1'";
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
function delete_instructor($id){
		$this->db->where('inst_id', $id);
		$this->db->delete('sm_course_instructor');	
		}
function delete_mul_inst($ids)//Delete Multiple News
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('inst_id', $did);
			$this->db->delete('sm_course_instructor');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
		}
	}
?>