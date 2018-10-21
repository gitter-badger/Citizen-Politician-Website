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

	public function get_my_polls(){
		$return="";
		foreach($this->get_specific_db($this->session->userdata("username")) as $value){
			$return.= "<tr><td><div class='media border p-3 mb-3'><img src='$value->photo' alt='$value->poller' class='align-self-start mr-3 mt-3 rounded-circle' style='width:60px;'><div class='media-body'><h4>$value->poller <small style='font-size:14px;'><i>Posted on ".date_format(date_create($value->time),'F d,Y h:i a')."</i></small></h4>$value->potw<p>Poll type: $value->type<br>$value->poll</p><a class='text-info' data-toggle='collapse' href='#_$value->pollID'>See All Answers . . . </a><div id='_$value->pollID' class='collapse container'>".$this->poll_life($value->pollID).$this->get_replies($value->pollID)."</div></div></div></td></tr>";
		}
		return $return;
	}

	private function get_specific_db($poller){
		$data=$this->db->query("select opinionpolls.*,ifnull(admin_profile.photo,'isNull') as photo,ifnull(politician_profile.photo,'isNull') as photo1 from opinionpolls left join admin_profile on poller=adminUserName left join politician_profile on poller=userName where poller=? order by pollID desc",$poller)->result();
		foreach ($data as $value) {
			if($value->photo==='isNull'&&$value->photo1==='isNull'){
				$value->photo=base_url("resources/anonymous.png");
			}elseif ($value->photo==='isNull') {
				$value->photo=$value->photo1;
			}
			$value->photo=(stripos($value->photo, 'http')===false) ? base_url("resources/$value->photo") : $value->photo;
			$value->potw=($value->potw==='1') ? "<p class='text-success mb-1'>Poll Of The Week.</p>":"";
		}
		return $data;
	}

	public function get_others_polls(){
		$return="";
		foreach($this->get_specific_others_db($this->session->userdata("username")) as $value){
			$return.= "<tr><td><div class='media border p-3 mb-3'><img src='$value->photo' alt='$value->poller' class='align-self-start mr-3 mt-3 rounded-circle' style='width:60px;'><div class='media-body'><h4>$value->poller <small style='font-size:14px;'><i>Posted on ".date_format(date_create($value->time),'F d,Y h:i a')."</i></small></h4>$value->potw<p>Poll type: $value->type<br>$value->poll</p><a class='text-info' data-toggle='collapse' href='#_$value->pollID'>See All Answers . . . </a><div id='_$value->pollID' class='collapse container'>".$this->poll_life($value->pollID).$this->get_replies($value->pollID)."</div></div></div></td></tr>";
		}
		return $return;
	}

	private function get_specific_others_db($me){
		$data=$this->db->query("select opinionpolls.*,ifnull(admin_profile.photo,'isNull') as photo,ifnull(politician_profile.photo,'isNull') as photo1 from opinionpolls left join admin_profile on poller=adminUserName left join politician_profile on poller=userName where poller!=? order by pollID desc",$me)->result();
		foreach ($data as $value) {
			if($value->photo==='isNull'&&$value->photo1==='isNull'){
				$value->photo=base_url("resources/anonymous.png");
			}elseif ($value->photo==='isNull') {
				$value->photo=$value->photo1;
			}
			$value->photo=(stripos($value->photo, 'http')===false) ? base_url("resources/$value->photo") : $value->photo;
			$value->potw=($value->potw==='1') ? "<p class='text-success mb-1'>Poll Of The Week.</p>":"";
		}
		return $data;
	}

	private function poll_life($id){
		$return="";
		$db=$this->db->query("select DISTINCT answer,count(answer) as data from pollanswers left join opinionpolls on postID=pollID where postID=? and type!='Words' and type!='Percentage' group by answer",$id)->result();
		if(!empty($db)){
			$return.="<div class='container'><div class='d-inline-flex p-3'>";
		}
		foreach ($db as $value) {
			$return.="<kbd class='mr-3 bg-secondary' style='text-align:center;text-transform:capitalize;'>$value->answer: $value->data</kbd>";
		}
		if(!empty($db)){
			$return.="</div></div>";
		}
		return $return;
	}

	private function get_replies($id){
		$return="";
		foreach ($this->get_replies_db($id) as $value) {
			if(stripos($value->photo, 'http')===false){
				$value->photo=base_url("resources/$value->photo");
			}
			$return.="<div class='media p-3'><img src='$value->photo' alt='$value->answerer' class='align-self-start mr-3 mt-3 rounded-circle' style='width:45px;'><div class='media-body'><h4>$value->answerer <small style='font-size:14px;'><i>Answered on ".date_format(date_create($value->time),'F d,Y h:i a')."</i></small></h4><p>$value->answer</p></div></div>";
		}
		return $return;
	}

	private function get_replies_db($id){
		return $this->db->query("select answerer,answer,time,ifnull(photo,'".base_url("resources/anonymous.png")."') as photo from pollanswers left join citizen_profile on answerer=UserName where postID=?",$id)->result();
	}
}
?>