<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polls extends CI_Controller {
	public function index(){
		$data['head']=$this->loadscripts->index();
		$data['navbar']=$this->navbar->load_nav_bar();
		$this->load->view("start_poll",$data);
	}
}
?>