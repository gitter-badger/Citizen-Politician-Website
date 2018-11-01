<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NavBar {
	private $ci;
	public function __construct(){
		$this->ci=& get_instance();
	}
	public function index(){
		return "<nav class='navbar navbar-expand-sm navbar-light fixed-bottom' style='background-color: #ced4da;padding-top:2px;padding-bottom:2px;'><button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#smallScreen' style='outline: none;'><span class='navbar-toggler-icon'></span></button><div class='collapse navbar-collapse' id='smallScreen' style='font-family: Comic Sans MS,cursive,sans-serif;font-size:13px'><ul class='navbar-nav'><li class='nav-item'><a class='nav-link' href='#main'>Home</a></li><li class='nav-item'><a class='nav-link' href='#contacts'>Contacts</a></li><li class='nav-item'><a class='nav-link' href=''>Bug Report</a></li><li class='nav-item'><a class='nav-link' href=''>Help</a></li></ul></div><a class='ml-auto navbar-brand text-dark' href='".base_url()."' style='font-family: Cookie,cursive;font-size:17px'><i class='fas fa-user'></i> Mwananchi &copy; 2018</a></nav>";
	}

	public function admin_nav_bar(){
		return "<nav class='navbar bg-info navbar-expand-lg navbar-dark fixed-top' style='padding-top:2px;padding-bottom:2px;'><a class='navbar-brand text-dark' href='".base_url()."' style='font-family: Cookie,cursive;'><i class='fas fa-user'></i> Mwananchi</a><button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#smallScreen' style='outline: none;'><span class='navbar-toggler-icon'></span></button><div class='collapse navbar-collapse' id='smallScreen'><ul class='navbar-nav'><li class='nav-item'><a class='nav-link' href='".base_url()."news_feed.html'>Home</a></li><li class='nav-item'><a class='nav-link' href='".site_url('functions')."'>Politician Roles</a></li><li class='nav-item'><a class='nav-link' href=''>Site Settings</a></li><li class='nav-item'><a class='nav-link' href='".site_url("start_poll")."'>Start Poll</a></li></ul><ul class='navbar-nav ml-auto'><li class='nav-item'><a class='nav-link' href=''><span class='fas fa-cog'></span> Settings</a></li><li class='nav-item' style='width: 50px;text-align: center;white-space: nowrap;' data-toggle='popover' title='Recent Notifications' data-trigger='hover' data-placement='bottom' data-content='".implode($this->get_notifications())."'><a class='nav-link' href=''><span class='fas fa-bell'></span> <sup class='badge badge-secondary' style='text-align: center;white-space: nowrap;'>".$this->get_notification_count()."</sup></a></li><li class='nav-item dropdown'><a class='nav-link dropdown-toggle' data-toggle='dropdown' href=''><span class='rounded'><img class='rounded' src='".$this->ci->session->userdata("photo")."' width='25px' height='25px' style='width: 25px;height:25px;'></span> My Profile </a>
		    			<div class='dropdown-menu bg-info' style='padding: 3px;border-radius: 5px;padding-top: 13px;margin-top:-0.01px;'>
		    					<a class='nav-item nav-link' href='".base_url("profile/".$this->ci->session->userdata("username")).".html'>@ ".$this->ci->session->userdata("username")."</a><hr>
				    			<a class='nav-item nav-link' href=''>Send Emails</a>
				    			<a class='nav-item nav-link' href=''>Add Admin</a>
				    			<a class='nav-item nav-link' href=''>Drop Accounts</a>
				    			<a class='nav-item nav-link' href='".site_url("home")."'>Logout</a>
				    	</div></li></ul></div></nav><script> $(\"[data-toggle='popover']\").hover(event=>{ if($(window).width()<992){ $(\"[data-toggle='popover']\").popover('disable')}else{ $(\"[data-toggle='popover']\").popover('enable')}}); $(\"[data-toggle='popover']\").popover({html:true,template:\"<div class='popover rounded-0' style='width: 320px;max-height:420px;margin-top: -0.01px;overflow-y: auto;' role='tooltip'><div class='arrow'> </div><div class='popover-header bg-info rounded-0' style='font-family: courier new;font-weight: bolder'></div><div class='rounded-0 popover-body bg-secondary'></div>\"});</script>";
	}

	private function politician_nav_bar(){
		return "<nav class='navbar bg-info navbar-expand-lg navbar-dark fixed-top' style='padding-top:2px;padding-bottom:2px;'><a class='navbar-brand text-dark' href='".base_url()."' style='font-family: Cookie,cursive;'><i class='fas fa-user'></i> Mwananchi</a><button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#smallScreen' style='outline: none;'><span class='navbar-toggler-icon'></span></button><div class='collapse navbar-collapse' id='smallScreen'><ul class='navbar-nav'><li class='nav-item'><a class='nav-link' href='".base_url()."news_feed.html'>Home</a></li><li class='nav-item'><a class='nav-link' href='".site_url("start_poll")."'>Start Poll</a></li><li class='nav-item'><a class='nav-link' href='".site_url('functions')."'>Politician Roles</a></li><li class='nav-item'><a class='nav-link' href='".site_url("home")."'>Logout</a></li></ul><ul class='navbar-nav ml-auto'><li class='nav-item'><a class='nav-link' href=''><span class='fas fa-cog'></span> Settings</a></li><li class='nav-item' style='width: 50px;text-align: center;white-space: nowrap;' data-toggle='popover' title='Recent Notifications' data-trigger='hover' data-placement='bottom' data-content='".implode($this->get_notifications())."'><a class='nav-link' href=''><span class='fas fa-bell'></span> <sup class='badge badge-secondary' style='text-align: center;white-space: nowrap;'>".$this->get_notification_count()."</sup></a></li><li class='nav-item'><a class='nav-link' href='".site_url("profile/".$this->ci->session->userdata("username"))."'><span class='rounded'><img class='rounded' src='".$this->ci->session->userdata("photo")."' width='25px' height='25px' style='width: 25px;height:25px;'></span> Your Profile</a></li></ul></div></nav><script> $(\"[data-toggle='popover']\").hover(event=>{ if($(window).width()<992){ $(\"[data-toggle='popover']\").popover('disable')}else{ $(\"[data-toggle='popover']\").popover('enable')}}); $(\"[data-toggle='popover']\").popover({html:true,template:\"<div class='popover rounded-0' style='width: 320px;max-height:420px;margin-top: -0.01px;overflow-y: auto;' role='tooltip'><div class='arrow'> </div><div class='popover-header bg-info rounded-0' style='font-family: courier new;font-weight: bolder'></div><div class='rounded-0 popover-body bg-secondary'></div>\"});</script>";
	}

	private function citizen_nav_bar(){
		return "<nav class='navbar bg-info navbar-expand-lg navbar-dark fixed-top' style='padding-top:2px;padding-bottom:2px;'><a class='navbar-brand text-dark' href='".base_url()."' style='font-family: Cookie,cursive;'><i class='fas fa-user'></i> Mwananchi</a><button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#smallScreen' style='outline: none;'><span class='navbar-toggler-icon'></span></button><div class='collapse navbar-collapse' id='smallScreen'><ul class='navbar-nav'><li class='nav-item'><a class='nav-link' href='".base_url()."news_feed.html'>Home</a></li><li class='nav-item'><a class='nav-link' href='".site_url('functions')."'>Politician Roles</a></li><li class='nav-item'><a class='nav-link' href='".site_url("home")."'>Logout</a></li></ul><ul class='navbar-nav ml-auto'><li class='nav-item'><a class='nav-link' href=''><span class='fas fa-cog'></span> Settings</a></li><li class='nav-item' style='width: 50px;text-align: center;white-space: nowrap;' data-toggle='popover' title='Recent Notifications' data-placement='bottom' data-content='".implode($this->get_notifications())."'><a class='nav-link'><span class='fas fa-bell'></span> <sup class='badge badge-secondary' style='text-align: center;white-space: nowrap;'>".$this->get_notification_count()."</sup></a></li><li class='nav-item'><a class='nav-link' href='".site_url("profile/".$this->ci->session->userdata("username"))."'><span class='rounded'><img class='rounded' src='".$this->ci->session->userdata("photo")."' width='25px' height='25px' style='width: 25px;height:25px;'></span> Your Profile</a></li></ul></div></nav><script> $(\"[data-toggle='popover']\").popover({html:true,template:\"<div class='popover rounded-0' style='width: 320px;max-height:420px;margin-top: -0.01px;overflow-y: auto;' role='tooltip'><div class='arrow'> </div><div class='popover-header bg-info rounded-0' style='font-family: courier new;font-weight: bolder'></div><div class='rounded-0 popover-body bg-secondary'></div>\"});</script>";
	}

	private function get_notifications(){
		$content=array();
		$this->ci->load->model("notifications");
		foreach($this->ci->notifications->get_specific($this->ci->session->userdata('username')) as $row){
			$data=(strlen($row->notification)>105) ? substr($row->notification,0,105)."...":$row->notification;
			array_push($content,"<div class=\"alert alert-info\" style=\"font-family: Comic Sans MS, cursive, sans-serif;\"><strong>$row->subject</strong><br><i style=\"font-family: Cookie,cursive;font-size: 18px;\">$row->type</i><br>$data</div><hr>");
		}
		array_push($content,"<a href=\"\" class=\"text-light mb-3\">See All</a>");
		return $content;
	}

	private function get_notification_count(){
		$this->ci->load->model("notifications");
		return $this->ci->notifications->get_unread_notifications($this->ci->session->userdata('username'))->count;
	}


	public function load_nav_bar(){
		if(null!==$this->ci->session->userdata('usertype')){
			if($this->ci->session->userdata('usertype')==="admin"){
				return $this->admin_nav_bar();
			}elseif($this->ci->session->userdata('usertype')==="politician"){
				return $this->politician_nav_bar();
			}elseif($this->ci->session->userdata('usertype')==="citizen"){
				return $this->citizen_nav_bar();
			}
		}
		redirect(base_url()."home.html","location");
	}
}

?>