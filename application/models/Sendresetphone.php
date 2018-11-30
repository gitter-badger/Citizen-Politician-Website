<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendresetphone extends Sendresetemail {
	public function __construct(){
		parent::__construct();
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
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Phone because your phone is not verified.</div>";
		}
		if($this->log_event($email->user)){
			$phone='0'.strrev(substr(strrev($email->phone),0,9));
			if($this->email->send_email($phone.'@vtext.com',"Password Reset Instructions.","We hope that you are well. Below is a link that will enable you to reset your password. <br><br> <a style='text-align:center;border-radius:5px;background-color: #03869b;color: white;padding:10px;text-decoration:none;' href='".site_url("reset_user_password/$email->user/$this->passcode")."'>Reset My Password</a><br>",$email->user)){
				return "<div class='alert alert-success'><strong>Success!</strong> Password Reset Email Successfully Sent to your Email.</div>";
			}else{
				return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Email. ".$this->email->mailer->ErrorInfo."</div>";
			}
		}else{
			return "<div class='alert alert-danger'><strong>Fail!</strong> Password Reset Instructions NOT Sent to your Email because a Database Error Occurred. Please Contact Administrator.</div>";
		}
	}
}
?>