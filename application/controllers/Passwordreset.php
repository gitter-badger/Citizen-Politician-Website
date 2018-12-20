<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Passwordreset extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("sendresetemail");
	}

	//loads the password reset view to show success or failure.
	public function index($email,$passcode){
		$data['data']=$this->analyze_log($this->sendresetemail->get_log($passcode),$email,$passcode);
		$this->load->view("password_reset_view",$data);
	}

	//analyses the log info gotten from get_log method to see if there exists one where the given passcode and userEmail match. If a match is found, it checks if the given time period of 15 minutes has passed after which a request is considered void. If all conditions are fulfilled, a user's password is reset and their new password is shown.
	private function analyze_log($log,$email,$pass){
		if(empty($log)){
			return "<div class='alert alert-danger'><strong>Error!</strong> The ($pass) passcode is not recognised by our system thus password cannot be reset. Please request for another password reset.</div>";
		}else{
			foreach ($log as $value) {
				if($value->userEmail===$email){
					if(((strtotime($this->db->query("select now() as now")->row()->now)-strtotime($value->timestamp))/60)>15){
						return "<div class='alert alert-warning'><strong>Warning!</strong> Your request has timed out. Please request for another password reset.</div>";
					}else{
						$new_pass=$this->formatter->generate_random_string(random_int(10,20));
						if($this->sendresetemail->user_reset($value->eventID,$new_pass,$value->userEmail)){
							return "<div class='alert alert-success'><strong>Success!</strong> <span style='position: relative;margin-right: 5px'>Password reset for $value->userEmail successful. Your new password is </span> <a data-toggle='popover' data-placement='top' data-trigger='manual' data-content='Click to copy to Clipboard' style='position: absolute;cursor:pointer;z-index:100' id='new' class='text-muted'>$new_pass.</a><input type='text' style='opacity:0;' id='field' value='$new_pass'></div>";
						}else{
							return "<div class='alert alert-danger'><strong>Error occurred!</strong> Please try again later.</div>";
						}
					}
				}
			}
			return "<div class='alert alert-danger'><strong>Error!</strong> Username ($email) not found in database. Please request for another password reset with registered credentials.</div>";
		}
	}
}
?>