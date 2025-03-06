<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conference_model extends Master_Model {

	public function __construct() {
		parent::__construct();
		$this->table = 'conference';
	}
}

/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */