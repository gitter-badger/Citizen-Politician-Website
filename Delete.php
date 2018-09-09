<?php
	$user=htmlspecialchars($_POST["user"]);
	require "Connection.php";
	$sql = "delete from citizen_profile where userName='$user';delete from admin_profile where adminUserName='$user';delete from politician_profile where userName='$user'";
 	if(mysqli_multi_query($connection,$sql)){
 		echo "Successfully deleted user with username $user.";
 	}else{
 		echo "Failed to delete user with username $user. $connection->error";
 	}
?>