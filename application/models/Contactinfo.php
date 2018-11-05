<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactinfo extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function add_contact($name,$email,$question){
		$id=$this->db->query("select max(contactID) as num from contact")->row()->num+1;
		return $this->db->query("insert into contact(contactID,name,email,question) values (?,?,?,?)",array($id,$name,$email,$question));
	}

	public function get_faq(){
		return $this->db->query("select * from contact where faq=1 and replied=1")->result();
	}
}
?>