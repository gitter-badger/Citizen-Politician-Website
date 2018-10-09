<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stories extends CI_Controller {
	public function index(){
		$this->load->model("activity");
		$this->load->model("newsfeed");
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable();
		$data['navbar']=$this->navbar->load_nav_bar();
		$data['activity']=$this->activity->get_activity_count_html();
		$this->session->set_userdata("usertype","citizen");
		$data['comments']=$this->newsfeed->index("Comments");
		//$data['achievements']=$this->newsfeed->index("Achievements");
		//$data['critiques']=$this->newsfeed->index("Critiques");
		$this->load->view('news_feed',$data);
	}

	public function checkPolitician(){
		if(isset($_POST['target'])){
			$this->load->model("accounts");
			$row=$this->accounts->login_politician($_POST['target']);
			echo (is_object($row))?1:0;
		}
	}
}
?>