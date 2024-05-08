<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Maknine_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'mak_zeronine';
	}

}

/* End of file Gallery_model.php */
/* Location: ./application/models/Gallery_model.php */