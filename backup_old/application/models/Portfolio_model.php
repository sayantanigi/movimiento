<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Portfolio_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'portfolio';
	}

}

/* End of file Portfolio_model.php */
/* Location: ./application/models/Portfolio_model.php */