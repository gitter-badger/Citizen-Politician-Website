<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('regions');
		$this->load->library("email");
		$this->load->model("sendresetemail");
		$this->load->model("sendresetphone");
		$this->load->model("contactinfo");
		$this->load->model('accounts');
	}

	public function index(){
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_bootstrap().$this->loadscripts->load_angularJS();
		$data['mail_from']=$this->email->get_from();
		$this->load->view("homepage",$data);
	}

	public function reset_password(){
		if(isset($_POST['email'])){
			if($this->formatter->check_length($_POST['email'])){
				$this->session->set_flashdata('log',"<div class='alert alert-warning'>Email/Username/Phone Number is required.</div>");
			}else{
				$this->session->set_flashdata('log',$this->sendresetemail->index(trim($_POST['email'])));
			}
		}elseif(isset($_POST['phone'])){
			if($_POST['submit']==="text"){
				if($this->formatter->check_length($_POST['phone'])){
					$this->session->set_flashdata('log',"<div class='alert alert-warning'>Email/Username/Phone Number is required.</div>");
				}else{
					$send_text=$this->sendresetphone->index(trim($_POST['phone']));
					if($send_text===true){
						$data['head']=$this->loadscripts->index().$this->loadscripts->load_bootstrap();
						$data['user']=$_POST['phone'];
						$this->load->view("verify_reset_code",$data);
						return;
					}
					$this->session->set_flashdata('log',$send_text);
				}
			}elseif($_POST['submit']==="call"){
				if($this->formatter->check_length($_POST['phone'])){
					$this->session->set_flashdata('log',"<div class='alert alert-warning'>Email/Username/Phone Number is required.</div>");
				}else{
					$call=$this->sendresetphone->reset_call(trim($_POST['phone']));
					if($call===true){
						$data['head']=$this->loadscripts->index().$this->loadscripts->load_bootstrap();
						$data['user']=$_POST['phone'];
						$this->load->view("verify_reset_code",$data);
						return;
					}
					$this->session->set_flashdata('log',$call);
				}
			}
		}
		redirect(base_url(),"location");
	}

	public function phone_reset(){
		if(!isset($_POST)) redirect(base_url(),'location');
		$user=$this->accounts->get_email(trim($_POST['user']))->user;
		$code=trim($_POST['code']);
		redirect(site_url("reset_user_password/$user/$code"),'location');
	}









	public function contact_us(){
		if(!isset($_POST['name'])) redirect(site_url("home"),"location");
		if(empty(trim($_POST['email']))||empty(trim($_POST['name']))||empty(trim($_POST['comment']))){
			$this->session->set_flashdata("Error","<div class='alert alert-warning'>A field is empty. Please fill out all fields.</div>");
			redirect(site_url("home")."#contacts","location");
		}
		if(!$this->formatter->checkEmail(trim($_POST['email']))){
			$this->session->set_flashdata("Error","<div class='alert alert-warning'>Email is not of correct format.</div>");
			redirect(site_url("home")."#contacts","location");
		}
		if($this->contactinfo->add_contact(htmlspecialchars(trim($_POST['name'])),htmlspecialchars(trim($_POST['email'])),htmlspecialchars(trim($_POST['comment'])))){
			$this->session->set_flashdata("Success","<div class='alert alert-success'>Thankyou for reaching out to us ".trim($_POST['name']).". We will get back to you via your email as soon as possible.</div>");
		}else{
			$this->session->set_flashdata("Error","<div class='alert alert-danger'>An error occurred. Please contact the administrator.</div>");
		}
		redirect(site_url("home")."#contacts","location");
	}

	public function get_faq(){
		if(!isset($_POST)) redirect(site_url("home"),"location");
		$data=$this->contactinfo->get_faq(trim($_POST['search']),10,trim($_POST['offset']));
		foreach ($data as $value) {
			$value->time=$this->formatter->time_diff($value->time);
		}
		$data=array($data,$this->contactinfo->get_faq_count(trim($_POST['search'])));
		echo json_encode($data);
	}

	public function login(){
		if(!isset($_POST['userName'])) redirect(site_url("home"),"location");
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