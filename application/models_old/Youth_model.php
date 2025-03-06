<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Youth_model extends Master_Model {

	public function __construct() {
		parent::__construct();
		$this->table = 'youth_activity';
	}
}

/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */