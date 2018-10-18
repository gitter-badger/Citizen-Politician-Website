<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Model {

	public function get_activity_count_html(){
		if(null!==$this->session->userdata("username")){
			if($this->session->userdata("usertype")==="admin"){
				return "";
			}elseif($this->session->userdata("usertype")==="citizen"){
				return "<ul class='list-group w-75 ml-auto mr-auto' style='overflow-x: auto;'><li class='list-group-item list-group-item-secondary d-flex justify-content-between align-items-center'><div>Activity <small>(One Week)</small></div> <i class='fab fa-hotjar'></i></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Shares</strong> <span class='badge badge-info ml-auto'>12</span></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Likes</strong> <span class='badge badge-info ml-auto'>3</span></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Posts</strong> <span class='badge badge-info ml-auto'>7</span></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Following</strong> <span class='badge badge-info ml-auto'>178</span></li></ul><hr><hr>";
			}elseif($this->session->userdata("usertype")==="politician"){
				return "<ul class='list-group w-75 ml-auto mr-auto' style='overflow-x: auto;'><li class='list-group-item list-group-item-secondary d-flex justify-content-between align-items-center'><div>Activity <small>(One Week)</small></div> <i class='fab fa-hotjar'></i></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Posts</strong> <span class='badge badge-info ml-auto'>7</span></li><li class='list-group-item d-flex justify-content-between align-items-center'><strong>Followers</strong> <span class='badge badge-info ml-auto'>178</span></li></ul><hr><hr>";
			}
		}
		redirect(base_url()."home.html","location");
	}

	public function get_activity_count($data){
		if(is_object($data)){
			if($data->type==="admin"){
				return "";
			}elseif($data->type==="citizen"){
				return "<ul class='nav nav-tabs p-2'><li class='nav-item mr-5 d-flex align-items-center'><strong class='mr-2'>Shares</strong> <span class='badge badge-info ml-auto'>12</span></li><li class='mr-5 d-flex nav-item align-items-center'><strong class='mr-2'>Likes</strong> <span class='badge badge-info ml-auto'>3</span></li><li class='d-flex nav-item mr-5 align-items-center'><strong class='mr-2'>Posts</strong> <span class='badge badge-info ml-auto'>7</span></li><li class='nav-item mr-5 d-flex align-items-center'><strong class='mr-2'>Following</strong> <span class='badge badge-info ml-auto'>178</span></li><li class='nav-item ml-auto text-muted' style='font-family: Cookie,cursive;'><i class='fas fa-user'></i> Mwananchi</li></ul>";
			}elseif($data->type==="politician"){
				return "<ul class='nav nav-tabs p-2'><li class='nav-item mr-5 d-flex align-items-center'><strong class='mr-2'>Posts</strong> <span class='badge badge-info ml-auto'>7</span></li><li class='nav-item mr-5 d-flex align-items-center'><strong class='mr-2'>Followers</strong> <span class='badge badge-info ml-auto'>178</span></li><li class='nav-item ml-auto text-muted' style='font-family: Cookie,cursive;'><i class='fas fa-user'></i> Mwananchi</li></ul>";
			}
		}
		redirect(base_url()."home.html","location");
	}
}
?>