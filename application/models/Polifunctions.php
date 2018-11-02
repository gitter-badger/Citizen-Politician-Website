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

	public function remove_function($id){
		return $this->db->query("delete from functions where functionID=?",$id);
	}

	public function edit_function($id,$function,$topic){
		return $this->db->query("update functions set Roles=? and Explanation=? where functionID=?",array($topic,$function,$id));
	}

	public function add_function($politician,$function,$topic){
		$id=$this->db->query("select max(functionID) as num from functions")->row()->num+1;
		return $this->db->query("insert into functions (functionID,Politician,Roles,Explanation) values(?,?,?,?)",array($id,$politician,$topic,$function));
	}
}
?>