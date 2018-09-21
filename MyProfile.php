<?php
session_start();
if(!isset($_SESSION["username"])){
	header("Location: HomePage.php");
	return;
}
?>
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
<body style="background-color: whitesmoke">
	<div class="container-fluid">
		<?php
			require 'NavBar.php';
		?>

		<div class="container" style="position: relative;top: 120px">
			<form>
				<fieldset style="padding: 20px;background-image: linear-gradient(-180deg,whitesmoke 10%,white 90%);border-radius: 15px;">
					<legend class="text-info">My Profile</legend>
					<div>
						<img src="<?php echo $photo; ?>" class="float-right img-thumbnail" alt="Profile Photo">
					</div><br><br><br><br><br><br>
					<b>Username: </b><?php echo $_SESSION["username"]; ?><br><br>
					<b>Account Type: </b><?php echo $_SESSION["usertype"]; ?><br><br>
					<b>Gender: </b><?php echo $_SESSION["gender"]; ?><br><br>
					<?php
					$user=$_SESSION["username"];
					$sql = "select * from citizen_profile where userName='$user';select * from admin_profile where adminUserName='$user';select * from politician_profile where userName='$user'";
					if($_SESSION["usertype"]!=='admin'){
						if (mysqli_multi_query($connection,$sql)){
  							do{
    							if ($result=mysqli_store_result($connection)) {
    								if(mysqli_num_rows($result)>0){
    									if($row=mysqli_fetch_row($result)){
		      								for ($i=0;;$i++){
		      									if(isset($row[$i])){
		      										echo $row[$i]."<br><br>";
		      										continue;
		      									}
		      									break;
									        }
									    }
								    }
	      							mysqli_free_result($result);
      							}
    						}while (mysqli_next_result($connection));
						}
					}
					?>
					<button type="button" class="btn btn-info"><a href="Settings.php" class="text-light">Change</a></button>
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>