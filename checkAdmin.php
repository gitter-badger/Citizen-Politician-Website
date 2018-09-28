<?php
require 'Connection.php';
session_start();
$me=$_SESSION['username'];
$user=$_POST['admin'];
$stmt=$connection->prepare("select * from admin_profile where adminUserName=? and adminUserName!=?");
$stmt->bind_param("ss",$user,$me);
$stmt->execute();
if($stmt&&$connection){
	$result=$stmt->get_result();
	if(mysqli_num_rows($result)>0){
		echo "true";
	}else{
		echo "false";
	}
}else{
	echo $stmt->error.$connection->error;
}
?>