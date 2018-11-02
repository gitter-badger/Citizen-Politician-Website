<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function index($user){
		$this->load->model("profile_model");
		$data['navbar']=$this->navbar->load_nav_bar();
		$data['top']=$this->profile_model->index($user);
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable();
		$this->load->view("profile_viewer",$data);
	}
}
?>