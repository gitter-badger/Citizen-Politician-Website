<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendvalidationphone extends CI_Model {
	private $code;

	public function __construct(){
		parent::__construct();
		$this->load->library("phone");
	}

	public function index($username,$phone){
		if(is_numeric($phone)){
			$this->code=$this->formatter->generate_random_code(random_int(4,6));
			if($this->log_event($username)){
				if($this->phone->send_text("Your Mwananchi verification code is $this->code",$phone)){
					return true;
				}
			}
		}
		return false;
	}

	private function log_event($email){
		if($this->db->query("update emailgetcredentials set used=1 where userEmail=? and type='phone'",$email)){
			return $this->db->query("insert into emailgetcredentials(userEmail,passCode,type) values (?,?,'phone')",array($email,$this->code));
		}
		return false;
	}

	private function get_log($email){
		return $this->db->query("select * from emailgetcredentials where userEmail=? and type='phone' and used=0",$email)->result();
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
					$userdata['phone_verified']=1;
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