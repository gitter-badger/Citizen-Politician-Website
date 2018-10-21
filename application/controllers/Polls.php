<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polls extends CI_Controller {
	public function index(){
		$this->load->model('opinionpolls');
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable();
		$data['navbar']=$this->navbar->load_nav_bar();
		$data['myPolls']=$this->opinionpolls->get_my_polls();
		$data['othersPolls']=$this->opinionpolls->get_others_polls();
		$this->load->view("start_poll",$data);
	}
}
?>