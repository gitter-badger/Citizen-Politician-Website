<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsFeed extends CI_Model {
	public function index($news_item){
		$news="";
		$news.=$this->get_post_box($news_item);
		$news.=$this->get_news($news_item);
		return $news;
	}

	private function get_news($news_item){
		$news="";
		$news.="<table class='table table-borderless' style='width:100%'><thead><tr style='display:none'><td class='table-secondary' style='border-radius:5px;'>All $news_item</td></tr></thead>";
		foreach ($this->get_news_from_db($news_item) as $value) {
			$news.="<tr><td><div class='media border p-3'><img src='$value->citiphoto' alt='$value->commentor' class='align-self-start mr-3 mt-3 rounded-circle' style='width:60px;'><div class='media-body'><h4>$value->commentor <small style='font-size:14px;'><i>Posted on ".date_format(date_create($value->time),'F d,Y h:i a')."</i></small></h4><p>$value->comment</p><p class='row'><span class='mb-3 ml-3 mr-auto col-xs-6 d-flex justify-content-left'>".$this->get_likes($value->type,$news_item)."</span><span class='d-flex justify-content-right col-xs-6'>".$this->get_verify($value->state,$news_item)."</span></p> <a class='text-info' data-toggle='collapse' href='#".$news_item."_".$value->commentID."'>See All Replies . . . </a><div id='".$news_item."_".$value->commentID."' class='collapse container'>".implode($this->get_replies($news_item,$value->commentID))."</div>".$this->get_reply_box()."</div></div></td></tr>";
		}
		$news.="</table>";
		return $news;
	}

	private function get_likes($type,$news_item){
		if(null!==$this->session->userdata("username")){
			if($this->session->userdata("usertype")==="admin"||$this->session->userdata("usertype")==="politician"){
				if($this->session->userdata("usertype")==="admin"){
					if($news_item!=="Comments"){
						return "";
					}
					if($type==="-1"){
						return "<span class='row ml-1 mb-1'><span class='col-xs-6 mr-4'><a href='' class='text-success' style='cursor:pointer'> Positive</a></span> <span class='col-xs-6 mr-4'><a href='' class='text-danger' style='cursor:pointer'> Negative</a></span></span>";
					}elseif ($type==="0") {
						return "<span class='row ml-1 mb-1'><span class='col-xs-6 mr-4'><a class='text-danger'> Negative</a></span></span>";
					}elseif ($type==="1") {
						return "<span class='row ml-1 mb-1'><span class='col-xs-6 mr-4'><a class='text-success'> Positive</a></span></span>";
					}
				}
				return "";
			}else if($this->session->userdata("usertype")==="citizen"){
				return " <a href='' class='text-secondary mr-4'><i class='fas fa-share-alt'></i></a> <a href='' class='mr-4 text-info'><i class='fas fa-thumbs-up'></i> </a> <a href='' class='text-danger'><i class='fas fa-thumbs-up' style='transform:rotate(180deg)'></i></a>";
			}
		}
		redirect(base_url()."home.html","location");
	}

	private function get_verify($verified,$news_item){
		if(null!==$this->session->userdata("username")){
			if($this->session->userdata("usertype")==="citizen"||$this->session->userdata("usertype")==="politician"){
				return ($verified==='1'&&$news_item!=="Comments")? "<span class='row ml-3'><span class='col mr-4'><a class='text-success fas fa-check'> Verified</a></span></span>":"";
			}else if($this->session->userdata("usertype")==="admin"){
				return ($verified==='-1')?"<span class='row ml-3'><span class='col-xs-6 mr-4'><a class='text-success fas fa-check' style='cursor:pointer'> Verify</a></span> <span class='col-xs-6 mr-4'><a class='text-danger fas fa-times' style='cursor:pointer'> Deny</a></span></span>":"<span class='row ml-3'><span class='col mr-4'><a class='text-success fas fa-check' style='cursor:pointer' disabled=''> Verified</a></span></span>";
			}
		}
		redirect(base_url("home.html"),"location");
	}

	private function get_replies($news_item,$id){
		$replies=array();
		foreach ($this->get_replies_from_db($news_item,$id) as $value) {
			array_push($replies,"<div class='media mt-3 mb-3'><img src='$value->citiphoto' alt='$value->commentor' class='align-self-start mr-3 rounded-circle' style='width:45px;'><div class='media-body'><h4>$value->commentor <small style='font-size:14px;'><i>Replied on ".date_format(date_create($value->time),'F d,Y h:i a')."</i></small></h4><p>$value->comment</p>".implode($this->get_replies($news_item,$value->commentID))."</div></div>");
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

	private function get_reply_box(){
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
					return "<hr><form class='mb-4'><div class='form-group mb-0' style='border-radius: 4px !important;box-shadow: 0px 0px 12px rgba(0,0,0,0.5);'><div class='input-group'><div class='input-group-prepend'><div style='border-bottom-left-radius: 0;' class='input-group-text'>@</div></div><input onkeyup='check(this)' placeholder='Target . . . ' required='' style='border-bottom-left-radius: 0;border-bottom-right-radius: 0;' name='target' type='text' class='form-control'><div class='input-group-append'><span style='border-bottom-right-radius: 0;' class='input-group-text fa'></span></div></div><textarea class='form-control' rows='3' style='border-radius: 0;width: 100%;border-top: none;' name='comment' placeholder='Post $type . . . ' required=''></textarea><div class='alert alert-secondary mb-0' style='border-top-left-radius: 0;border-top-right-radius: 0;padding: 0px;'><div class='d-flex justify-content-between align-items-center'><span class='text-muted p-2' style='font-family: Cookie,cursive;'><i class='fa fa-user'></i> Mwananchi</span><button type='submit' class='btn btn-info rounded-0'  style='width: 70px;border-bottom-right-radius: 3px !important;'>Post</button></div></div></div></form><hr><script>function check(event){ var temp=$(event).val().trim();if(temp.length===0){ $(event).parents().find('span.fa').removeClass('fa-check').removeClass('fa-times');return;}$.post('".site_url('news_feed/check')."',{target:temp},data=>{ if(data){ $(event).parents().find('span.fa').removeClass('fa-times').addClass('fa-check').css({color:'limegreen'});}else{ $(event).parents().find('span.fa').removeClass('fa-check').addClass('fa-times').css({color:'indianred'});}},'json')}</script>";
				}
			}

		}
		redirect(base_url()."home.html","location");
	}
}
?>