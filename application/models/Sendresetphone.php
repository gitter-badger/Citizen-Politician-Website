<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendresetphone extends CI_Model {
	private $passcode;
	public function __construct(){
		parent::__construct();
		$this->load->library('phone');
		$this->load->model('accounts');
	}

	public function index($email){
		$email=$this->accounts->get_email($email);
		if(!is_object($email)){
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Phone because you are NOT Registered in the System.</div>";
		}
		if($email->phone===null){
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Phone because your phone number is not on the system.</div>";
		}
		if($this->accounts->check_phone_verified($email->phone)==0){
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Phone because your phone number is not verified.</div>";
		}
		if($this->log_event($email->user)){
			if(!empty($this->phone->send_text("Your Password Reset code is $this->passcode",$email->phone))){
				return true;
			}else{
				return "<div class='alert alert-danger'><strong>Fail!</strong> An error occurred and a text could not be sent. Try using email to reset password.</div>";
			}
		}else{
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Phone because a Database Error Occurred. Please Contact Administrator.</div>";
		}
	}

	//logs the event in the database for future reference i.e during actual password reset.
	private function log_event($email){
		if($this->db->query("update emailgetcredentials set used=1 where userEmail=? and type='password'",$email)){
			return $this->db->query("insert into emailgetcredentials(userEmail,passCode,type) values (?,?,'password')",array($email,$this->passcode=$this->formatter->generate_random_code(random_int(4,6))));
		}
		return false;
	}
}
?>