<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendvalidationemail extends CI_Model {
	private $code;

	public function __construct(){
		parent::__construct();
		$this->load->library("email");
	}

	public function index($username,$email){
		if($this->formatter->checkEmail($email)){
			$this->code=$this->formatter->generate_random_code(random_int(4,6));
			if($this->log_event($username)){
				$response=$this->email->send_email($email,"Welcome to Mwananchi","Glad to have you on board. To kick off, please use this code to validate your email.<br><br>$this->code<br>",$username,'validation');
				if($response==202){
					return true;
				}
				return $response;
			}
			return false;
		}
	}

	private function log_event($email){
		if($this->db->query("update emailgetcredentials set used=1 where userEmail=? and type='email'",$email)){
			return $this->db->query("insert into emailgetcredentials(userEmail,passCode,type) values (?,?,'email')",array($email,$this->code));
		}
		return false;
	}

	private function get_log($email){
		return $this->db->query("select * from emailgetcredentials where userEmail=? and type='email' and used=0",$email)->result();
	}

	public function verifyCode($code,$email){
		$data=$this->get_log($email);
		if($data===false){
			return false;
		}
		foreach ($data as $value) {
			if($value->passCode===$code){
				if($this->db->query("update emailgetcredentials set used=1 where eventID=?",$value->eventID)){
					$userdata=$this->session->userdata('basic_data');
					$userdata['email_verified']=1;
					$this->session->set_userdata('basic_data',$userdata);
					return "valid";
				}else{
					return false;
				}
			}
		}
		return "invalid";
	}
}