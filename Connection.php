<?php
	$connection=mysqli_connect($_SERVER["HTTP_HOST"],"root","biggie5941","Citizen-Politician Website");
	if (!$connection) {
		die("<br><br>Cannot Connect to Database Thus Site is Shutting Down.");
	}
?>