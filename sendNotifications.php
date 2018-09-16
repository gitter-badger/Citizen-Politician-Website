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
<body style="background-color: lavender;">
<?php
	$target=htmlspecialchars($_POST['target']);
	$sender=substr(htmlspecialchars($_POST['sender']),1);;
	$subject=htmlspecialchars($_POST['subject']);
	$type=htmlspecialchars($_POST['type']);
	$notification=htmlspecialchars($_POST['message']);
	require 'Connection.php';
	$id=$connection->query("select count(notification) from notifications");
	if($target==="all"){
		$admin=$connection->query("select adminUserName from admin_profile union all select UserName from citizen_profile union all select userName from politician_profile");
		if($admin&&$id){
			if(mysqli_num_rows($admin)>0){
				if($idNo=$id->fetch_array(MYSQLI_NUM)){
					while($row=$admin->fetch_array(MYSQLI_NUM)){
						$idNo[0]++;
						$stmt=$connection->prepare("insert into notifications(notificationID,subject,notification,target,sender,type) values (?,?,?,?,?,?)");
						$stmt->bind_param("isssss",$idNo[0],$subject,$notification,$row[0],$sender,$type);
						$stmt->execute();
					}
					if(!$connection->error){
						echo "<script>Cookies.set('message','Successfully sent Notification to all users');location.replace('SendEmails.php')</script>";
						return;
					}
				}
			}else{
				echo "<script>Cookies.set('message','Database is empty. Unable to send notification');location.replace('SendEmails.php')</script>";
			}
		}
	}else{
		$select=($target==="admin_profile")?"adminUserName":"no";
		$user=($select==="no")?"UserName":"adminUserName";
		$admin=$connection->query("select $user from $target");
		if($admin&&$id){
			if(mysqli_num_rows($admin)>0){
				if($idNo=$id->fetch_array(MYSQLI_NUM)){
					while($row=$admin->fetch_array(MYSQLI_NUM)){
						$idNo[0]++;
						$stmt=$connection->prepare("insert into notifications(notificationID,subject,notification,target,sender,type) values (?,?,?,?,?,?)");
						$stmt->bind_param("isssss",$idNo[0],$subject,$notification,$row[0],$sender,$type);
						$stmt->execute();
					}
					if(!$connection->error){
						echo "<script>Cookies.set('message','Successfully sent Notification to specified users.');location.replace('SendEmails.php')</script>";
						return;
					}
				}
			}else{
				echo "<script>Cookies.set('message','Database is empty. Unable to send notification');location.replace('SendEmails.php')</script>";
			}
		}
	}
?>
<br><br>
	<div class="container alert alert-danger">
		<h1 class="jumbotron text-secondary"><i class="fas fa-exclamation-triangle"></i> Error Sending Notification. <i class="fas fa-exclamation-triangle"></i></h1>
		<div class="alert alert-info">Please take a screenshot and contact administrator of: <i class="text-secondary">https://mwananchi.herokuapp.com</i><br><strong>DO NOT TRY TO FIX ON YOUR OWN!</strong><br>We are sorry for any inconveniences this might have caused to you.</div>
		<div class="alert alert-danger"><i>
			<?php
				die($connection->error."<br><br>Failed to send Notification.");
			?>
		</i></div>
	</div>
</body>
</html>