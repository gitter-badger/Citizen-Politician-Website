<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/Cloudinary/autoload.php";
require_once APPPATH."/third_party/Cloudinary/src/Api.php";
require_once APPPATH."/third_party/Cloudinary/src/Cloudinary.php";
require_once APPPATH."/third_party/Cloudinary/src/Helpers.php";
require_once APPPATH."/third_party/Cloudinary/src/Uploader.php";
class Newsfeed extends CI_Model {
	public function __construct(){
		parent::__construct();
		\Cloudinary::config(array( 
		  "cloud_name" => "dkgtd3pil", 
		  "api_key" => "614412954515959", 
		  "api_secret" => "azKeL5xxqg9BEeC7TGrHsP5fnJM" 
		));
	}
	public function index($news_item){
		$news="";
		$news.=$this->get_post_box($news_item);
		$news.=$this->get_news($news_item);
		return $news;
	}

	public function add_comment($table,$comment,$target,$evidence=""){
		$id=$this->db->query("select max(commentID) as num from $table")->row()->num+1;
		$target_dir= "mwananchi/".strtolower($table)."/$id/";
		if($evidence!==""){
			foreach($_FILES['evidence']['tmp_name'] as $value){
				\Cloudinary\Uploader::upload($value, array("resource_type" => "auto","folder" => $target_dir));
			}
		}
		return ($evidence==="") ? $this->db->query("insert into $table (commentID,comment,commentor,referring) values (?,?,?,?)",array($id,$comment,$this->session->userdata('username'),$target)):$this->db->query("insert into $table (commentID,comment,commentor,referring,evidence) values (?,?,?,?,?)",array($id,$comment,$this->session->userdata('username'),$target,$target_dir));
	}

	public function get_search_news($data,$news_item){
		$news="<table class='table container table-borderless' style='width:100%'><thead><tr style='display:none'><td class='table-secondary' style='border-radius:5px;'>Searched $news_item</td></tr></thead>";
		foreach ($this->get_search_news_db($data,$news_item) as $value) {
			$news.="<tr><td><div class='border'>".$this->get_carousel($value,$news_item)."<div class='media p-3'><img src='$value->citiphoto' alt='$value->commentor' class='align-self-start mr-3 rounded-circle' style='width:60px;'><div class='media-body'><h4>$value->commentor <small style='font-size:14px;'><i>Posted on ".date_format(date_create($value->time),'F d,Y h:i a')."</i></small></h4><p><strong>Target: </strong>$value->referring<br>$value->comment</p><p class='row'><span class='mb-3 ml-3 mr-auto col-xs-6 d-flex justify-content-left'>".$this->get_likes($value,$news_item)."</span><span class='d-flex justify-content-right col-xs-6'>".$this->get_verify($value,$news_item)."</span></p>".$this->get_like_count($value,$news_item)."<a class='text-info' data-toggle='collapse' href='#".$news_item."_".$value->commentID."'>See All Replies . . . </a><div id='".$news_item."_".$value->commentID."' class='collapse container'>".implode($this->get_replies($news_item,$value->commentID))."</div></div></div></div></td></tr>";
		}
		$news.="</table>";
		return $news;
	}

	public function get_specific_news($news_item,$user){
		$get_news=$this->db->query("select ".strtolower($news_item).".*,ifnull(citizen_profile.photo,'isNull') as citiphoto,ifnull(politician_profile.photo,'isNull') as poliphoto from ".strtolower($news_item)." left join citizen_profile on commentor=citizen_profile.UserName left join politician_profile on commentor=politician_profile.userName where state!=0 and reply=0 and commentor=? order by ".strtolower($news_item).".commentID desc",$user)->result();
		foreach ($get_news as $value) {
			if($value->poliphoto==="isNull"&&$value->citiphoto==="isNull"){
				$value->citiphoto=base_url()."resources/anonymous.png";
			}elseif($value->citiphoto==="isNull"){
				$value->citiphoto=$value->poliphoto;
			}
			if(stripos($value->citiphoto,"https")===false){
				$value->citiphoto=base_url()."resources/$value->citiphoto";

			}
		}
		return $get_news;
	}

