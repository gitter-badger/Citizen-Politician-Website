<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manifesto extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("manifestomodel");
		$this->load->model("electiondate");
		$this->load->model("opinionpolls");
	}

	public function index(){
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable();
		$data['navbar']=$this->navbar->load_nav_bar();
		$data['manifestos']=$this->manifestomodel->get_manifestos();
		$data['my_manifesto']=$this->manifestomodel->my_manifesto();
		$data['election_date']=$this->electiondate->index();
		$data['potw']=$this->opinionpolls->get_potw();
		if($this->session->userdata('usertype')==='admin') redirect(site_url('news_feed'),'location');
		$this->load->view('manifesto_view',$data);
	}

	public function edit(){
		if(!isset($_FILES['image'])) redirect(site_url('news_feed'),'location');
		if($this->manifestomodel->edit_manifesto($this->session->userdata('username'))){
			$this->session->set_flashdata('log','<div class="alert alert-success">Manifesto successfully updated.</div>');
			redirect(site_url('manifesto'),'location');
		}else{
			$this->session->set_flashdata('log','<div class="alert alert-danger">Manifesto not Updated. Please try again.</div>');
			redirect(site_url('manifesto'),'location');
		}
	}

	public function add(){
		if(!isset($_FILES['image'])) redirect(site_url('news_feed'),'location');
		if($this->manifestomodel->add_manifesto()){
			$this->session->set_flashdata('log','<div class="alert alert-success">Manifesto successfully added.</div>');
			redirect(site_url('manifesto'),'location');
		}else{
			$this->session->set_flashdata('log','<div class="alert alert-danger">Manifesto not Updated. Please try again.</div>');
			redirect(site_url('manifesto'),'location');
		}
	}
}
?>