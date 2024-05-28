<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'cms';
	}

	function getPage($slug){
		return $this -> db -> get_where($this -> table, array('slug' => $slug)) -> row();
	}

}

/* End of file Cms_model.php */
/* Location: ./application/models/Cms_model.php */