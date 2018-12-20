<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Model {
	//constructor
	function __construct(){
		parent::__construct();
	}

	//function for logging in an admin by email or username.
	public function login_admin($user_name){
		return $this->db->query("select adminUserName as username,adminPassword as pass,photo,userType as usertype from admin_profile where adminUserName=? or adminEmail=?",array($user_name,$user_name))->row();
	}


	//function for logging in a politician by email, password or phone number. NB: Politicians whose accounts are not verified by admin cannot use their accounts. Politicians who have not verified their emails and phones can also not use their accounts.
	public function login_politician($user_name){
		return $this->db->query("select userName as username,Password as pass,photo,accountType as usertype from politician_profile where (userName=? or email=? or phone=?) and accountVerified=1 and emailVerified=1 and phoneVerified=1",array($user_name,$user_name,$user_name))->row();
	}

	//function for logging in a citizen by email, username or phone number. For phone numbers, the accepted format is the one saved on the database ie country code+number with the + sign. eg +254789123456 for Kenya where +254 is country code and 789123456 is the phone number
	public function login_citizen($user_name){
		return $this->db->query("select userName as username,Secret as pass,photo,type as usertype from citizen_profile where UserName=? or Email=? or phone=?",array($user_name,$user_name,$user_name))->row();
	}

	//function to check if a politician is available to use as a target in posts. This function only checks for username meaning the target for any post can only be a politician's username and not their real name or any other information relating to them.
	public function check_politician($user_name){
		return $this->db->query("select * from politician_profile where userName=? and accountVerified=1",$user_name)->row();
	}


	//since email is a unique field in the database, this function gets the email,username and phone number for any user in the system. One can pass an email, username or phone number as a parameter to this function. Thus it can be used to check if the email, username or phone number exists in the database. It can also be used to get the other parameters given one of them.
	public function get_email($username){
		return $this->db->query("select UserName as user,Email as email,phone from citizen_profile where UserName=? or Email=? or phone=? union all select userName as user,email,phone from politician_profile where userName=? or email=? or phone=? union all select adminUserName as user,adminEmail as email,null as phone from admin_profile where adminUserName=? or adminEmail=?",array($username,$username,$username,$username,$username,$username,$username,$username))->row();
	}

	//This function checks a particular EMAIL to see if it is verified. Verified emails can be used to reset passwords. If an email is not verified one cannot use it in the password reset functionality.
	public function check_email_verified($email){
		return $this->db->query("select emailVerified as verified from politician_profile where email=? union all select verifyEmail as verified from citizen_profile where Email=? union all select verified from admin_profile where adminEmail=?",array($email,$email,$email))->row()->verified;
	}

	//This function checks a particular PHONE NUMBER to see if it is verified. Verified phone numbers can be used to reset passwords. If a phone number is not verified one cannot use it in the password reset functionality.
	public function check_phone_verified($phone){
		return $this->db->query("select phoneVerified as verified from politician_profile where phone=? union all select verifyPhone as verified from citizen_profile where phone=? union all select 0 as verified from admin_profile",array($phone,$phone))->row()->verified;
	}

	//This function needs work
	public function get_politician_info($politician){
		return $this->db->query("select * from politician_profile left join politician_politics on politician_profile.userName=politician_politics.userName left join politician_education on politician_profile.userName=politician_education.userName left join counties on CountyID=countyNo left join constituencies on constituencyID=ConstituencyNo left join wards on wardID=WardNo where politician_profile.userName=?",$politician)->row();
	}

	//Incase a politician is denied access to the site on login, this function checks why they were denied access ie what credentials were missing eg email was not verified or account is non existent.
	public function check_login_error($politician){
		$error=$this->db->query("select userName as username,Password as pass,photo,accountType as usertype,countyNo as county from politician_profile where (userName=? or email=?) and emailVerified=0",$politician,$politician)->row();
		if(!isset($error)){
			$error=$this->db->query("select userName as username,Password as pass,photo,accountType as usertype,countyNo as county from politician_profile where (userName=? or email=?) and phoneVerified=0",$politician,$politician)->row();
			if(!isset($error)){
				$error=$this->db->query("select userName as username,Password as pass,photo,accountType as usertype,countyNo as county from politician_profile where (userName=? or email=?) and accountVerified=0",$politician,$politician)->row();
				if(!isset($error)){
					return "not found";
				}
				return "account";
			}
			return "phone";
		}
		return "email";
	}

	//This function adds a citizen to the system.
	public function add_citizen($username,$email,$email_verified,$phone,$phone_verified,$gender,$dob,$country,$county,$secret){
		$photo=(strtolower($gender)==="male") ? "https://res.cloudinary.com/dkgtd3pil/image/upload/v1542838678/mwananchi/site/user.png":"https://res.cloudinary.com/dkgtd3pil/image/upload/v1542838679/mwananchi/site/userFemale.png";
		return $this->db->query("insert into citizen_profile (UserName,Email,verifyEmail,phone,verifyPhone,gender,DOB,country,County,photo,Secret) values (?,?,?,?,?,?,?,?,?,?,?)",array(strtolower($username),strtolower($email),$email_verified,$phone,$phone_verified,strtolower($gender),$dob,$country,$county,$photo,password_hash($secret,PASSWORD_DEFAULT)));
	}




	public function get_accounts(){
		$return=$this->db->query("select UserName,gender,type,photo from citizen_profile union all select username,gender,accountType,photo from politician_profile where accountVerified=1")->result();
		foreach ($return as $value) {
			if(stripos($value->photo,"https")===false){
				$value->photo=base_url()."resources/$value->photo";

			}
		}
		return $return;
	}
}

?>