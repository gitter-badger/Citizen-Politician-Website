<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	//Loads the coming soon page to show that a functionality is still under development.
	public function coming_soon(){
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_animeJS().$this->loadscripts->load_bootstrap();
		$this->load->view('coming_soon',$data);
	}
}