	private function get_search_news_db($data,$news_item){
		$get_news=$this->db->query("select ".strtolower($news_item).".*,ifnull(citizen_profile.photo,'isNull') as citiphoto,ifnull(politician_profile.photo,'isNull') as poliphoto from ".strtolower($news_item)." left join citizen_profile on commentor=citizen_profile.UserName left join politician_profile on commentor=politician_profile.userName where state!=0 and reply=0 and (comment like ? or commentor like ? or referring like ? or time like ?) order by ".strtolower($news_item).".commentID desc",array($data,$data,$data,$data))->result();
		foreach ($get_news as $value) {
			if($value->poliphoto==="isNull"&&$value->citiphoto==="isNull"){
				$value->citiphoto=base_url()."resources/anonymous.png";
			}elseif($value->citiphoto==="isNull"){
				$value->citiphoto=$value->poliphoto;
			}
			if(stripos($value->citiphoto,"https")===false){
				$value->citiphoto=base_url()."resources/$value->citiphoto";

			}
		}
		return $get_news;
	}

	private function get_news($news_item){
		$news="";
		$news.="<table class='table table-borderless' style='width:100%'><thead><tr style='display:none'><td class='table-secondary' style='border-radius:5px;'>All $news_item</td></tr></thead><tr id='loading_".$news_item."'><td><div class='d-flex justify-content-center'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i><span class='sr-only'>Loading...</span><div></td></tr><script>$('#loading_".$news_item."').hide()</script>";
		foreach ($this->get_news_from_db($news_item) as $value) {
			$news.="<tr><td><div class='border'>".$this->get_carousel($value,$news_item)."<div class='media p-3'><img src='$value->citiphoto' alt='$value->commentor' class='align-self-start mr-3 rounded-circle' style='width:60px;'><div class='media-body'><h4>$value->commentor <small style='font-size:14px;'><i>Posted on ".date_format(date_create($value->time),'F d,Y h:i a')."</i></small></h4><p><strong>Target: </strong>$value->referring<br>$value->comment</p><p class='row'><span class='mb-3 ml-3 mr-auto col-xs-6 d-flex justify-content-left'>".$this->get_likes($value,$news_item)."</span><span class='d-flex justify-content-right col-xs-6'>".$this->get_verify($value,$news_item)."</span></p>".$this->get_like_count($value,$news_item)." <a class='text-info' data-toggle='collapse' href='#".$news_item."_".$value->commentID."'>See All Replies . . . </a><div id='".$news_item."_".$value->commentID."' class='collapse container'>".implode($this->get_replies($news_item,$value->commentID))."</div>".$this->get_reply_box()."</div></div></div></td></tr>";
		}
		$news.="</table>";
		return $news;
	}

