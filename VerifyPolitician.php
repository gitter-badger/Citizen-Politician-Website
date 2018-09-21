<?php
require "Connection.php";
$user=htmlspecialchars($_POST["user"]);
$_POST["subject"]="Account Verification";
$_POST["message"]="Hope that you are well. This is to inform you that your account has been verified by our admin team. You can now use it. Login and enjoy our services.";
$stmt=$connection->query("update politician_profile set accountVerified=1 where userName='$user'");
if($stmt){
	require "emailSend.php";
}else{
	echo $connection->error;
}
?>