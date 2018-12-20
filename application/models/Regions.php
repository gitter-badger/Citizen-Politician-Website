<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regions extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	//get all registred counties from the db
	public function get_counties(){
		return $this->db->query("select CountyID,County,countryNo from counties")->result();
	}

	//get all registered countries from the db
	public function get_countries(){
		return $this->db->query("select countryID,country from countries")->result();
	}
}

?>