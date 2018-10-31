<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		return $this->db->get("notifications")->result();
	}

	public function get_with_offset($limit,$offset){
		return $this->db->get("notifications",$limit,$offset)->result();
	}

	public function get_specific($target){
		$data=array($target);
		return $this->db->query("select * from notifications where target=? and isRead=0 order by notificationID desc",$data)->result();
	}

	public function get_unread_notifications($target){
		return $this->db->query("select count(*) as count from notifications where target=? and isRead=0",$target)->row();
	}

	public function get_all_unread_notifications(){
		return $this->db->query("select count(*) as count from notifications where isRead=0")->row();
	}
}
?>