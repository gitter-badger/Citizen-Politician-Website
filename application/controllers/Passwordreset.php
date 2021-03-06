<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passwordreset extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("sendresetemail");
	}

	public function index($email,$passcode){
		$data['data']=$this->analyze_log($this->sendresetemail->get_log($passcode),$email,$passcode);
		$this->load->view("password_reset_view",$data);
	}

	private function analyze_log($log,$email,$pass){
		if(empty($log)){
			return "<div class='alert alert-danger'><strong>Error!</strong> The ($pass) passcode is not recognised by our system thus password cannot be reset. Please request for another password reset email.</div>";
		}else{
			foreach ($log as $value) {
				if($value->userEmail===$email){
					if(((strtotime($this->db->query("select now() as now")->row()->now)-strtotime($value->timestamp))/60)>15){
						return "<div class='alert alert-warning'><strong>Warning!</strong> Your request has timed out. Please request for another password reset email.</div>";
					}else{
						$new_pass=$this->sendresetemail->generate_random_string(random_int(10,20));
						if($this->sendresetemail->user_reset($value->eventID,$new_pass,$value->userEmail)){
							return "<div class='alert alert-success'><strong>Success!</strong> Password reset for $value->userEmail successful. Your new password is $new_pass.</div>";
						}else{
							return "<div class='alert alert-danger'><strong>Error occurred!</strong> Please try again later.</div>";
						}
					}
				}
			}
			return "<div class='alert alert-danger'><strong>Error!</strong> Email/Username ($email) not found in database. Please request for another password reset email to the correct email.</div>";
		}
	}
}
?>