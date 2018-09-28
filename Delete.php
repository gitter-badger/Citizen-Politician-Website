<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mwananchi</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png" href="MwananchiIcon.png">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body style="background-color:lavender">
<?php
	$action=htmlspecialchars($_POST["action"]);
	$user=htmlspecialchars($_POST["user"]);
	require "Connection.php";
	if($action==="delete"){
		$sql = "insert into deactivated_accounts(userName,email,emailVerified,phone,phoneVerified,gender,accountType,countyNo,photo,Password) select * from citizen_profile where UserName='$user';insert into deactivated_accounts(userName,email,emailVerified,phone,phoneVerified,gender,accountType,countyNo,photo,Password) select userName,email,emailVerified,phone,phoneVerified,gender,accountType,countyNo,photo,password from politician_profile where userName='$user';insert into deactivated_politics(userName,FullNames,DateOfBirth,PoliticalSeat,PoliticalYears,CreationTime,Vying,ConstituencyNo,WardNo) select * from politician_politics where userName='$user';insert into deactivated_education(userName,bachelors,primarySchool,secondarySchool,university,masters,phd,schoolCertificates,display,mastersCourse,phdCourse,otherCourses) select * from politician_education where userName='$user'; delete from citizen_profile where userName='$user';delete from politician_profile where userName='$user'";
	 	if(mysqli_multi_query($connection,$sql)){
	 		echo "<script>Cookies.set('success','Successfully deactivated user account with username $user.');location.replace('AdminDelete.php')</script>";
	 	}
	}else if($action==="reactivate"){
		$sql = "insert into citizen_profile(UserName,Email,verifyEmail,phone,verifyPhone,gender,type,County,photo,Secret) select * from deactivated_accounts where userName='$user' and accountType='citizen';insert into politician_profile(userName,email,emailVerified,phone,phoneVerified,gender,accountType,countyNo,photo,password) select * from deactivated_accounts where userName='$user' and accountType='politician';insert into politician_politics(userName,FullNames,DateOfBirth,PoliticalSeat,PoliticalYears,CreationDate,Vying,ConstituencyNo,WardNo) select * from deactivated_politics where userName='$user';insert into politician_education(userName,bachelors,primarySchool,secondarySchool,university,masters,phd,schoolCertificates,display,mastersCourse,phdCourse,otherCourses) select * from deactivated_education where userName='$user';update politician_profile set accountVerified=1 where userName='$user';delete from deactivated_accounts where userName='$user';delete from deactivated_politics where userName='$user';delete from deactivated_education where userName='$user';";
		if(mysqli_multi_query($connection,$sql)){
	 		echo "<script>Cookies.set('success','Successfully reactivated user account with username $user.');location.replace('AdminDelete.php')</script>";
	 	}
 	}
?>
<br><br>
	<div class="container alert alert-danger">
		<h1 class="jumbotron text-secondary"><i class="fas fa-exclamation-triangle"></i> Error Deactivating or Reactivating Account. <i class="fas fa-exclamation-triangle"></i></h1>
		<div class="alert alert-info">Please take a screenshot and contact administrator of: <i class="text-secondary">https://mwananchi.herokuapp.com</i><br><strong>DO NOT TRY TO FIX ON YOUR OWN!</strong><br>We are sorry for any inconveniences this might have caused to you.</div>
		<div class="alert alert-danger"><i>
			<?php
				echo ($connection) ? "" : $connection->error;
				echo ($stmt) ? "" : $stmt->error;
			?>
		</i></div>
	</div>
</body>
</html>