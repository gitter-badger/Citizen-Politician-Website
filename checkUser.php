<?php
$return;
if(!isset($user)){
	$user=htmlspecialchars($_POST["user"]);
}
require "connection.php";
$stmt=$connection->query("select userName from citizen_profile where userName='$user' union all select adminUserName from admin_profile where adminUserName='$user' union all select userName from politician_profile where userName='$user'");
if(mysqli_num_rows($stmt)>0){
	$return='true';
	echo "true";
	return;
}else{
	$return='false';
	echo "false";
	return;
}
?>