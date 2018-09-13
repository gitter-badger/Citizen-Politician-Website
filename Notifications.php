<?php
require "Connection.php";
session_start();
if(!isset($_SESSION["username"])||$_SESSION["usertype"]!=="admin"){
	header("Location: Homepage.php");
	return;
}
$photo=$_SESSION["photo"];
date_default_timezone_set("Africa/Nairobi");
$currTimeStamp=date("Y-m-d H:i:s");
?>