	protected function get_carousel($db,$type){
		$return=array();
		if(null!==$this->session->userdata("usertype")){
			if($type==="Comments"){
				return "";
			}
			$api = new \Cloudinary\Api();
			$images=$api->resources(array("type" => "upload", "prefix" => $db->evidence));
			$videos=$api->resources(array("resource_type"=>"video","type" => "upload", "prefix" => $db->evidence));
			array_push($return,"<div id='carousel_".$type."_".$db->commentID."' class='carousel slide mb-3' data-interval='false' data-ride='carousel'><ul class='carousel-indicators'>");
			$counter=0;
			foreach ($images['resources'] as $value) {
				if($counter===0){
					array_push($return,"<li data-target='#carousel_".$type."_".$db->commentID."' data-slide-to='".$counter++."' class='active'></li>");
					continue;
				}
				array_push($return,"<li data-target='#carousel_".$type."_".$db->commentID."' data-slide-to='".$counter++."'></li>");
			}
			foreach ($videos['resources'] as $value) {
				if($counter===0){
					array_push($return,"<li data-target='#carousel_".$type."_".$db->commentID."' data-slide-to='".$counter++."' class='active'></li>");
					continue;
				}
				array_push($return,"<li data-target='#carousel_".$type."_".$db->commentID."' data-slide-to='".$counter++."'></li>");
			}
			array_push($return,"</ul><div class='carousel-inner'>");
			$counter=0;
			foreach ($images['resources'] as $value) {
				$url=$value['secure_url'];
				if($counter===0){
					$counter++;
					array_push($return,"<div class='carousel-item active'><img width='100%' height='300px' style='width: 100%;height: 300px' src='$url' alt='$db->commentor'></div>");
					continue;
				}
				array_push($return,"<div class='carousel-item'><img width='100%' height='300px' style='width: 100%;height: 300px' src='$url' alt='$db->commentor'></div>");
			}
			foreach ($videos['resources'] as $value) {
				$url=$value['secure_url'];
				if($counter===0){
					$counter++;
					array_push($return,"<video class='carousel-item active' width='100%' height='300px' style='width: 100%;height: 300px;background-color: rgba(0,0,0,0.9) !important;' src='$url' controls='' controlsList='nodownload nofullscreen'>$db->commentor</video>");
					continue;
				}
				array_push($return,"<video class='carousel-item' width='100%' height='300px' style='width: 100%;height: 300px;background-color: rgba(0,0,0,0.9) !important;' src='$url' controls='' controlsList='nodownload nofullscreen'>$db->commentor</video>");
			}
			array_push($return,"</div><a class='carousel-control-prev' href='#carousel_".$type."_".$db->commentID."' data-slide='prev'><span class='carousel-control-prev-icon'></span></a><a class='carousel-control-next' href='#carousel_".$type."_".$db->commentID."' data-slide='next'><span class='carousel-control-next-icon'></span></a></div>");
			return implode($return);
		}
		redirect(base_url("home.html"),"location");
	}

	protected function get_likes($type,$news_item){
		if(null!==$this->session->userdata("username")){
			if($this->session->userdata("usertype")==="admin"||$this->session->userdata("usertype")==="politician"){
				if($this->session->userdata("usertype")==="admin"){
					if($news_item!=="Comments"){
						return "";
					}
					if($type->type==="-1"){
						return "<span class='row ml-1 mb-1'><span class='col-xs-6 mr-4'><a onclick='change_type(\"$type->commentID\",1,this)' class='text-success' style='cursor:pointer'> Positive</a></span> <span class='col-xs-6 mr-4'><a onclick='change_type(\"$type->commentID\",0,this)' class='text-danger' style='cursor:pointer'> Negative</a></span></span>";
					}elseif ($type->type==="0") {
						return "<span class='row ml-1 mb-1'><span class='col-xs-6 mr-4'><a class='text-danger'> Negative</a></span></span>";
					}elseif ($type->type==="1") {
						return "<span class='row ml-1 mb-1'><span class='col-xs-6 mr-4'><a class='text-success'> Positive</a></span></span>";
					}
				}
				return "";
			}else if($this->session->userdata("usertype")==="citizen"){
				return "<a onclick='like(\"$type->commentID\",\"$news_item\",-1)' class='text-secondary mr-4'><i class='fas fa-share-alt'></i></a> <a onclick='like(\"$type->commentID\",\"$news_item\",1)' class='mr-4 text-info'><i class='fas fa-thumbs-up'></i> </a> <a onclick='like(\"$type->commentID\",\"$news_item\",0)' class='text-danger'><i class='fas fa-thumbs-up' style='transform:rotate(180deg)'></i></a>";
			}
		}
		redirect(base_url()."home.html","location");
	}

	public function modify_type($id,$type){
		return $this->db->query("update comments set type=? where commentID=?",array($type,$id));
	}

	private function get_liked($news_item,$id,$action){
		if($action==-1) return $this->db->query("select * from analysisdata where type=-1 and analysor=? and analysis=? and parentID=?",array($this->session->userdata('username'),$news_item,$id))->row();
		return $this->db->query("select * from analysisdata where type!=-1 and analysor=? and analysis=? and parentID=?",array($this->session->userdata('username'),$news_item,$id))->row();
	}

