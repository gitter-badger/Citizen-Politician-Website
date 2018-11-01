<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."/models/NewsFeed.php";

class Profile_model extends NewsFeed {
	public function index($user){
		$profile_info=$this->get_head($user);
		$profile_info.="<div class='p-3'><ul class='nav nav-tabs'><li class='nav-item'><a data-toggle='tab' class='active nav-link' href='#news'>News_Feed</a></li>".$this->check_usertype($user)."<li class='nav-item'><a href='#photos' class='nav-link' data-toggle='tab'>Photos</a></li></ul><div class='tab-content mt-3 mb-5'><div class='tab-pane active' id='news'>";
		$profile_info.=$this->get_recent_activity($user);
		$profile_info.="</div><div class='tab-pane fade' id='profile'>".$this->get_politician($user);
		$profile_info.="</div></div>";
		return $profile_info;
	}

	private function get_politician($user){
		if($this->get_type($user)!=='politician') return "";
		$this->load->model("accounts");
		$data=$this->accounts->get_politician_info($user);
		if(isset($data)){
			$verified=($data->emailVerified==='1') ? "<a href='mailto: $data->email' class='text-success fas fa-check'> Verified</a>":"";
			$account=($data->accountVerified==='1') ? "<a class='text-success fas fa-check'> Verified</a>":"<a class='text-danger fas fa-times'> Not Verified</a>";
			$vying=($data->Vying==='1') ? "Yes":"No";
			return "<div><ul class='nav nav-tabs'><li class='nav-item'><a class='nav-link active' href='#basic' data-toggle='tab'>Basic Information</a></li><li class='nav-item'><a class='nav-link' data-toggle='tab' href='#political'>Political Information</a></li><li class='nav-item'><a class='nav-link' href='#educational' data-toggle='tab'>Educational Background</a></li></ul>
				<div class='tab-content mt-3 mb-4'>
					<div class='tab-pane active' id='basic'>
						<div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-user'></i> Username: </b> <span>$data->userName</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-envelope'></i> Email: </b> <span>$data->email <span style='font-size:14px'>$verified</span></span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-transgender'></i> Gender: </b> <span>$data->gender</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px' class='mr-5'><b><i class='fas fa-globe-africa'></i> County: </b> <span>$data->County</span></div><div style='font-size:20px' class='mr-5'><b><i class='fas fa-globe-africa'></i> Constituency: </b> <span>$data->constituency</span></div><div style='font-size:20px'><b><i class='fas fa-globe-africa'></i> Ward: </b> <span>$data->Ward</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-user-clock'></i> Creation Date: </b> <span>".date_format(date_create($data->CreationDate),"F d,Y h:i a")."</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-user-circle'></i> Account: </b> <span style='font-size:14px'>$account</span></div>
						</div>
					</div>
					<div class='tab-pane fade' id='political'>
						<div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-user'></i> Full Names: </b> <span>$data->FullNames</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-calendar-alt'></i> Date of Birth: </b> <span>".date_format(date_create($data->DateOfBirth),"F d, Y")."</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='far fa-id-card'></i> Political Seat: </b> <span>$data->PoliticalSeat</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='far fa-clock'></i> Political Years: </b> <span>$data->PoliticalYears</span></div></div><div class='media border p-3 mb-3 bg-light' style='border-color:red !important'><div style='font-size:20px'><b> Participation in next election: </b> <span>$vying</span></div></div>
					</div>
					<div class='tab-pane fade' id='educational'>
						<div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-user-graduate'></i> Primary School Grade: </b> <span>$data->primaryGrade</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-user-graduate'></i> Secondary School Grade: </b> <span>$data->secondaryGrade</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-user-graduate'></i> Bachelor's Degree: </b> <span>$data->bachelors</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-graduation-cap'></i> Master's Course: </b> <span>$data->mastersCourse</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-graduation-cap'></i> PhD Course: </b> <span>$data->phdCourse</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-book-open'></i> Primary School: </b> <span>$data->primarySchool</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-book-reader'></i> Secondary School: </b> <span>$data->secondarySchool</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-school'></i> Bachelor's University: </b> <span>$data->university</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-school'></i> Master's School: </b> <span>$data->masters</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-school'></i> PhD School: </b> <span>$data->phd</span></div></div><div class='media border p-3 mb-3'><div style='font-size:20px'><b><i class='fas fa-chalkboard-teacher'></i> Other Courses: </b> <span>$data->otherCourses</span></div></div>
						</div>
					<div></div>";
		}
		return "<div>No data to display</div>";
	}

	private function check_usertype($user){
		return ($this->get_type($user)==='politician') ? "<li class='nav-item'><a data-toggle='tab' href='#profile' class='nav-link'>Profile Info</a></li>":"";
	}

