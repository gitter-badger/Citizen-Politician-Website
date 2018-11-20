<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendresetemail extends CI_Model {
	private $passcode;
	function __construct(){
		parent::__construct();
		$this->load->model("accounts");
		$this->load->library("email");
	}

	public function index($email){
		$email=$this->accounts->get_email($email);
		if(!is_object($email)){
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Email because you are NOT Registered in the System.</div>";
		}
		if($this->accounts->check_email_verified($email->email)==0){
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Email because your email is not verified.</div>";
		}
		if($this->log_event($email->user)){
			if($this->email->send_email($email->email,"Password Reset Instructions.","We hope that you are well. Below is a link that will enable you to reset your password. <br><br> <a style='text-align:center;border-radius:5px;background-color: #03869b;color: white;padding:10px;text-decoration:none;' href='".site_url("reset_user_password/$email->user/$this->passcode")."'>Reset My Password</a><br>",$email->user)){
				return "<div class='alert alert-success'><strong>Success!</strong> Password Reset Email Successfully Sent to your Email.</div>";
			}else{
				return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Email. ".$this->email->mailer->ErrorInfo."</div>";
			}
		}else{
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Email because a Database Error Occurred. Please Contact Administrator.</div>";
		}
	}

	private function log_event($email){
		if($this->db->query("update emailgetcredentials set used=1 where userEmail=? and type='password'",$email)){
			$newID=$this->db->query("select max(eventID) as maxID from emailgetcredentials")->row()->maxID+1;
			return $this->db->query("insert into emailgetcredentials(eventID,userEmail,passCode,type) values (?,?,?,'password')",array($newID,$email,$this->passcode=$this->formatter->generate_random_string(random_int(10,20))));
		}
		return false;
	}

	public function get_log($passcode){
		return $this->db->query("select * from emailgetcredentials where passCode=? and used=0",$passcode)->result();
	}

	public function user_reset($id,$pass,$email){
		$this->db->trans_start();
		$this->db->query("update emailgetcredentials set used=1 where eventID=?",$id);
		$this->db->query("update citizen_profile set Secret=? where UserName=?",array(password_hash($pass,PASSWORD_DEFAULT),$email));
		$this->db->query("update politician_profile set password=? where userName=?",array(password_hash($pass,PASSWORD_DEFAULT),$email));
		$this->db->query("update admin_profile set adminPassword=? where adminUserName=?",array(password_hash($pass,PASSWORD_DEFAULT),$email));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
}
?>