	protected function get_like_count($value,$news_item){
		$like_count=$this->db->query("select count(type) as num from analysisdata where analysis=? and parentID=? and (type=1 or type=0)",array($news_item,$value->commentID))->row();
		$share_count=$this->db->query("select count(type) as num from analysisdata where analysis=? and parentID=? and type=-1",array($news_item,$value->commentID))->row();
		return "<div class='row d-flex mb-3'><div class='col-sm-6'><i class='fa fa-heart mr-3 text-danger'></i><span class='badge badge-info' id='likes_".$news_item."_$value->commentID'>$like_count->num</span></div><div class='col-sm-6'><i class='fas fa-share mr-3 text-muted'></i><span class='badge badge-info' id='shares_".$news_item."_$value->commentID'>$share_count->num</span></div></div>";
	}

	public function like($news_item,$parentID,$action){
		$id=$this->db->query("select max(analysisID) as id from analysisdata")->row()->id+1;
		return ($this->get_liked($news_item,$parentID,$action)) ? false:$this->db->query("insert into analysisdata(analysisID,analysis,type,parentID,analysor) values (?,?,?,?,?)",array($id,$news_item,$action,$parentID,$this->session->userdata('username')));
	}

	protected function get_verify($verified,$news_item){
		if(null!==$this->session->userdata("username")){
			if($this->session->userdata("usertype")==="citizen"||$this->session->userdata("usertype")==="politician"){
				return ($verified->state==='1'&&$news_item!=="Comments")? "<span class='row ml-3'><span class='col mr-4'><a class='text-success fas fa-check'> Verified</a></span></span>":"";
			}else if($this->session->userdata("usertype")==="admin"){
				return ($verified->state==='-1')?"<span class='row ml-3'><span class='col-xs-6 mr-4'><a onclick='verify(\"$verified->commentID\",\"$news_item\",1,this)' class='text-success fas fa-check' style='cursor:pointer'> Verify</a></span> <span class='col-xs-6 mr-4'><a class='text-danger fas fa-times' onclick='verify(\"$verified->commentID\",\"$news_item\",0,this)' style='cursor:pointer'> Deny</a></span></span>":"<span class='row ml-3'><span class='col mr-4'><a class='text-success fas fa-check' style='cursor:pointer' disabled=''> Verified</a></span></span>";
			}
		}
		redirect(base_url("home.html"),"location");
	}

	public function verify_post($id,$table,$verify){
		return $this->db->query("update ".strtolower($table)." set state=? where commentID=?",array($verify,$id));
	}

	protected function get_replies($news_item,$id){
		$replies=array();
		foreach ($this->get_replies_from_db($news_item,$id) as $value) {
			array_push($replies,"<div class='media mt-3 mb-3'><img src='$value->citiphoto' alt='$value->commentor' class='align-self-start mr-3 rounded-circle' style='width:45px;'><div class='media-body'><h4>$value->commentor <small style='font-size:14px;'><i>Replied on ".date_format(date_create($value->time),'F d,Y h:i a')."</i></small></h4><p>$value->comment</p></div></div>");
		}
		if(sizeof($replies,1)<1){
			array_push($replies,"No data to display here.");
		}
		return $replies;
	}

	private function get_news_from_db($news_item){
		$get_news=$this->db->query("select ".strtolower($news_item).".*,ifnull(citizen_profile.photo,'isNull') as citiphoto,ifnull(politician_profile.photo,'isNull') as poliphoto from ".strtolower($news_item)." left join citizen_profile on commentor=citizen_profile.UserName left join politician_profile on commentor=politician_profile.userName where state!=0 and reply=0 order by ".strtolower($news_item).".commentID desc")->result();
		foreach ($get_news as $value) {
			if($value->poliphoto==="isNull"&&$value->citiphoto==="isNull"){
				$value->citiphoto=base_url()."resources/anonymous.png";
			}elseif($value->citiphoto==="isNull"){
				$value->citiphoto=$value->poliphoto;
			}
			if(stripos($value->citiphoto,"https")===false){
				$value->citiphoto=base_url()."resources/$value->citiphoto";

			}
		}
		return $get_news;
	}

