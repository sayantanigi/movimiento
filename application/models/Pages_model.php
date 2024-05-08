<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'cms';
	}

	function getCms($slug){
		$res = $this->db->get_where('cms',array('slug'=>$slug));
		if($res->num_rows()>0){
			return $res->row();
		}
		else{
			return false;
		}
	}

}

/* End of file Pages_model.php */
/* Location: ./application/models/Pages_model.php */