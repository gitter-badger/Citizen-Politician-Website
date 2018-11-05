<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regions extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function get_counties(){
		return $this->db->select("CountyID,County")->from("counties")->get()->result();
	}
}

?>