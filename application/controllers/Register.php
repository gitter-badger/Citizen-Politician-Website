<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'controllers/Home.php';
class Register extends Home {
	//constructor. Loads codeigniter form validator library and send validation email model.
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('sendvalidationemail');
	}

	//This function counteracts the index function of the superclass. 
	public function index(){
		redirect(site_url('sign_up/basic'),'location');
	}

	//this function loads the sign up form or email validation form required. $form specifies the form to be loaded.
	public function sign_up($form){
		$data['head']=$this->loadscripts->index().$this->loadscripts->load_bootstrap().$this->loadscripts->load_angularJS();
		$data['countries']=$this->regions->get_countries();
		$data['counties']=$this->regions->get_counties();
		$data['mail_from']=$this->email->get_from();
		$data['form']=$form;
		$data['navbar']='';
		if($this->session->userdata('usertype')==='admin'){
			$data['navbar']=$this->navbar->load_nav_bar();
		}
		$this->load->view("sign_up",$data);
	}

	//function to add a user to the system via a session variable awaiting email and phone validation.
	public function add_user(){
		if(!isset($_POST)) redirect(site_url('sign_up/basic'),'location');
		$_POST['number']='+'.$_POST['phone'];
		$this->form_validation->set_rules('user','username',"trim|required|min_length[3]|callback_check_username|is_unique[citizen_profile.UserName]|is_unique[politician_profile.userName]|is_unique[admin_profile.adminUserName]",array('min_length'=>"Username must be atleast 3 characters long.",'is_unique'=>"Username is already registered on site."));
		$this->form_validation->set_rules('email','email',"trim|required|callback_check_email|is_unique[citizen_profile.Email]|is_unique[politician_profile.email]|is_unique[admin_profile.adminEmail]",array('check_email'=>"Email is of invalid format",'is_unique'=>"Email is already registered on site."));
		$this->form_validation->set_rules('phone','phone',"trim|required|is_natural");
		$this->form_validation->set_rules('number','phone',"is_unique[citizen_profile.phone]|is_unique[politician_profile.phone]",array('is_unique'=>"Phone Number is already registered on site."));
		$this->form_validation->set_rules('secret','password',"required|min_length[8]|regex_match[/[a-z]/i]|regex_match[/[0-9]/]",array('is_unique'=>"Phone Number is already registered on site.",'regex_match'=>"Password needs to have atleast one number and one letter."));
		$this->form_validation->set_rules('gender','gender',"trim|required|in_list[male,female]",array('in_list'=>"Gender can only be male or female."));
		$this->form_validation->set_rules('secretRe','password confirmation',"required|matches[secret]");
		$this->form_validation->set_rules('age','Age',"required|greater_than_equal_to[16]",array('greater_than_equal_to'=>"You do not meet age requirements to create an account on site."));
		$_POST['dob']=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
		$_POST['email_verified']=0;
		$_POST['phone_verified']=0;
		if ($this->form_validation->run() == FALSE){
            $this->sign_up('basic');
        }else{
        	if($_POST['type']==='citizen'){
        		$this->session->set_userdata('basic_data',$_POST);
        		$errors=$this->sendvalidationemail->index($_POST['user'],$_POST['email']);
        		if($errors===false){
        			$this->session->set_flashdata('error',"<div class='alert alert-danger alert-dismissable fade show'>A database error occurred. Please try again.<button type='button' class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>");
        		}else if($errors!==true){
        			$this->session->set_flashdata('error',"<div class='alert alert-danger alert-dismissable fade show'>Unable to send email. $errors Please try again.<button type='button' class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>");
        		}
        		redirect(site_url('sign_up/email'),'location');
        	}elseif($_POST['type']==='politician'){
        		redirect(site_url('coming_soon'),'location');
        	}
            redirect(site_url('sign_up/basic'),'location');
        }
	}

	//function used by the form validator to ensure email is a valid email.
	public function check_email($email){
		return $this->formatter->checkEmail($email);
	}

	//Checks a username field to see if it contains a valid username. NB: These are not the only validation rules used.
	public function check_username($user){
		if(strtolower($user)=="mwananchi"){
			$this->form_validation->set_message('check_username', "Username cannot be set to 'Mwananchi'.");
            return FALSE;
		}elseif(preg_match('/[^a-z 0-9-_.]/i',$user)){
			$this->form_validation->set_message('check_username', "Username contains unwanted symbols.");
            return FALSE;
		}elseif (preg_match('/[0-9]/',substr($user,0,1))){
			$this->form_validation->set_message('check_username', "Username cannot start with a number.");
            return FALSE;
		}
		return true;
	}

	//This function checks the system to check if a username, phone number or email is already taken.
	public function check_available(){
		if(!isset($_POST['user'])) redirect(site_url("sign_up/basic"),"location");
		$answer=$this->accounts->get_email(trim($_POST['user']));
		if(isset($answer)){
			echo 1;
			return 1;
		}
		echo 0;
		return 0;
	}

	//This resends validation credentials to an email or phone.
	public function resend_code(){
		if(isset($_POST['email'])){
			$errors=$this->sendvalidationemail->index($_POST['user'],$_POST['email']);
    		if($errors===false){
    			echo "<div class='alert alert-danger alert-dismissable fade show'>A database error occurred. Please try again.<button type='button' class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>";
    		}else if($errors!==true){
    			echo "<div class='alert alert-danger alert-dismissable fade show'>Unable to send email. $errors Please try again.<button type='button' class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>";
    		}else{
    			echo "<div class='alert alert-success alert-dismissable fade show'>Validation email has been resent to ".$_POST['email'].".<button type='button' class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>";
    		}
    		return;
		}else if(isset($_POST['phone'])){
			return;
		}
		redirect(site_url("sign_up/basic"),"location");
	}

	//This function verifies the code sent.
	public function verify_code(){
		if(isset($_POST['email'])){
			$valid=$this->sendvalidationemail->verifyCode($_POST['code'],$_POST['email']);
			if($valid==="valid"){
				$this->register_user();
			}else if($valid==="invalid"){
				$this->session->set_flashdata("error","<div class='alert alert-danger alert-dismissable fade show'>Invalid code supplied. Please use code sent via email.<button type='button' class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>");
			}else{
				$this->session->set_flashdata("error","<div class='alert alert-danger alert-dismissable fade show'>A database error occurred. Please try again.<button type='button' class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>");
			}
			redirect(site_url("sign_up/email"),"location");
		}else if(isset($_POST['phone'])){
			return;
		}
		redirect(site_url("sign_up/basic"),"location");
	}

	//This registers a user officially to the system.
	private function register_user(){
		if($this->session->userdata('basic_data')!==null){
			if($this->session->userdata('basic_data')['email_verified']===1){
				if($this->session->userdata('basic_data')['phone_verified']===0){
					if($this->session->userdata('basic_data')['type']==="citizen"){
						if($this->accounts->add_citizen($this->session->userdata('basic_data')['user'],$this->session->userdata('basic_data')['email'],$this->session->userdata('basic_data')['email_verified'],$this->session->userdata('basic_data')['number'],$this->session->userdata('basic_data')['phone_verified'],$this->session->userdata('basic_data')['gender'],$this->session->userdata('basic_data')['dob'],$this->session->userdata('basic_data')['countries'],$this->session->userdata('basic_data')['counties'],$this->session->userdata('basic_data')['secret'])){
							$this->session->set_flashdata("log","<div class='alert alert-success'>Successful sign up. Now log in.</div>");
							redirect(base_url(),"location");
						}else{
							$this->session->set_flashdata("error","<div class='alert alert-danger alert-dismissable fade show'>A database error occurred. Please try again.<button type='button' class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>");
						}
					}elseif($this->session->userdata('basic_data')['type']==="politician"){
						return;
					}elseif($this->session->userdata('basic_data')['type']==="admin"){
						return;
					}
				}else{
					$this->session->set_flashdata("error","<div class='alert alert-danger alert-dismissable fade show'>Please verify your phone number.<button type='button' class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>");
				}
			}else{
				$this->session->set_flashdata("error","<div class='alert alert-danger alert-dismissable fade show'>Please verify your email.<button type='button' class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>");
			}
		}else{
			redirect(site_url("sign_up/basic"),"location");
		}
	}
}
?>