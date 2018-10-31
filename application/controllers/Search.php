<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
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
		$this->load->view("search_view",$data);
	}
}
?>