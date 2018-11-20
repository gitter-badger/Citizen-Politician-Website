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

	public function checkEmail($email) {
	   $find1 = strpos($email, '@');
	   $find2 = strrpos($email, '.');
	   return ($find1 !== false && $find2 !== false && ($find1+2)<$find2 && ($find2+2)<strlen($email));
	}

	public function reset_password(){
		if(!isset($_POST['email'])) redirect(base_url()."home.html","location");
		$this->load->model("sendresetemail");
		$this->session->set_flashdata('log',$this->sendresetemail->index($_POST['email']));
		redirect(base_url()."home.html","location");
	}

	public function signup(){
		$this->load->model('accounts');
		if(!isset($_POST)) redirect(base_url()."home.html","location");
		if($this->accounts->uniqueUser(trim($_POST['user']))){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Username already taken. Use another one.</div>");
			redirect(base_url()."home.html","location");
		}elseif($this->accounts->uniqueEmail(trim($_POST['email']))){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Email already taken. Use another one.</div>");
			redirect(base_url()."home.html","location");
		}elseif($this->accounts->uniquePhone(trim($_POST['phone']))){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Phone already taken. Use another one.</div>");
			redirect(base_url()."home.html","location");
		}
		if(strlen(trim($_POST['user']))<3||is_numeric(substr($_POST['user'],0,1))||strtolower(trim($_POST['user']))==="mwananchi"||strtolower(trim($_POST['user']))==="anonymous"||strripos($_POST['user'],"@")!==false){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Username not of correct format.</div>");
			redirect(base_url()."home.html","location");
		}
		if(strlen($_POST['secret'])<8){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Password must be atleast 8 characters.</div>");
			redirect(base_url()."home.html","location");
		}
		if($_POST['secret']!==$_POST['secretRe']){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Passwords must match</div>");
			redirect(base_url()."home.html","location");
		}

		if(!$this->checkEmail(trim($_POST['email']))){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Email not of correct format.</div>");
			redirect(base_url()."home.html","location");
		}

		if(substr(trim($_POST['phone']),0,1)!=="7"||strlen(trim($_POST['phone']))!==9||!is_numeric(trim($_POST['phone']))){
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>Phone number not of correct format.</div>");
			redirect(base_url()."home.html","location");
		}

		if($this->accounts->add_user(trim($_POST['type']),trim($_POST['user']),trim($_POST['email']),trim($_POST['phone']),trim($_POST['gender']),trim($_POST['counties']),trim($_POST['secret']))){
			$this->session->set_flashdata('log',"<div class='alert alert-success'>User Added. Please log in.</div>");
			redirect(base_url()."home.html","location");
		}else{
			$this->session->set_flashdata('log',"<div class='alert alert-warning'>User Not added. Please visit office.</div>");
			redirect(base_url()."home.html","location");
		}
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