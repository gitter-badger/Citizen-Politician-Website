<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regions extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function get_counties(){
		return $this->db->query("select CountyID,County,countryNo from counties")->result();
	}

	public function get_countries(){
		return $this->db->query("select countryID,country from countries")->result();
	}
}

?>