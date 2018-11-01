<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polifunctions extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function get_governor(){
		return $this->db->query("select * from functions where politician=?",'governor')->result();
	}

	public function get_women(){
		return $this->db->query("select * from functions where politician=?",'wrep')->result();
	}

	public function get_mp(){
		return $this->db->query("select * from functions where politician=?",'mp')->result();
	}

	public function get_senator(){
		return $this->db->query("select * from functions where politician=?",'senate')->result();
	}

	public function get_mca(){
		return $this->db->query("select * from functions where politician=?",'mca')->result();
	}
}
?>