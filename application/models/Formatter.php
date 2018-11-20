<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formatter extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function checkEmail($email) {
	   $find1 = strpos($email, '@');
	   $find2 = strrpos($email, '.');
	   return ($find1 !== false && $find2 !== false && ($find1+2)<$find2 && ($find2+2)<strlen($email));
	}

	public function generate_random_string($integer) {
	  $text = "";
	  $possible_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	  for ($i = 0; $i < $integer; $i++)
	    $text .= $possible_chars[random_int(0, strlen($possible_chars) - 1)];

	  return $text;
	}

	public function formatDate($date){
		$now=$this->db->query("select now() as now")->row()->now;
		if(date_format(date_create($date),"Y")!==date_format(date_create($now),"Y")){
			return date_format(date_create($date),'M d, Y');
		}else{
			if(strtotime($now)-strtotime($date)<120){
				return "Just now"; 
			}elseif(strtotime($now)-strtotime($date)<3600){
				return floor((strtotime($now)-strtotime($date))/60)." mins";
			}elseif(strtotime($now)-strtotime($date)<86400){
				return floor((strtotime($now)-strtotime($date))/3600).(strtotime($now)-strtotime($date)>=3600?" hrs":" hr");
			}elseif(strtotime($now)-strtotime($date)<604800){
				return floor((strtotime($now)-strtotime($date))/86400).(strtotime($now)-strtotime($date)>=86400?" dys":" dy");
			}else{
				return date_format(date_create($date),'M d');
			}							
		}
	}

	public function countElements($object){
		$counter=0;
		foreach ($object as $value) {
			$counter++;
		}
		return $counter;
	}
}
?>