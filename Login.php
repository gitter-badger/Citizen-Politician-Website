<?php
$user=htmlspecialchars($_POST["userName"]);
$pass=htmlspecialchars($_POST["passWord"]);
echo "$user<br>$pass";
?>