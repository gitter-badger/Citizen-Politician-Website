<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_index_page_scripts().$this->loadscripts->load_animeJS();
		$this->load->view('index',$data);
	}
}
?>