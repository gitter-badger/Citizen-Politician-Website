<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendResetEmail extends CI_Model {
	private $passcode;
	function __construct(){
		parent::__construct();
	}

	public function index($email){
		$email=$this->get_user_email($email);
		if(!is_object($email)){
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Email NOT Sent to your Email because you are NOT Registered in the System.</div>";
		}
		if($this->log_event($email->user)){
			$this->load->library("emailprepare");
			if($this->emailprepare->send_email($email->email,"Password Reset Request.","We hope that you are well. Below is a link that will enable you to reset your password. <br><br> <a style='text-align:center;border-radius:5px;background-color: #03869b;color: white;padding:10px;text-decoration:none;' href='".base_url()."reset_user_password/".$email->user."/".$this->passcode.".html'>Reset My Password</a><br>")){
				return "<div class='alert alert-success'><strong>Success!</strong> Password Reset Email Successfully Sent to your Email.</div>";
			}else{
				return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Email NOT Sent to your Email. ".$this->emailprepare->mailer->ErrorInfo."</div>";
			}
		}else{
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Email NOT Sent to your Email because a Database Error Occurred. Please Contact Administrator.</div>";
		}
	}

	private function get_user_email($user){
		$this->load->model("accounts");
		return $this->accounts->get_email($user);
	}

	private function log_event($email){
		$this->db->query("update emailGetCredentials set used=1 where userEmail=? and type='password'",$email);
		$newID=$this->db->query("select max(eventID) as maxID from emailGetCredentials")->row()->maxID+1;
		return $this->db->query("insert into emailGetCredentials(eventID,userEmail,passCode,type) values (?,?,?,'password')",array($newID,$email,$this->passcode=$this->generate_random_string(random_int(10,20))));
	}

	public function generate_random_string($integer) {
	  $text = "";
	  $possible_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	  for ($i = 0; $i < $integer; $i++)
	    $text .= $possible_chars[random_int(0, strlen($possible_chars) - 1)];

	  return $text;
	}

	public function get_log($passcode){
		return $this->db->query("select * from emailGetCredentials where passCode=? and used=0",$passcode)->result();
	}

	public function user_reset($id,$pass,$email){
		$this->db->trans_start();
		$this->db->query("update emailGetCredentials set used=1 where eventID=?",$id);
		$this->db->query("update citizen_profile set Secret=? where UserName=?",array(password_hash($pass,PASSWORD_DEFAULT),$email));
		$this->db->query("update politician_profile set password=? where userName=?",array(password_hash($pass,PASSWORD_DEFAULT),$email));
		$this->db->query("update admin_profile set adminPassword=? where adminUserName=?",array(password_hash($pass,PASSWORD_DEFAULT),$email));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
}
?>