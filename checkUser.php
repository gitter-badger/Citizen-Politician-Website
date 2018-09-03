<?php
$user=htmlspecialchars($POST["user"]);
require "connection.php";
$stmt=$connection->query("select * from citizen");
?>