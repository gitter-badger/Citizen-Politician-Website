<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("notifications");
		$this->load->model("electiondate");
		$this->load->model("opinionpolls");
	}
	public function index(){
		$this->load->model("notifications");
		$data['navbar']=$this->navbar->load_nav_bar();
		$data['notifications']=$this->notifications->index();
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable();
		$data['election_date']=$this->electiondate->index();
		$data['potw']=$this->opinionpolls->get_potw();
		$this->load->view("notifications_view",$data);
	}
}