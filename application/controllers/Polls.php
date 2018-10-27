<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polls extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('opinionpolls');
	}
	public function index(){
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable();
		$data['navbar']=$this->navbar->load_nav_bar();
		$data['myPolls']=$this->opinionpolls->get_my_polls();
		$data['othersPolls']=$this->opinionpolls->get_others_polls();
		if($this->session->userdata('usertype')!=='citizen'){
			$this->load->view("start_poll",$data);
			return;
		}
		redirect(site_url('news_feed'),'location');
	}

	public function submit_poll(){
		if(!isset($_POST)) redirect(base_url('home'),'location');
		if(isset($_POST['potw'])){
			if($_POST['potw']==='yes'){
				if($this->opinionpolls->check_potw()){
					$this->session->set_flashdata('log',"<div class='alert alert-warning'>Poll of the week already set. Please uncheck the poll of the week box.</div>");
					redirect(site_url('start_poll'),'location');
				}
				$_POST['potw']=1;
			}else{
				$_POST['potw']=0;
			}
		}else{
			$_POST['potw']=0;
		}
		if($this->opinionpolls->add_poll($_POST['question'],$_POST['type'],$this->session->userdata('username'),$_POST['potw'])){
			$this->session->set_flashdata('log',"<div class='alert alert-success'>Poll has started. Keep track of your poll below.</div>");
			redirect(site_url('start_poll'),'location');
		}
		$this->session->set_flashdata('log',"<div class='alert alert-danger'>Poll has not started. An error occurred please try again.</div>");
		redirect(site_url('start_poll'),'location');
	}

	public function submit_answer(){
		if(!isset($_POST)) redirect(base_url('home'),'location');
		if($this->opinionpolls->answer_poll($_POST['pollID'],$_POST['answer'],$this->session->userdata('username'))===true){
			echo $this->opinionpolls->get_after_answer($_POST['pollID']);
		}else{
			echo "Failure";
		}
	}
}
?>