<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->model('activity');
	}

	public function get_popularity($username){
		$followers=$this->activity->get_followers($username);
		$total_users=$this->db->query('select count(*) as num from citizen_profile')->row()->num;
		$likes=$this->get_likes($username);
		$total_analysis=$this->get_total_analysis($username);
		$followers_ratio=($total_users>0) ? (float)$followers/(float)$total_users:0;
		$likes_ratio=($total_analysis>0) ? (float)$likes/(float)$total_analysis:0;
		return round(($followers_ratio+$likes_ratio)*100,2);
	}

	public function get_efficiency($username){
		return ($this->get_all($username)>0) ? round((float)$this->get_achievements($username)/(float)$this->get_all($username)*100,2):0;
	}

	private function get_likes($username){
		$achievement_likes=$this->db->query('select count(*) as num from analysisdata left join achievements on commentID=parentID where referring=? and analysisdata.type=1 and reply=0 and state=1',$username)->row()->num;
		$critique_dislike=$this->db->query('select count(*) as num from analysisdata left join critiques on commentID=parentID where referring=? and analysisdata.type=0 and reply=0 and state=1',$username)->row()->num;
		$positive_comment_like=$this->db->query('select count(*) as num from analysisdata left join comments on commentID=parentID where referring=? and analysisdata.type=1 and comments.type=1 and reply=0 and state=1',$username)->row()->num;
		$negative_comment_dislike=$this->db->query('select count(*) as num from analysisdata left join comments on commentID=parentID where referring=? and analysisdata.type=0 and comments.type=0 and reply=0 and state=1',$username)->row()->num;
		return $achievement_likes+$critique_dislike+$positive_comment_like+$negative_comment_dislike;
	}

	private function get_total_analysis($username){
		$achievement_likes=$this->db->query('select count(*) as num from analysisdata left join achievements on commentID=parentID where referring=? and analysisdata.type!=-1 and reply=0 and state=1',$username)->row()->num;
		$critique_dislike=$this->db->query('select count(*) as num from analysisdata left join critiques on commentID=parentID where referring=? and analysisdata.type!=-1 and reply=0 and state=1',$username)->row()->num;
		$comment_total=$this->db->query('select count(*) as num from analysisdata left join comments on commentID=parentID where referring=? and analysisdata.type!=-1 and comments.type!=-1 and reply=0 and state=1',$username)->row()->num;
		return $achievement_likes+$critique_dislike+$comment_total;
	}

	private function get_achievements($username){
		return $this->db->query("select count(*) as num from achievements where referring=? and state=1 and reply=0",$username)->row()->num;
	}

	private function get_all($username){
		$achievements = $this->db->query("select count(*) as num from achievements where referring=? and state=1 and reply=0",$username)->row()->num;
		$critiques = $this->db->query("select count(*) as num from critiques where referring=? and state=1 and reply=0",$username)->row()->num;
		return $achievements+$critiques;
	}
}
?>