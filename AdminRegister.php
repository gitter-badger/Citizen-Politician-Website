<!DOCTYPE html>
<html lang="en">
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	$user=htmlspecialchars($_POST["user"]);
	$pass=htmlspecialchars($_POST["secret"]);
	$gender=htmlspecialchars($_POST["gender"]);
	$photo=($gender==="male")?"user.png":"userFemale.png";
	require "checkUser.php";
	if($return==='true'){
		echo "<script>Cookies.set('duplicate',\"".$user."\");location.replace('RegisterAdmin.php')</script>";
		return;
	}
	$pst=$connection->prepare("insert into admin_profile(adminUserName,adminPassword,userGender,photo) values (?,?,?,?)");
	if($pst){
		if($pst->bind_param("ssss",$user,$pass,$gender,$photo)){
			if($pst->execute()){
				echo "<script>Cookies.set('alert','$user has been added to the admin list successfully.');location.replace('StartAdmin.php')</script>";
				return;
			}
		}
	}
?>
<br><br>
<div class="container alert alert-danger">
	<h1 class="jumbotron text-secondary"><i class="fas fa-exclamation-triangle"></i> Error Adding an admin. <i class="fas fa-exclamation-triangle"></i></h1>
	<div class="alert alert-danger"><i>
		<?php
			die($connection->error."<br><br>Cannot Add Admin Thus Site is Shutting Down.");
		?>
	</i></div>
	</div>
</body>
</html>