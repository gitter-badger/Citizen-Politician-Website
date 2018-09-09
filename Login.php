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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
	<script>Cookies.remove('invalid')</script>;
<?php
	$user=htmlspecialchars($_POST["userName"]);
	$pass=htmlspecialchars($_POST["passWord"]);
	require "Connection.php";
	$pst=$connection->prepare("select * from admin_profile where adminUserName=?");
	if($pst){
		if($pst->bind_param("s",$user)){
			if($pst->execute()){
				if($set=$pst->get_result()){
					if(mysqli_num_rows($set)>0){
						while($row=$set->fetch_array(MYSQLI_NUM)){
					    	if($row[1]===$pass){
					    		session_start();
					    		$_SESSION["username"]=$user;
					    		$_SESSION["password"]=$pass;
					    		$_SESSION["usertype"]=$row[3];
					    		$_SESSION["gender"]=$row[2];
					    		echo "<script>location.replace('StartAdmin.php')</script>";
					    		return;
					    	}
					    	echo "<script>Cookies.set('invalid','password');location.replace('HomePage.php')</script>";
					    	return;
					    }
					}else{
						echo "<script>Cookies.set('invalid','username');location.replace('HomePage.php')</script>";
						return;
					}
				}
			}
		}
	}
?>
<br><br>
	<div class="container alert alert-danger">
		<h1 class="jumbotron text-secondary"><i class="fas fa-exclamation-triangle"></i> Error Logging in. <i class="fas fa-exclamation-triangle"></i></h1>
		<div class="alert alert-info">Please take a screenshot and contact administrator of: <i class="text-secondary">https://mwananchi.herokuapp.com</i><br><strong>DO NOT TRY TO FIX ON YOUR OWN!</strong><br>We are sorry for any inconveniences this might have caused to you.</div>
		<div class="alert alert-danger"><i>
			<?php
				die($connection->error."<br><br>Cannot Login Thus Site is Shutting Down.");
			?>
		</i></div>
	</div>
</body>
</html>