<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function coming_soon(){
		if($this->session->userdata('usertype')===null){
			$data['navbar']="";
		}else{
			$data['navbar']=$this->navbar->load_nav_bar();
		}
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_animeJS();
		$this->load->view('coming_soon',$data);
	}
}