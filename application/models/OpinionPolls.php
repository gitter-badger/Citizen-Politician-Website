<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OpinionPolls extends CI_Model {
	public function index(){
		return $this->db->query("select * from opinionpolls")->result();
	}

	public function get_potw(){
		$potw=$this->get_potw_from_db();
		if($this->session->userdata("usertype")===null){
			redirect(base_url("home.html"));
		}
		if($this->session->userdata("usertype")==="citizen"){
			if(date("oW",strtotime($potw->time))!==date("oW",strtotime(date("Y-m-d h:i:s")))) {
				return "<div class='jumbotron'><span class='text-success' style='font-size: 24px'>Poll Of The Week</span><br><p>No Poll This Week</p></div>";
			}
		}
		return "";
	}

	private function get_potw_from_db(){
		return $this->db->query("select * from opinionpolls where potw=1 order by pollID desc")->row();
	}
}
?>