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
			$br=($potw->type==="") ? "<br>":"";
			if(date("oW",strtotime($potw->time))!==date("oW",strtotime(date("Y-m-d h:i:s")))) {
				return "<div class='jumbotron'><span class='text-success' style='font-size: 24px'>Poll Of The Week</span><br><p>No Poll This Week</p><a class='text-info' data-toggle='modal' href='#otherpolls'><i class='fas fa-poll'></i> Other Polls.</a></div>".$this->get_other_polls();
			}else{
				return "<div class='jumbotron'><span class='text-success' style='font-size: 24px'>Poll Of The Week</span><br><b>$potw->poll</b><span id='potw_$potw->pollID'>$potw->type</span> $br<a class='text-info'data-toggle='modal' href='#otherpolls'><i class='fas fa-poll'></i> Other Polls.</a></div>".$this->get_other_polls($potw->pollID);
			}
		}
		return "";
	}

	private function get_other_polls($db=-1){
		$return="<div class='modal fade' id='otherpolls'><div class='modal-dialog' style='min-width:70%;overflow-y: initial !important'><div class='modal-content p-4' ><div class='modal-header'><h4 class='modal-title'>Poll Up</h4><button type='button' class='close' data-dismiss='modal'>&times;</button></div><div class='modal-body p-3' style='height: 500px;overflow-y: auto'>";
		$data="";
		foreach ($this->get_other_polls_db($db) as $value) {
			$data.="<div class='border mb-3 p-3 row'><b class='col-lg-6 mb-3'>$value->poll</b><div class='col-lg-6' id='other_polls_$value->pollID'>".str_replace('margin-left:-1.5em;margin-right:-1.5em','margin-left:0em;margin-right:0em', $value->type)."</div></div>";
		}
		return ($data==="") ? "$return No Data to display here</div></div></div></div>":"$return $data </div></div></div></div>";
	}

	private function get_other_polls_db($db){
		$polls= $this->db->query("select * from opinionpolls where pollID!=? order by pollID desc",$db)->result();
		foreach ($polls as $value) {
			$value=$this->modify_type($value);
		}
		return $polls;
	}

	public function get_after_answer($id){
		return $this->modify_type($this->db->query("select * from opinionpolls where pollID=? order by pollID desc",$id)->row())->type;
	}

	private function check_answered($id){
		$data=$this->db->query("select * from pollanswers where postID=? and answerer=?",array($id,$this->session->userdata('username')))->row();
		return is_object($data);
	}

	private function get_potw_from_db(){
		return $this->modify_type($this->db->query("select * from opinionpolls where potw=1 order by pollID desc")->row());
	}

	public function modify_type($potw){
		if($potw->type==='Yes/No'){
			$potw->type="<div class='mb-3'><a class='text-light' onclick='answerPoll(event)'><kbd class='mr-3 bg-success' style='text-align:center;'>Yes</kbd></a><a class='text-light' onclick='answerPoll(event)'><kbd class='mr-3 bg-danger' style='text-align:center;'>No</kbd></a></div>";
		}elseif($potw->type==='Good/Bad'){
			$potw->type="<div class='row mb-3 ml-1'><a class='col-xs text-light mb-1' onclick='answerPoll(event)'><kbd class='mr-3 bg-success' style='text-align:center;'>V.Good</kbd></a><a class='col-xs text-light mb-1' onclick='answerPoll(event)'><kbd class='mr-3 bg-secondary' style='text-align:center;'>Good</kbd></a><a class='col-xs text-light mb-1' onclick='answerPoll(event)'><kbd class='mr-3 bg-warning' style='text-align:center;'>Bad</kbd></a><a class='col-xs text-light mb-1' onclick='answerPoll(event)'><kbd class='mr-3 bg-danger' style='text-align:center;'>V.Bad</kbd></a></div>";
		}elseif($potw->type==='Likely/Unlikely'){
			$potw->type="<div class='row mb-3' style='font-size: 14px;margin-left:-1.5em;margin-right:-1.5em'><a class='col-xs text-light mb-1' onclick='answerPoll(event)'><kbd class='mr-1 bg-success' style='text-align:center;'>V.Likely</kbd></a><a class='col-xs text-light mb-1' onclick='answerPoll(event)'><kbd class='mr-1 bg-secondary' style='text-align:center;'>Likely</kbd></a><a class='col-xs text-light mb-1' onclick='answerPoll(event)'><kbd class='mr-1 bg-warning' style='text-align:center;'>Unlikely</kbd></a><a class='col-xs text-light mb-1' onclick='answerPoll(event)'><kbd class='mr-1 bg-danger' style='text-align:center;'>V.Unlikely</kbd></a></div>";
		}elseif($potw->type==='Percentage'){
			$potw->type="<div class='d-flex mb-3 mt-1 mr-4'><label for='customRange'></label><input type='range' onmouseup='$(this).popover(\"dispose\");answerPoll(event)' class='custom-range' id='customRange' name='percent' value=0 data-toggle='popover' data-html='true' data-placement='right' data-trigger='focus' data-content='<b id=\"popover\"></b>' onfocus='$(\"#popover\").text($(this).val());' oninput='$(\"#popover\").text($(this).val());'></div><script> $('[data-toggle=\"popover\"]').popover()</script>";
		}else{
			$potw->type="<div class='input-group d-flex mb-3' style='border:1px solid rgba(0,0,0,0.2);border-radius:5px'><textarea class='form-control bg-light' rows='2' name='reply' placeholder='Reply . . .' style='resize:none;border:none;' required=''></textarea><button onclick='answerPoll(event)' class='input-group-append btn btn-light'><i class='fas fa-reply text-secondary'></i></button></div>";
		}
		if($this->check_answered($potw->pollID)){
			$potw->type=$this->poll_life($potw->pollID);
		}
		return $potw;
	}

	public function check_potw(){
		return (date("oW",strtotime($this->get_potw_from_db()->time))===date("oW",strtotime(date("Y-m-d h:i:s"))));
	}

	public function add_poll($poll,$type,$poller,$potw=0){
		$pollID=$this->db->query("select max(pollID) as maxID from opinionpolls")->row()->maxID+1;
		return $this->db->query("insert into opinionpolls(pollID,poll,type,poller,potw) values (?,?,?,?,?)",array($pollID,$poll,$type,$poller,$potw));
	}

	public function answer_poll($postID,$answer,$answerer){
		$pollID=$this->db->query("select max(answerID) as pollID from pollanswers")->row()->pollID+1;
		return $this->db->query("insert into pollanswers (answerID,postID,answerer,answer) values (?,?,?,?)",array($pollID,$postID,$answerer,$answer));
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
		$db=$this->db->query("select DISTINCT answer,count(answer) as data from pollanswers left join opinionpolls on postID=pollID where postID=? and type!='Words' and type!='Percentage' group by answer",$id)->result();
		$total=$this->db->query("select count(answer) as data from pollanswers left join opinionpolls on postID=pollID where postID=?",$id)->row();
		$return="<div class='d-inline-flex p-1'>";
		foreach ($db as $value) {
			$return.="<kbd class='mr-3 bg-secondary' style='text-align:center;text-transform:capitalize;'>$value->answer: $value->data</kbd>";
		}
		$return.="<kbd class='mr-3 bg-info' style='text-align:center;text-transform:capitalize;'>Total: $total->data</kbd></div>";
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
		$return=($return==="") ?  "No Data to display here":$return;
		return $return;
	}

	private function get_replies_db($id){
		return $this->db->query("select answerer,answer,time,ifnull(photo,'".base_url("resources/anonymous.png")."') as photo from pollanswers left join citizen_profile on answerer=UserName where postID=?",$id)->result();
	}
}
?>