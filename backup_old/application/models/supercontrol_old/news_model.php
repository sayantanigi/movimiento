<?php 
class News_model extends CI_Model{
	function __construct() {
        parent::__construct();
   }
public function insert_news($data) {
		$this->load->database();
	    $this->db->insert('sm_news', $data); 
		if ($this->db->affected_rows() > 1) {
			return true;
		} else {
			return false;
		}
	}
function show_news()
	{
		$sql ="select * from sm_news ";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
	
function show_news_limit($limit, $start, $st = NULL)
	{
		$this->db->select('*');
		$this->db->from('sm_news');
		$this->db->where('news_status','1');
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
function show_news_id($id){
		$this->db->select('*');
		$this->db->from('sm_news');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
function news_edit($id, $data){
	
		$this->db->where('id', $id);
		$this->db->update('sm_news',$data);
	}
function updt($stat,$id){
	 
		$sql ="update sm_news set news_status=$stat where id=$id ";
		$query = $this->db->query($sql);
		//return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function show_newslist()
	{
		$sql ="select * from sm_news";
		$query = $this->db->query($sql);
		return($query->num_rows() > 0) ? $query->result(): NULL;
	}
function delete_news($id,$news_image){
		$this->db->where('id', $id);
		unlink("news/".$news_image);
		$this->db->delete('sm_news');	
		}
function delete_mul($ids)//Delete Multiple News
		{
			$ids = $ids;
			$count = 0;
			foreach ($ids as $id){
			$did = intval($id).'<br>';
			$this->db->where('id', $did);
			unlink("news/".$news_image);
			$this->db->delete('sm_news');  
			$count = $count+1;
			}
			
			echo'<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
			'.$count.' Item deleted successfully
			</div>';
			$count = 0;		
		}
	}
?>