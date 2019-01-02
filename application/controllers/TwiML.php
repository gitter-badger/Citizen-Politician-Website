<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TwiML extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index($code){
		$data['message']="Please input this code on the Mwananchi site or app.";
		$data['code']=implode(", ",explode("", $code));
		$this->load->view("say_validation_code",$data);
	}
}
?>