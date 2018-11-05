<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Electiondate extends CI_Model {
	public function index(){
		$url="./resources/site_data/ElectionDate.txt";
		$file=fopen($url,'r');
		$date=fgets($file);
		$time=strtotime($date);
		fclose($file);
		if($time<strtotime(date("Y-m-d h:i:s"))){
			$file=fopen($url,'w+');
			fwrite($file,"Unknown");
			fclose($file);
			return "<div class='jumbotron'><span class='text-success' style='font-size: 24px'>Next Election Date</span><br><p>Unknown</p></div>";
		}
		return "<div class='jumbotron'><span class='text-success' style='font-size: 24px'>Next Election Date</span><br><p>".date_format(date_create($date),"F d,Y h:i a")."</p></div>";
	}
}
?>