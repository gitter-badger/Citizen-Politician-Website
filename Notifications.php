<?php
require "Connection.php";
session_start();
if(!isset($_SESSION["username"])||$_SESSION["usertype"]!=="admin"){
	header("Location: Homepage.php");
	return;
}
$photo=$_SESSION["photo"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mwananchi</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png" href="MwananchiIcon.png">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="Logged.css">
	<link rel="stylesheet" type="text/css" href="LoggedPhone.css">
	<style>
		@media screen and (max-width: 992px){
			div.collapse{
				max-height: 320px;
				overflow-y: auto;
			}
		}
	</style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
	
</body>
</html>