<?php
require "Connection.php";
session_start();
if(!isset($_SESSION["username"])||$_SESSION["usertype"]!=="admin"){
	header("Location: Homepage.php");
	return;
}
$photo=$_SESSION["photo"];
?>
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
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</head>
<body style="background-color: whitesmoke;">
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
			    			<a class="dropdown-item text-dark" href="RegisterAdmin.php">Add Admin</a>
			    			<a class="dropdown-item text-dark" href="AdminDelete.php">Delete Accounts</a>
			    			<a class="dropdown-item text-dark" href="Logout.php">Logout</a>
		    		</div>
		    	</li>
		    </ul>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="container bg-danger" ng-app="app" ng-controller="myctrl" id="emails" style="position: relative;top: 120px;padding: 15px;margin-bottom: 50px;border-radius: 4px;">
			<div class="jumbotron mb-5"><span class="display-4">Send an Email.</span><br> <small>Here you can send an email from the site to specific users.</small></div>
			<div class="alerts"></div>
			<form class="mb-3" style="font-family: Cookie,cursive;font-size: 24px;">
				<div class="form-group">
					<div class="input-group mb-3">
					    <div class="input-group-prepend">
					      	<span class="input-group-text" style="width: 60px;">To:</span>
					    </div>
					    <input style="font-family: courier new;font-size: 16px;" class="form-control" type="text" id="to" name="to" placeholder="Recipient">
					</div>
				</div>
				<div>
					<button style="font-family: cursive;" ng-click="addReceivers()" id="addReceiver" class="btn btn-primary float-right mb-3">Add Recipient</button>
					<div ng-repeat="one in receivers">
						<div class="alert alert-success alert-dismissible fade show mb-2" style="float: left;font-size: 18px;padding: 5px;width:100px;margin-right: 12px;overflow-x: hidden;">
								<button ng-click="removeReceivers($event)" type="button" id="{{one}}" class="close" style="font-size: 20px;outline: none;padding:7px" data-dismiss="alert">&times;</button>
								<span>{{one}}</span>
						</div>
					</div>
				</div>
			</form>
			<form class="mb-5" style="font-family: Cookie,cursive;font-size: 24px;">
				<div class="form-group">
					<div class="input-group mb-3">
					    <div class="input-group-prepend">
					      	<span class="input-group-text" style="width: 60px;">From:</span>
					    </div>
					    <input style="font-family: courier new;font-size: 16px;" class="form-control" type="text" id="from" name="from" value="mwananchi.herokuapp@gmail.com" readonly="">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group mb-5">
					    <div class="input-group-prepend">
					      	<span class="input-group-text" style="width: 60px;">Re:</span>
					    </div>
					    <input style="font-family: courier new;font-size: 16px;" class="form-control" type="text" id="subject" name="subject" placeholder="Subject">
					</div>
				</div>
				<textarea style="font-family: courier new;font-size: 16px;" class="form-control mb-3" rows="15"></textarea>
				<button id="sendEmail" ng-click="sendEmail()" style="font-family: cursive;width:100px" class="btn btn-primary float-right">Send</button>
			</form><br>
		</div>

		<script>
			angular.module("app",[]).controller("myctrl",function($scope,$window){
				$scope.receivers=[];
				$scope.addReceivers=function(){
					var temp=$("#to").val().trim()
					if(temp.length>2 && $.inArray(temp.toLowerCase(),$scope.receivers)===-1){
						$scope.receivers.push(temp.toLowerCase());
						$("#to").val("")
						$("#to").focus()
					}else{
						if(temp.length<3){
							$(".alerts").addClass("alert").addClass("alert-info").html("Recipient name length too short!")
						}else if($.inArray(temp.toLowerCase(),$scope.receivers)===0){
							$(".alerts").addClass("alert").addClass("alert-info").html("Recipient already registered!")
						}
						$("body,html").animate({scrollTop:0},'slow')
					}
				};
				$scope.removeReceivers=function($event){
					var temp=$event.currentTarget.id
					var index=$scope.receivers.indexOf(temp)
					$scope.receivers.splice(index,1);
				}
				$scope.sendEmail=function(){
					
				}
			});
			$("#addReceiver,#sendEmail").click(event=>{
				event.preventDefault()
			})
			$("form").submit(event=>{
				event.preventDefault()
			})
		</script>

		<div class="container bg-success" id="notifications" style="position: relative;top: 120px;padding: 15px;margin-bottom: 100px;border-radius: 4px;">
			<div class="jumbotron mb-5"><span class="display-4">Send a Notification.</span><br> <small>Here you can send a notification to specific groups of users. Notifications can be viewed on the notifications page.</small></div>
			<div class="messages"></div>
			<form  method="post" action="sendNotifications.php" enctype="multipart/form-data">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" style="font-family: Cookie,cursive;width: 60px;">To:</span>
						</div>
						<select class="custom-select" name="target" style="cursor: pointer;">
							<option id="all">All</option>
							<option id="citizen_profile">Citizens</option>
							<option id="politician_profile">Politicians</option>
							<option id="admin_profile">Admins</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" style="font-family: Cookie,cursive;width: 60px;">From:</span>
						</div>
						<input class="form-control" type="text" name="sender" value="<?php echo '@'.$_SESSION['username'];?>" readonly="">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" style="font-family: Cookie,cursive;width: 60px;">Re:</span>
						</div>
						<input class="form-control" type="text" name="subject" placeholder="Subject" required="">
					</div>
				</div>
				<textarea required="" style="font-family: courier new;font-size: 16px;" class="form-control mb-3" name="message" rows="15"></textarea>
				<button class="btn btn-info" style="width: 100px;">Send</button>
			</form>
		</div>
	</div>
</body>
</html>