<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendresetemail extends CI_Model {
	//The random string used to uniquely identify a reset request.
	private $passcode;

	//constructor. Loads accounts model and email library for use in this class.
	function __construct(){
		parent::__construct();
		$this->load->model("accounts");
		$this->load->library("email");
	}

	//Prepares and sends a reset email to any user on the site. An email, phone number or username can be used to reset a password.
	public function index($email){
		$email=$this->accounts->get_email($email);//get the email,username and phone number of a user.
		if(!is_object($email)){//executed if the given email, username or phone number is not found on our databases.
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Email because you are NOT Registered in the System.</div>";
		}
		if($this->accounts->check_email_verified($email->email)==0){//if credentials are found, this checks if the email has been verified by the user. If not, an email cannot be sent thus password cannot be reset via email.
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Email because your email is not verified.</div>";
		}
		if($this->log_event($email->user)){
			$response=$this->email->send_email($email->email,"Password Reset Instructions.","We hope that you are well. Follow <a href='".site_url("reset_user_password/$email->user/$this->passcode")."'> THIS </a> link to reset your password.<br>If you never requested for a password reset then please ignore this email.<br>",$email->user,'passwordreset');
			if($response==202){//sends email and if successful, displays a success message.
				return "<div class='alert alert-success'><strong>Success!</strong> Password Reset Instructions Successfully Sent to your Email.</div>";
			}else{//if email sending fails, shows an error message.
				return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Email. ".$response."</div>";
			}
		}else{//if database error occurs, shows error message.
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Email because a Database Error Occurred. Please Contact Administrator.</div>";
		}
	}

	//logs the event in the database for future reference i.e during actual password reset.
	private function log_event($email){
		if($this->db->query("update emailgetcredentials set used=1 where userEmail=? and type='password'",$email)){
			return $this->db->query("insert into emailgetcredentials(userEmail,passCode,type) values (?,?,'password')",array($email,$this->passcode=$this->formatter->generate_random_string(random_int(10,20))));
		}
		return false;
	}

	//gets log information based on a given passcode.
	public function get_log($passcode){
		return $this->db->query("select * from emailgetcredentials where passCode=? and type='password' and used=0",$passcode)->result();
	}

	//this method resets a user's password.
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