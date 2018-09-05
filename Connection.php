<?php
	$connection=mysqli_connect("sql7.freemysqlhosti.net","sql7255071","biggie5941","sql7255071");
	//$connection=mysqli_connect("localhost","root","biggie5941","Citizen-Politician Website");
	if ($connection) {
		return;
	}
	//postgres://dqhdzzkgptmtrc:d519e14a854b4182416f6b039dbb7f22cea904c0a78ae57394816d8c65cd1619@ec2-54-75-251-84.eu-west-1.compute.amazonaws.com:5432/d2elm95dd0nvio
?>


<!DOCTYPE html>
<html>
<head lang="en">
	<title>Mwananchi</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png" href="MwananchiIcon.png">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="MainCSS.css">
	<link rel="stylesheet" type="text/css" href="PhoneMainCSS.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="MainJS.js"></script>
</head>
<body style="background-color: lavender;background-image: none;">
	<br><br><br><br>
	<div class="container alert alert-danger">
		<h1 class="jumbotron text-secondary">Error Establishing Connection to database.</h1>
		<div class="alert alert-info">Please take a screenshot and contact administrator of: <i class="text-secondary">https://mwananchi.herokuapp.com</i></div>
		<div class="alert alert-danger">
			<?php
				die(mysqli_connect_error()."<br><br>Cannot Connect to Database Thus Site is Shutting Down.");
			?>
		</div>
	</div>
</body>
</html>
