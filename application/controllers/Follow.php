<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Follow extends CI_Controller {
	public function follow_user(){
		if(!isset($_POST['politician'])) redirect(site_url('news_feed'),'location');
		$this->load->model("activity");
		if($this->activity->follow($this->session->userdata('username'),$_POST['politician'])){
			echo "Success";
		}else{
			echo "Error";
		}
	}

	public function unfollow_user(){
		if(!isset($_POST['politician'])) redirect(site_url('news_feed'),'location');
		$this->load->model("activity");
		if($this->activity->unfollow($this->session->userdata('username'),$_POST['politician'])){
			echo "Success";
		}else{
			echo "Error";
		}
	}
}
?>