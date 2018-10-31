<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_Model extends CI_Model {
	public function index($data,$db){
		$data="%".preg_replace('/[-]/','%',$data)."%";
		if($db==="users"){
			return $this->search_accounts($data);
		}elseif ($db==="Comments"||$db==="Achievements"||$db==="Critiques") {
			$this->load->model("newsfeed");
			return $this->newsfeed->get_search_news($data,$db);
		}elseif($db==="Polls"){
			$this->load->model("opinionpolls");
			return $this->opinionpolls->get_search_polls($data);
		}
	}

	private function search_accounts_db($data){
		return $this->db->query("select UserName,Email,verifyEmail,phone,verifyPhone,gender,type,County,photo from citizen_profile where UserName like ? or Email like ? or Phone like ? or Gender like ? union all select userName,email,emailVerified,phone,phoneVerified,gender,accountType,countyNo,photo from politician_profile where userName like ? or email like ? or phone like ? or gender like ?",array($data,$data,$data,$data,$data,$data,$data,$data))->result();
	}

	private function search_accounts($data){
		$return="<table class='table table-borderless' style='width:100%'><thead><tr style='display:none'><td class='table-secondary' style='border-radius:5px;'>Search Results</td></tr></thead>";
		foreach ($this->search_accounts_db($data) as $value) {
			if(stripos($value->photo,"https")===false){
				$value->photo=base_url()."resources/$value->photo";

			}
			$return.="<tr><td><div class='border p-0 rounded'><div class='d-flex align-items-end' style='width: 100%;height: 100px;background-color:rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).",0.3)'><img width='75px' height='75px' class='rounded rounded-0 mr-3' style='width: 75px;height: 75px;background-color: rgba(0,0,0,0.5)' src='$value->photo'><h5>$value->UserName</h5><h5 class='ml-auto'><button class='btn btn-primary mr-3' onclick='location.assign(\"".site_url("profile/".$value->UserName)."\")'>Profile</button>".$this->get_follow($value)."</h5></div><div class='p-2'><span>".$this->activity($value)."</span><br><b>User Type:</b> $value->type<br><b>Email:</b> $value->Email<br><b>Phone Number:</b> $value->phone</div></div></td></tr>";
		}
		$return.="</table>";
		return $return;
	}

	private function get_follow($data){
		if($this->session->userdata("usertype")===null) redirect(site_url("home"),"location");
		if($data->type==="politician"&&$this->session->userdata("usertype")==="citizen"){
			$this->load->model('activity');
			if($this->activity->check_follow($data->UserName)<1){
				return "<button class='btn btn-success mr-3' id='follow_".$data->UserName."' onclick='follow(this)'>Follow</button>";
			}else{
				return "<button class='btn btn-info mr-3' id='unfollow_".$data->UserName."' onclick='follow(this)'>Unfollow</button>";
			}
		}
		return "";
	}

	private function activity($data){
		$this->load->model("activity");
		return $this->activity->get_activity_count($data);
	}
}
?>