	private function get_type($user){
		return $this->db->query("select UserName,Email,verifyEmail,phone,verifyPhone,gender,type,counties.County,photo from citizen_profile left join counties on CountyID=citizen_profile.County where UserName=? union all select userName,email,emailVerified,phone,phoneVerified,gender,accountType,countyNo,photo from politician_profile left join counties on CountyID=countyNo where userName=?",array($user,$user))->row()->type;
	}

	private function get_head($user){
		$return="";
		if(empty($this->get_account_db($user))) show_404();
		foreach ($this->get_account_db($user) as $value) {
			if(stripos($value->photo,"https")===false){
				$value->photo=base_url()."resources/$value->photo";
			}
			$return.="<div class='p-0'><div class='d-flex align-items-end' style='width: 100%;height: 240px;background-color:rgba(".random_int(0,255).",".random_int(0,255).",".random_int(0,255).",0.6)'><img width='100px' height='100px' class='rounded-0 mr-3' style='width: 100px;height: 100px;background-color: rgba(0,0,0,0.5)' src='$value->photo'><h5>$value->UserName</h5><h5 class='ml-auto'>".$this->get_follow($value)."</h5></div><div class='p-2'><span>".$this->activity($value)."</span></div><kbd class='ml-3'>Account Type: $value->type</kbd>".$this->get_settings($user)."</div>".$this->get_main($value);
		}
		return $return;
	}

	private function get_main($value){
		$this->load->model("main");
		return ($value->type==='politician') ? "<div class='container-fluid p-3' style='font-size: 32px;font-family: Cookie,cursive'><div class='text-muted'>Efficiency: ".$this->main->get_efficiency($value->UserName)."%</div><div class='text-muted mr-5'>Popularity: ".$this->main->get_popularity($value->UserName)."%</div></div>":"";
	}

	private function get_settings($user){
		return ($user===$this->session->userdata('username')) ? "<div class='ml-3 mt-2'><a class='text-info' href=''>Change Profile</a></div>":"";
	}

	private function get_recent_activity($user){
		$temp=array();
		$news="<div class='row'><div class='col-xl-8'><table class='table table-borderless' style='width:100%'><thead><tr style='display:none'><td class='table-secondary' style='border-radius:5px;'>All News</td></tr></thead>";
		$this->load->model("newsfeed");
		foreach ($this->newsfeed->get_specific_news("Comments",$user) as $value) {
			$value->news_item="Comments";
			array_push($temp,$value);
		}
		foreach ($this->newsfeed->get_specific_news("Achievements",$user) as $value) {
			$value->news_item="Achievements";
			array_push($temp,$value);
		}
		foreach ($this->newsfeed->get_specific_news("Critiques",$user) as $value) {
			$value->news_item="Critiques";
			array_push($temp,$value);
		}
		for($i=0;$i<sizeof($temp,1);$i++){
			for($j=0;$j<sizeof($temp,1)-$i-1;$j++){
				if($temp[$j]->time<$temp[$j+1]->time){
					$fixer=clone $temp[$j+1];
					$temp[$j+1]=clone $temp[$j];
					$temp[$j]=clone $fixer;
				}
			}
		}
		foreach ($temp as $value) {
			$news.="<tr><td><div class='border'>".$this->newsfeed->get_carousel($value,$value->news_item)."<div class='media p-3'><img src='$value->citiphoto' alt='$value->commentor' class='align-self-start mr-3 rounded-circle' style='width:60px;'><div class='media-body'><h4>$value->commentor <small style='font-size:14px;'><i>Posted on ".date_format(date_create($value->time),'F d,Y h:i a')."</i></small></h4><p><strong>Target: </strong>$value->referring<br>$value->comment</p><p class='row'><span class='mb-3 ml-3 mr-auto col-xs-6 d-flex justify-content-left'>".$this->newsfeed->get_likes($value,$value->news_item)."</span><span class='d-flex justify-content-right col-xs-6'>".$this->newsfeed->get_verify($value->state,$value->news_item)."</span></p>".$this->newsfeed->get_like_count($value,$value->news_item)."<a class='text-info' data-toggle='collapse' href='#".$value->news_item."_".$value->commentID."'>See All Replies . . . </a><div id='".$value->news_item."_".$value->commentID."' class='collapse container'>".implode($this->newsfeed->get_replies($value->news_item,$value->commentID))."</div>".$this->newsfeed->get_reply_box()."</div></div></div></td></tr>";
		}
		$news.="</table></div></div>";
		return $news;
	}

	private function get_account_db($user){
		return $this->db->query("select UserName,Email,verifyEmail,phone,verifyPhone,gender,type,counties.County,photo from citizen_profile left join counties on CountyID=citizen_profile.County where UserName=? union all select userName,email,emailVerified,phone,phoneVerified,gender,accountType,countyNo,photo from politician_profile left join counties on CountyID=countyNo where userName=? and accountVerified=1",array($user,$user))->result();
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