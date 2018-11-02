<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('accounts');
	}

	public function index(){
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable().$this->loadscripts->load_main_js();
		$data['navbar']=$this->navbar->load_nav_bar();
		if($this->session->userdata('usertype')!=='admin') redirect(site_url('news_feed'),'location');
		$this->load->view('add_admin',$data);
	}

	public function drop_accounts(){
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_datatable().$this->loadscripts->load_main_js();
		$data['navbar']=$this->navbar->load_nav_bar();
		$data['accounts']=$this->accounts->get_accounts();
		if($this->session->userdata('usertype')!=='admin') redirect(site_url('news_feed'),'location');
		$this->load->view('drop_accounts',$data);
	}

	public function register_admin(){
		if(!isset($_POST)) redirect(site_url('register'),'location');
		if(strlen($_POST['user'])<3||strtolower($_POST['user'])==='anonymous'||preg_match('/[^a-zA-Z]+/',$_POST['user'], $matches)){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Username must be more than 3 characters long and must not contain any symbols or numbers. You also cannot use the name anonymous as your username.</div>");
			redirect(site_url('register'),'location');
		}else if($this->accounts->check_name($_POST['user'])){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Username already exists in the system.</div>");
			redirect(site_url('register'),'location');
		}else if(strlen($_POST['secret'])<8){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Password should be atleast 8 characters.</div>");
			redirect(site_url('register'),'location');
		}else if($_POST['secret']!==$_POST['secretRe']){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Passwords must match.</div>");
			redirect(site_url('register'),'location');
		}else if($this->accounts->add_admin($_POST['user'],$_POST['secret'],$_POST['gender'])){
			$this->session->set_flashdata('log',"<div class='alert alert-success'>Admin Account Created Successfully.</div>");
			redirect(site_url('register'),'location');
		}else{
			$this->session->set_flashdata('log',"<div class='alert alert-danger'>Failed to create account.</div>");
			redirect(site_url('register'),'location');
		}

	}

	public function drop($user){

	}
}
?>