<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller{
	function __construct(){
		parent::__construct();
	}

	public function index(){
		date_default_timezone_set("Africa/Nairobi");
		$data['head']=$this->loadscripts->index();
		if(strtotime("2018-11-01 00:00:00")-strtotime(date("Y-m-d H:i:s"))>0){
			$this->load->view('countdown',$data);
		}else{
			$data['head'].=$this->loadscripts->load_index_page_scripts().$this->loadscripts->load_animeJS();
			$this->load->view('index',$data);
		}
	}
}
?>