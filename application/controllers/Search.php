<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("activity");
		$this->load->model("opinionpolls");
		$this->load->model("electiondate");
	}

	public function index($item){
		$this->load->model("search_model");
		$data['word']=preg_replace('/[-]/',' ',$item);
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable();
		$data['navbar']=$this->navbar->load_nav_bar();
		$data['users']=$this->search_model->index($item,"users");
		$data['comments']=$this->search_model->index($item,"Comments");
		$data['achievements']=$this->search_model->index($item,"Achievements");
		$data['critiques']=$this->search_model->index($item,"Critiques");
		$data['polls']=$this->search_model->index($item,"Polls");
		$data['activity']=$this->activity->get_activity_count_html();
		$data['potw']=$this->opinionpolls->get_potw();
		$data['election_date']=$this->electiondate->index();
		$this->load->view("search_view",$data);
	}
}
?>