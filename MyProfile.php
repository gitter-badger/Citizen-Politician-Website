<?php
$photo;
session_start();
if(!isset($_SESSION["username"])){
	header("Location: HomePage.php");
	return;
}
if($_SESSION['gender']==='male'){
	$photo='user.png';
}else{
	$photo='userFemale.png';
}
require "Connection.php";
$user=$_SESSION["username"];
$sql = "select * from citizen_profile where userName='$user';select * from admin_profile where adminUserName='$user';select * from politician_profile where userName='$user'";
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
<body style="background-color: whitesmoke">
	<div class="container-fluid">
		<nav class="navbar bg-info navbar-light navbar-expand-lg fixed-top" style="border-radius: 5px;">
			<a class="navbar-brand text-dark" href="StartAdmin.php" style="font-family: Cookie,cursive;font-size: 24px;padding-bottom: 2px;padding-top: 2px;"><i class="fas fa-user"></i> Mwananchi</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#smallScreen" style="outline: none;">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="smallScreen">
				<ul class="navbar-nav mr-auto">
			      <li class="nav-item navigationBar">
			        <a class="nav-link text-light" href="StartAdmin.php">Home</a>
			      </li>
			      <li class="nav-item navigationBar">
			        <a class="nav-link text-light" href="BugReport.php">Bug Report</a>
			      </li>
			      <li class="nav-item navigationBar">
			        <a class="nav-link text-light" href="ContactsPage.php">Contacts</a>
			      </li> 
			      <li class="nav-item navigationBar">
			        <a class="nav-link text-light" href="HelpPage.php">Help</a>
			      </li> 
			    </ul>
			    <ul class="navbar-nav">
			    	<li class="nav-item navigationBar"><a class="nav-link text-light" href="Settings.php"><span class="fas fa-cog"></span> Settings</a></li>
			    	<li class="nav-item dropdown navigationBar"><a class="nav-link dropdown-toggle text-light" data-toggle="dropdown" href=""><span class="rounded-circle"><img src="<?php echo $photo; ?>" width="25px" height="25px"></span> My Profile </a>
			    		<div class="dropdown-menu bg-info" style="padding: 3px;border-radius: 5px;padding-top: 13px">
			    			<a class="dropdown-item text-dark" href="">@ <?php echo $_SESSION["username"]; ?></a><hr>
				    			<a class="dropdown-item text-dark" href="Stories.php">Recent Stories</a>
				    			<a class="dropdown-item text-dark" href="Functions.php">Functions</a>
				    			<a class="dropdown-item text-dark" href="SiteSettings.php">Site Settings</a>
				    			<a class="dropdown-item text-dark" href="SendEmails.php">Send Emails</a>
				    			<a class="dropdown-item text-dark" href="RegisterAdmin.php">Add Admin</a>
				    			<a class="dropdown-item text-dark" href="AdminDelete.php">Delete Accounts</a>
				    			<a class="dropdown-item text-dark" href="Logout.php">Logout</a>
			    		</div>
			    	</li>
			    </ul>
			</div>
		</nav>
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