<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mwananchi</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png" href="MwananchiIcon.png">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

</head>
<body style="background-color: whitesmoke;">
	<br><br>
	<div class="container alert alert-success">
		<h1 class="jumbotron text-secondary"><i class="fas fa-exclamation-triangle"></i> Password Reset Functionality. <i class="fas fa-exclamation-triangle"></i></h1>
		<div class="alert alert-info"><i>
			<?php
				function randomize($length) {
				    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				    $charactersLength = strlen($characters);
				    $randomString = '';
				    for ($i = 0; $i < $length; $i++) {
				        $randomString .= $characters[random_int(0, $charactersLength - 1)];
				    }
				    return $randomString;
				}
				require 'Connection.php';
				$id=$_GET['id'];
				$checker=$_GET['encodedPassCode'];
				$stmt=$connection->prepare("select * from emailGetCredentials where passCode=?");
				if($stmt){
					if($stmt->bind_param("s",$checker)){
						if($stmt->execute()){
							if($result=$stmt->get_result()){
								if(mysqli_num_rows($result)>0){
									while($row=$result->fetch_array(MYSQLI_NUM)){
										if(password_verify($row[1],$id)){
											date_default_timezone_set("Africa/Nairobi");
											$currtime=date("Y-m-d H:i:s");
											$timeSent=$row[4];
											$diff=strtotime($currtime)-strtotime($timeSent);
											if(($diff/60)>15){
												echo "Your request has timed out. Please request for another password reset email.";
											}else{
												$stmt=$connection->query("delete from emailGetCredentials where eventID=$row[0]");
												if($stmt){
													$newPass=randomize(random_int(10,20));
													$encryptPass=password_hash($newPass,PASSWORD_DEFAULT);
													$stmt="update citizen_profile set Secret='$encryptPass' where Username='$id' or Email='$id';update politician_profile set password='$encryptPass' where userName='$id' or email='$id'";
													if(mysqli_multi_query($connection,$stmt)){
														echo "Your new password is $newPass. You can now use it to log into your account";
													}
												}
											}
										}else{
											echo "This email is not recognised by our system thus password cannot be reset.";
										}
									}
								}else{
									echo "This ($checker) passcode is not recognised by our system thus password cannot be reset.";
								}
							}
						}
					}
				}
				echo $connection->error;
			?>
		</i></div>
	</div>
</body>
</html>