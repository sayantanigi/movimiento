<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'courses';
		$this->table3 = 'course_enrollment';
	}

}

/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */