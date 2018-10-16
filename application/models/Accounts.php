<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	public function login_admin($user_name){
		return $this->db->query("select adminUserName as username,adminPassword as pass,photo,userType as usertype from admin_profile where adminUserName=?",$user_name)->row();
	}

	public function login_politician($user_name){
		return (is_object($this->login_politician_email($user_name))) ? $this->login_politician_email($user_name) : $this->login_politician_user($user_name);
	}

	private function login_politician_email($email){
		return $this->db->query("select userName as username,Password as pass,photo,accountType as usertype from politician_profile where email=?",$email)->row();
	}

	private function login_politician_user($user_name){
		return $this->db->query("select userName as username,Password as pass,photo,accountType as usertype from politician_profile where userName=?",$user_name)->row();
	}

	public function login_citizen($user_name){
		return (is_object($this->login_citizen_email($user_name))) ? $this->login_citizen_email($user_name) : $this->login_citizen_user($user_name);
	}

	private function login_citizen_email($email){
		return $this->db->query("select UserName as username,Secret as pass,photo,type as usertype from citizen_profile where Email=?",$email)->row();
	}

	private function login_citizen_user($user_name){
		return $this->db->query("select userName as username,Secret as pass,photo,type as usertype from citizen_profile where UserName=?",$user_name)->row();
	}

	public function get_email($username){
		$posAt=strpos($username, "@");
		$posDot=strripos($username, ".");
		return ($posAt<1||($posAt+2)>$posDot||($posDot+2)>=strlen($username)) ? $this->db->query("select UserName as user,Email as email from citizen_profile where UserName=? union select userName as user,email from politician_profile where userName=?",array($username,$username))->row():$this->db->query("select UserName as user,Email as email from citizen_profile where Email=? union select userName as user,email from politician_profile where email=?",array($username,$username))->row();
	}

	public function check_email_verified($email){
		return $this->db->query("select emailVerified as verified from politician_profile where email=? union all select verifyEmail as verified from citizen_profile where Email=?",array($email,$email))->row()->verified;
	}
}

?>