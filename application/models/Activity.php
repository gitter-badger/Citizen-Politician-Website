<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Model {

	public function get_activity_count_html(){
		if(null!==$this->session->userdata("username")){
			if($this->session->userdata("usertype")==="admin"){
				return "";
			}elseif($this->session->userdata("usertype")==="citizen"){
				return "<ul class='list-group w-75 ml-auto mr-auto' style='overflow-x: auto;'><li class='list-group-item list-group-item-secondary d-flex justify-content-between align-items-center'><div>Activity</div> <i class='fab fa-hotjar'></i></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Shares</strong> <span class='badge badge-info ml-auto' id='shares'>".$this->get_shares($this->session->userdata("username"))."</span></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Likes</strong> <span class='badge badge-info ml-auto' id='likes'>".$this->get_likes($this->session->userdata("username"))."</span></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Posts</strong> <span class='badge badge-info ml-auto' id='posts'>".$this->get_posts($this->session->userdata("username"))."</span></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Following</strong> <span class='badge badge-info ml-auto' id='following'>".$this->get_following($this->session->userdata("username"))."</span></li></ul><hr><hr>";
			}elseif($this->session->userdata("usertype")==="politician"){
				return "<ul class='list-group w-75 ml-auto mr-auto' style='overflow-x: auto;'><li class='list-group-item list-group-item-secondary d-flex justify-content-between align-items-center'><div>Activity</div> <i class='fab fa-hotjar'></i></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Posts</strong> <span class='badge badge-info ml-auto' id='posts'>".$this->get_posts($this->session->userdata("username"))."</span></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Followers</strong> <span class='badge badge-info ml-auto'>".$this->get_followers($this->session->userdata("username"))."</span></li></ul><hr><hr>";
			}
		}
		redirect(base_url()."home.html","location");
	}

	public function get_activity_count($data){
		if(is_object($data)){
			if($data->type==="admin"){
				return "";
			}elseif($data->type==="citizen"){
				return "<ul class='nav nav-tabs p-2 row ml-1 mr-1'><span class='row col-xs'><li class='col-xs nav-item mr-5 d-flex align-items-center'><strong class='mr-2'>Shares</strong> <span class='badge badge-info ml-auto'>".$this->get_shares($data->UserName)."</span></li><li class=' col-xs mr-5 d-flex nav-item align-items-center'><strong class='mr-2'>Likes</strong> <span class='badge badge-info ml-auto'>".$this->get_likes($data->UserName)."</span></li><li class='col-xs d-flex nav-item mr-5 align-items-center'><strong class='mr-2'>Posts</strong> <span class='badge badge-info ml-auto'>".$this->get_posts($data->UserName)."</span></li><li class='col-xs nav-item mr-5 d-flex align-items-center'><strong class='mr-2'>Following</strong> <span class='badge badge-info ml-auto'>".$this->get_following($data->UserName)."</span></li></span><li class='col-xs ml-auto nav-item text-muted' style='font-family: Cookie,cursive;'><i class='fas fa-user'></i> Mwananchi</li></ul>";
			}elseif($data->type==="politician"){
				return "<ul class='nav nav-tabs p-2 row ml-1 mr-1'><span class='row col-xs'><li class='col-xs nav-item mr-5 d-flex align-items-center'><strong class='mr-2'>Posts</strong> <span class='badge badge-info ml-auto'>".$this->get_posts($data->UserName)."</span></li><li class='col-xs nav-item mr-5 d-flex align-items-center'><strong class='mr-2'>Followers</strong> <span class='badge badge-info ml-auto' id='followers_".$data->UserName."'>".$this->get_followers($data->UserName)."</span></li></span><li class='col-xs nav-item ml-auto text-muted' style='font-family: Cookie,cursive;'><i class='fas fa-user'></i> Mwananchi</li></ul>";
			}
		}
		redirect(base_url()."home.html","location");
	}

	private function get_likes($user){
		return $this->db->query("select count(*) as num from analysisdata where type!=-1 and analysor=?",$user)->row()->num;
	}

	private function get_shares($user){
		return $this->db->query("select count(*) as num from analysisdata where type=-1 and analysor=?",$user)->row()->num;
	}

	private function get_posts($user){
		$posts=0;
		$data=$this->db->query("select count(*) as num from comments where commentor=? and reply=0 union all select count(*) as num from achievements where commentor=? and reply=0 union all select count(*) as num from critiques where commentor=? and reply=0",array($user,$user,$user))->result();
		foreach ($data as $value) {
			$posts+=$value->num;
		}
		return $posts;
	}

	public function get_following($data){
		return $this->db->query("select count(*) as num from likes where liker=?",$data)->row()->num;
	}

	public function get_followers($data){
		return $this->db->query("select count(*) as num from likes where liked=?",$data)->row()->num;
	}

	public function follow($liker,$liked){
		$id=$this->db->query("select max(likeID) as num from likes")->row()->num+1;
		return $this->db->query("insert into likes(likeID,liker,liked) values (?,?,?)",array($id,$liker,$liked));
	}

	public function unfollow($liker,$liked){
		return $this->db->query("delete from likes where liker=? and liked=?",array($liker,$liked));
	}

	public function check_follow($data){
		return $this->db->query("select count(*) as num from likes where liker=? and liked=?",array($this->session->userdata('username'),$data))->row()->num;
	}
}
?>