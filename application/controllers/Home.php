<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){
		$data['navbar']=$this->navbar->index();
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_main_js();
		$this->load->model('regions');
		$data['counties']=$this->regions->get_counties();
		$this->load->library("emailprepare");
		$data['mail_from']=$this->emailprepare->get_from();
		$this->load->view("homepage",$data);
	}

	public function reset_password(){
		if(!isset($_POST['email'])) redirect(base_url()."home.html","location");
		$this->load->model("sendresetemail");
		$this->session->set_flashdata('log',$this->sendresetemail->index($_POST['email']));
		//redirect(base_url()."home.html","location");
	}

	public function login(){
		if(!isset($_POST['userName'])) redirect(base_url()."home.html","location");
		$this->load->model("accounts");
		$data=$this->accounts->login_admin($_POST['userName']);
		$login=$this->verify_user($data);
		if(!$login){
			$data=$this->accounts->login_politician($_POST['userName']);
			$login=$this->verify_user($data);
			if(!$login){
				$data=$this->accounts->login_citizen($_POST['userName']);
				$login=$this->verify_user($data);
				if(!$login){
					$data=$this->accounts->check_verified($_POST['userName']);
					if(is_object($data)){
						if(password_verify($_POST['passWord'],$data->pass)){
							$this->session->set_flashdata('log',"<div class='alert alert-warning'><strong>Don't Worry!</strong> Your account has not yet been verified by our team but we are working on it. In the meantime, make sure you have verified your email address and phone number.</div>");
							redirect(base_url()."home.html","location");
						}else{
							$this->reject("Password");
						}
					}else{
						$this->reject("Username");
					}
				}
			}
		}
	}

	private function redirect($data){
		$data->county=($data->usertype==='admin') ? -1:$data->county;
		$photo=(stripos($data->photo, "https")===false) ? base_url()."resources/$data->photo":$data->photo;
		$userdata=array('username'=>$data->username,'photo'=>$photo,'usertype'=>$data->usertype,'county'=>$data->county);
		$this->session->set_userdata($userdata);
		redirect(base_url()."news_feed.html","location");
	}

	private function reject($error){
		$this->session->set_flashdata('log',"<div class='alert alert-danger'><strong>Error!</strong> Invalid $error.</div>");
		redirect(base_url()."home.html","location");
	}

	private function verify_user($data){
		if($data!==false){
			if(is_object($data)){
				if(password_verify($_POST['passWord'],$data->pass)){
					$this->redirect($data);
				}else{
					$this->reject("Password");
				}
			}else{
				return false;
			}
		}
		return true;
	}
}

?>