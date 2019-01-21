<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regions extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	//get all registered countries from the db
	public function get_countries(){
		return $this->db->query("select countryID,country from countries")->result();
	}

	//get all registred counties from the db
	public function get_counties(){
		return $this->db->query("select CountyID,County,countryNo from counties")->result();
	}

	//get all registered constituencies from the db
	public function get_constituencies(){
		return $this->db->query("select constituencyID,constituency,countyNo from constituencies")->result();
	}

	//get all registered wards from the db
	public function get_wards(){
		return $this->db->query("select wardID,Ward,constituencyID from wards")->result();
	}

	//get all supported seats based on some type
	public function get_supported_seats($type='major'){
		return $this->db->query("select seatID,seat from supported_seats where seatType like ?",$type)->result();
	}
}

?>