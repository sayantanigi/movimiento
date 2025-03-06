<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial_model extends Master_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = 'testimonials';
	}	

}

/* End of file Testimonial_model.php */
/* Location: ./application/models/Testimonial_model.php */