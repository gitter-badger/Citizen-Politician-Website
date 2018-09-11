<?php
require "Connection.php";
$user=htmlspecialchars($_POST["user"]);
$stmt=$connection->query("update politician_profile set accountVerified=1 where userName='$user'");
if($stmt){
	echo "Account successfully verified";
}else{
	echo $connection->error;
}
?>