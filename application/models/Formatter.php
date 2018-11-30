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

	public function time_diff($date){
		return $this->db->query("select timestampdiff(second,?,now()) as now",$date)->row()->now;
	}

	public function count_elements($object){
		$counter=0;
		foreach ($object as $value) {
			$counter++;
		}
		return $counter;
	}
}
?>