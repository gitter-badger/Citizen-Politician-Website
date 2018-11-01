<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("polifunctions");
		$this->load->model("electiondate");
		$this->load->model("opinionpolls");
	}
	public function index(){
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable();
		$data['navbar']=$this->navbar->load_nav_bar();
		$data['election_date']=$this->electiondate->index();
		$data['potw']=$this->opinionpolls->get_potw();
		$data['governor_roles']=$this->polifunctions->get_governor();
		$data['wrep_roles']=$this->polifunctions->get_women();
		$data['mp_roles']=$this->polifunctions->get_mp();
		$data['senator_roles']=$this->polifunctions->get_senator();
		$data['mca_roles']=$this->polifunctions->get_mca();
		$this->load->view('functions_view',$data);
	}
}
?>