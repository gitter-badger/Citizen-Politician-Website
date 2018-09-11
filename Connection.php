<?php
	$connection=mysqli_connect("192.168.0.19:3306","root","biggie5941","Citizen-Politician Website");
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

</head>
<body style="background-color: lavender;">
	<br><br>
	<div class="container alert alert-danger">
		<h1 class="jumbotron text-secondary"><i class="fas fa-exclamation-triangle"></i> Error Establishing Connection to database. <i class="fas fa-exclamation-triangle"></i></h1>
		<div class="alert alert-info">Please take a screenshot and contact administrator of: <i class="text-secondary">https://mwananchi.herokuapp.com</i><br><strong>DO NOT TRY TO FIX ON YOUR OWN!</strong><br>We are sorry for any inconveniences this might have caused to you.</div>
		<div class="alert alert-danger"><i>
			<?php
				die(mysqli_connect_error()."<br><br>Cannot Connect to Database Thus Site is Shutting Down.");
			?>
		</i></div>
	</div>
</body>
</html>
