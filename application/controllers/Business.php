<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('regions');
	}

	public function privacy(){
		redirect(site_url("coming_soon"),'location');
	}

	public function terms(){
		redirect(site_url("coming_soon"),'location');
	}

	public function help(){
		redirect(site_url("coming_soon"),'location');
	}

	public function cookies(){
		redirect(site_url("coming_soon"),'location');
	}

	public function security(){
		redirect(site_url("coming_soon"),'location');
	}

	public function features(){
		redirect(site_url("coming_soon"),'location');
	}

	public function dev_zone(){
		redirect(site_url("coming_soon"),'location');
	}

	public function about(){
		redirect(site_url("coming_soon"),'location');
	}
}
?>