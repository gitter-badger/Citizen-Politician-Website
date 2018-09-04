<?php
	$connection=mysqli_connect("sql7.freemysqlhosting.net","sql7255071","biggie5941","sql7255071");
	//$connection=mysqli_connect("localhost","root","biggie5941","Citizen-Politician Website");
	if (!$connection) {
		die("<br><br>Cannot Connect to Database Thus Site is Shutting Down.<br><br>".mysqli_connect_error());
	}
//postgres://dqhdzzkgptmtrc:d519e14a854b4182416f6b039dbb7f22cea904c0a78ae57394816d8c65cd1619@ec2-54-75-251-84.eu-west-1.compute.amazonaws.com:5432/d2elm95dd0nvio
?>