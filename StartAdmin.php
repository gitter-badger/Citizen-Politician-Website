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
	<?php
		session_start();
		if(!isset($_SESSION['username'])){
			header("Location: HomePage.php");
		}
		$photo=$_SESSION["photo"];
		require "Connection.php";
	?>
	<div class="container-fluid">
		<nav class="navbar bg-info navbar-light navbar-expand-lg fixed-top" style="border-radius: 5px;">
			<a class="navbar-brand text-dark" href="" style="font-family: Cookie,cursive;font-size: 24px;padding-bottom: 2px;padding-top: 2px;"><i class="fas fa-user"></i> Mwananchi</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#smallScreen" style="outline: none;">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="smallScreen">
				<ul class="navbar-nav mr-auto">
			      <li class="nav-item here">
			        <a class="nav-link text-light" href="">Home</a>
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
			    	<li class="nav-item" style="width: 50px;text-align: center;white-space: nowrap;"><a class="nav-link text-light" href="Notifications.php"><span class="fas fa-bell"></span> <sup class="badge badge-dark" style="text-align: center;white-space: nowrap;"><?php
			    			$userName=$_SESSION['username'];
			    			$notifications=$connection->query("select notification from notifications where target='$userName' and isRead=0;");
			    			echo (mysqli_num_rows($notifications)>0) ? mysqli_num_rows($notifications):"";
			    		?></sup></a></li>
			    	<li class="nav-item dropdown navigationBar"><a class="nav-link dropdown-toggle text-light" data-toggle="dropdown" href=""><span class="rounded-circle"><img src="<?php echo $photo; ?>" width="25px" height="25px"></span> My Profile </a>
			    		<div class="dropdown-menu bg-info" style="padding: 3px;border-radius: 5px;padding-top: 13px">
			    			<a class="dropdown-item text-dark" href="MyProfile.php">@ <?php echo $_SESSION["username"]; ?></a><hr>
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

		<div class="container" style="position: relative;top: 100px;">
			<div class="alerts"></div>
			<script>
				var temp=Cookies.get("alert");
				if(temp!==undefined){
					$(".alerts").addClass("alert").addClass("alert-success").html(temp)
					Cookies.remove("alert")
				}
			</script>
			<table class="table table-borderless">
				<thead>
					<tr><td colspan="4"><div class="jumbotron"><span class="display-4">Account Verification</span><br><small>The following accounts need verification in order to become active.</small></div></td><tr>
				</thead>
				<tr>
					<?php
						$stmt=$connection->query("select * from politician_profile left join politician_politics on politician_profile.userName=politician_politics.userName where accountVerified=0");
						if(mysqli_num_rows($stmt)>0){
							for($counter=0;($row=$stmt->fetch_array(MYSQLI_NUM)) && $counter < 4;$counter++){
								echo "<td><div class='card' style='width:250px;'><img class='card-img-top' src='$row[8]' alt='Card image'><div class='card-body'><h4 class='card-title' style='font-size: 30px'>$row[0]</h4><p class='card-text' style='white-space: nowrap;overflow-x: hidden;'><b>Email:</b> $row[1]<br><b>Phone:</b> $row[3]<br><b>Gender:</b> $row[5]<br><b>Full Names:</b> $row[12]<br><b>Political Seat:</b> $row[14]<br></p><a href='' class='btn btn-primary'>See Profile</a> <a href='' class='btn btn-danger' id='$row[0]'> Verify Acc </a></div></div></td>";
							}
						}else{
							echo "<td colspan='4'><h4>Nothing to display here<h4></td>";
						}
					?>
				</tr>
				<?php if(mysqli_num_rows($stmt)>4) echo "<tr><td colspan='4'><a class='text-info' href='ViewerProfile.php'>See All Accounts</a></td></tr>"; ?><br>
				<tr><td colspan="4"><div class="jumbotron"><span class="display-4">Achievement Verification</span><br><small>The following achievements need verification to ensure they are correct and free from propaganda.</small></div></td></tr>
				<tr><td colspan="4"><div class="jumbotron"><span class="display-4">Critique Verification</span><br><small>The following critiques need verification to ensure they are correct and free from propaganda.</small></div></td></tr>
				<tr><td colspan="4"><div class="jumbotron"><span class="display-4">Comment Verification</span><br><small>The following comments need verification to ensure they are free from insults to other users or the politician in question.</small></div></td></tr>
				<tr><td colspan="4"><div class="jumbotron"><span class="display-4">Reports</span><br><small>The following Reports were made by the users of the site.</small></div></td></tr>
				<tr><td colspan="4"><div class="jumbotron"><span class="display-4">Bugs</span><br><small>The following bugs were reported to distract user experience.</small></div></td></tr>
			</table>
	</div>
	<script>
		$(".btn-danger").click(event=>{
			event.preventDefault();
			$.post("VerifyPolitician.php",{user:$(event.currentTarget).attr("id")},data=>{
				if(data.localeCompare("Account successfully verified")===0){
					$(event.currentTarget).removeClass("btn-danger").addClass("btn-success").html("Verified");
				}
				$(".alerts").addClass("alert").addClass("alert-info").html(data)
				$("body,html").animate({scrollTop:0},'fast')
			})
		})
	</script>
</body>
</html>