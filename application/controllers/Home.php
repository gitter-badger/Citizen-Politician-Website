<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('regions');
		$this->load->library("email");
		$this->load->model("sendresetemail");
		$this->load->model("contactinfo");
	}

	public function index(){
		$data['navbar']=$this->navbar->index();
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_main_js().$this->loadscripts->load_datatable();
		$data['counties']=$this->regions->get_counties();
		$data['mail_from']=$this->email->get_from();
		$data['faq']=$this->contactinfo->get_faq();
		$this->load->view("homepage",$data);
	}

	public function reset_password(){
		if(!isset($_POST['email'])) redirect(site_url("home"),"location");
		$this->session->set_flashdata('log',$this->sendresetemail->index(trim($_POST['email'])));
		redirect(site_url("home"),"location");
	}

	public function contact_us(){
		if(!isset($_POST['name'])) redirect(site_url("home"),"location");
		if(!$this->checkEmail(trim($_POST['email']))){
			$this->session->set_flashdata("error","<div class='alert alert-warning'>Email is not of correct format.</div>");
		}
		if($this->contactinfo->add_contact(trim($_POST['name']),trim($_POST['email']),trim($_POST['comment']))){
			$this->session->set_flashdata("error","<div class='alert alert-success'>Thankyou for reaching out to us ".trim($_POST['name']).". We will get back to you via your email as soon as possible.</div>");
		}else{
			$this->session->set_flashdata("error","<div class='alert alert-danger'>An error occurred. Please contact the administrator.</div>");
		}
		redirect(site_url("home")."#contacts","location");
	}

	private function checkEmail($email) {
	   $find1 = strpos($email, '@');
	   $find2 = strrpos($email, '.');
	   return ($find1 !== false && $find2 !== false && ($find1+2)<$find2 && ($find2+2)<strlen($email));
	}

	public function login(){
		if(!isset($_POST['userName'])) redirect(site_url("home"),"location");
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
		redirect(site_url("news_feed"),"location");
	}

	private function reject($error){
		$this->session->set_flashdata('log',"<div class='alert alert-danger'><strong>Error!</strong> Invalid $error.</div>");
		redirect(site_url("home"),"location");
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