<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('accounts');
		$this->load->model("activity");
		$this->load->model("opinionpolls");
		$this->load->model("electiondate");
	}

	public function index(){
		$data['navbar']=$this->navbar->load_nav_bar();
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable();
		$data['activity']=$this->activity->get_activity_count_html();
		$data['potw']=$this->opinionpolls->get_potw();
		$data['election_date']=$this->electiondate->index();
		$this->load->view("settings_view",$data);
	}
}
?>