<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Thematiques_model extends Master_Model {

	public function __construct() {
		parent::__construct();
		$this->table = 'thematiques';
	}
}

/* End of file Gallery_model.php */
/* Location: ./application/models/Gallery_model.php */