	private function get_replies_from_db($news_item,$id){
		$get_news=$this->db->query("select ".strtolower($news_item).".*,ifnull(citizen_profile.photo,'isNull') as citiphoto from ".strtolower($news_item)." left join citizen_profile on commentor=citizen_profile.UserName where state!=0 and reply=1 and replyID=? order by ".strtolower($news_item).".commentID asc",$id)->result();
		foreach ($get_news as $value) {
			if($value->citiphoto==="isNull"){
				$value->citiphoto=base_url()."resources/anonymous.png";
			}
			if(stripos($value->citiphoto,"https")===false){
				$value->citiphoto=base_url()."resources/$value->citiphoto";

			}
		}
		return $get_news;
	}

	protected function get_reply_box(){
		if(null!==$this->session->userdata("username")){
			if($this->session->userdata("usertype")==="admin"||$this->session->userdata("usertype")==="politician"){
				return "";
			}elseif($this->session->userdata("usertype")==="citizen"){
				return "<form class='mt-4'><div class='input-group' style='border:1px solid rgba(0,0,0,0.2);border-radius:5px'><textarea class='form-control bg-light' rows='2' name='reply' placeholder='Reply . . .' style='resize:none;border:none;' required=''></textarea><button type='submit' class='input-group-append btn btn-light'><i class='fas fa-reply text-secondary'></i></button></div></form>";
			}

		}
		redirect(base_url()."home.html","location");
	}

	private function get_post_box($type){
		if(null!==$this->session->userdata("username")){
			if($this->session->userdata("usertype")==="admin"||($this->session->userdata("usertype")==="politician"&&$type==="Comments")){
				return "";
			}else{
				if(($this->session->userdata("usertype")==="politician"&&$type!=="Comments")||$this->session->userdata("usertype")==="citizen"){
					$photos=($type==="Comments")?"":"<div class='input-group-append'><span style='border-bottom-left-radius: 0;border-bottom-right-radius: 0;' class='input-group-text'><i class='fas fa-images align-self-center' style='cursor:pointer' onclick='$(this).parent().find(\"input\").trigger(\"click\")'></i><input type='file' name='evidence' multiple='' style='display:none'></span></div>";
					return "<hr><form enctype='multipart/form-data' onsubmit='event.preventDefault();post_data(\"$type\",event);' class='mb-4'><div class='form-group mb-0' style='border-radius: 4px !important;box-shadow: 0px 0px 12px rgba(0,0,0,0.5);'><div class='input-group'><div class='input-group-prepend'><div style='border-bottom-left-radius: 0;' class='input-group-text'>@</div></div><input onkeyup='check(this)' placeholder='Target . . . ' required='' style='border-bottom-left-radius: 0;border-bottom-right-radius: 0;' name='target' type='text' class='form-control'><div class='input-group-append'><span style='border-bottom-right-radius: 0;' class='input-group-text fa'></span></div>$photos</div><textarea class='form-control' rows='2' style='border-radius: 0;width: 100%;border-top: none;' name='comment' placeholder='Post $type . . . ' required=''></textarea><div class='alert alert-secondary mb-0' style='border-top-left-radius: 0;border-top-right-radius: 0;padding: 0px;'><div class='d-flex justify-content-between align-items-center'><span class='text-muted p-2' style='font-family: Cookie,cursive;'><i class='fa fa-user'></i> Mwananchi</span><button type='submit' class='btn btn-info rounded-0'  style='width: 70px;border-bottom-right-radius: 3px !important;'>Post</button></div></div></div></form><hr><script>function check(event){ var temp=$(event).val().trim();if(temp.length===0){ $(event).parents().find('span.fa').removeClass('fa-check').removeClass('fa-times');return;}$.post('".site_url('news_feed/check')."',{target:temp},data=>{ if(data){ $(event).parent().find('span.fa').removeClass('fa-times').addClass('fa-check').css({color:'limegreen'});}else{ $(event).parent().find('span.fa').removeClass('fa-check').addClass('fa-times').css({color:'indianred'});}},'json')}</script>";
				}
			}

		}
		redirect(base_url()."home.html","location");
	}
}
?>