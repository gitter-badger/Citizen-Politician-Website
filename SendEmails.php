<?php
session_start();
if(!isset($_SESSION["username"])||$_SESSION["usertype"]!=="admin"){
	header("Location: Homepage.php");
	return;
}
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</head>
<body style="background-color: whitesmoke;">
	<?php
		require 'NavBar.php';
	?>
	<div class="container-fluid">
		<div class="navigatorUp" style="display: none;position: fixed;bottom: 30px;left: 20px;z-index: 99;">
			<a class="rounded-circle fa fa-arrow-up text-secondary" style="background-color: rgba(0,0,0,0.3);padding: 15px;" href=""></a>
		</div>
		<div class="navigatorDown" style="position: fixed;bottom: 30px;right: 20px;z-index: 99;">
			<a class="rounded-circle fa fa-arrow-down text-secondary" style="background-color: rgba(0,0,0,0.3);padding: 15px;" href=""></a>
		</div>
		<div class="container" ng-app="app" ng-controller="myctrl" id="emails" style="background-color: slategray;position: relative;top: 120px;padding: 15px;margin-bottom: 50px;border-radius: 4px;">
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
					    <input style="font-family: courier new;font-size: 16px;" class="form-control" type="text" id="from" name="from" value="<?php $file=fopen('Resources/Site Data/SiteEmail.txt','r'); echo fgets($file); fclose($file)?>" readonly="">
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
				<textarea id="mail" style="font-family: courier new;font-size: 16px;" class="form-control mb-3" rows="15"></textarea>
				<button id="sendEmail" ng-click="sendEmail()" style="font-family: cursive;width:100px" class="btn btn-primary float-right">Send</button>
			</form><br>
		</div>

		<script>
			angular.module("app",[]).controller("myctrl",function($scope){
				$scope.receivers=[];
				$scope.addReceivers=function(){
					$(".alerts").removeClass("alert").removeClass("alert-info").html("")
					var temp=$("#to").val().trim()
					if(temp.length>2 && $.inArray(temp.toLowerCase(),$scope.receivers)===-1){
						$.post("checkUsername.php",{user:temp},data=>{
							if(data.localeCompare("true")===0){
								$scope.$apply(()=>{
									$scope.receivers.push(temp.toLowerCase());
								})
							}else{
								$(".alerts").addClass("alert").addClass("alert-info").html(data)
							}
						})
					}else{
						if(temp.length<3){
							$(".alerts").addClass("alert").addClass("alert-info").html("Recipient name length too short!")
						}else if($.inArray(temp.toLowerCase(),$scope.receivers)===0){
							$(".alerts").addClass("alert").addClass("alert-info").html("Recipient already registered!")
						}
						$("body,html").animate({scrollTop:0},'slow')
					}
					$("#to").val("")
					$("#to").focus()
				};
				$scope.removeReceivers=function($event){
					var temp=$event.currentTarget.id
					var index=$scope.receivers.indexOf(temp)
					$scope.receivers.splice(index,1);
				}
				$scope.sendEmail=function(){
					if($scope.receivers.length<1){
						$(".alerts").addClass("alert").addClass("alert-info").html("You need to add atleast 1 recipient.")
						$("body,html").animate({scrollTop: 0},'slow')
						return
					}
					var users=JSON.stringify($scope.receivers);
					var subject=$("#subject").val().trim()
					var message=$("#mail").val().trim()
					$("#sendEmail").attr("disabled","").addClass("disabled").text("Sending...")
					$.post("emailSend.php",{users:users,subject:subject,message:message},data=>{
						$(".alerts").addClass("alert").addClass("alert-info").html(data)
						$("#sendEmail").removeAttr("disabled").removeClass("disabled").text("Send")
						$("body,html").animate({scrollTop: 0},'slow')
					})
					$scope.receivers=[]
					$("#subject").val("")
					$("#mail").val("")
					$("#to").val("")
				}
			});
			$("#addReceiver,#sendEmail").click(event=>{
				event.preventDefault()
			})
			$("form").submit(event=>{
				event.preventDefault()
			})
			$(window).scroll(()=>{
				if($(window).scrollTop()<screen.height){
					$("div.navigatorUp").css({display:"none"})
					$("div.navigatorDown").css({display:"block"})
				}else if($(window).scrollTop()>=($(document).height()-2.5*screen.height)){
					$("div.navigatorUp").css({display:"block"})
					$("div.navigatorDown").css({display:"none"})
				}else{
					$("div.navigatorUp").css({display:"block"})
					$("div.navigatorDown").css({display:"block"})
				}
			})
			$("div.navigatorUp>a").click(event=>{
				event.preventDefault()
				$("body,html").animate({scrollTop:0},'slow')
			})
			$("div.navigatorDown>a").click(event=>{
				event.preventDefault()
				$("body,html").animate({scrollTop:$(document).height()},'slow')
			})
		</script>

		<div class="container" id="notifications" style="background-color: slategray;position: relative;top: 120px;padding: 15px;margin-bottom: 100px;border-radius: 4px;">
			<div class="jumbotron mb-5"><span class="display-4">Send a Notification.</span><br> <small>Here you can send a notification to specific groups of users. Notifications can be viewed on the notifications page.</small></div>
			<div class="messages"></div>
			<script>
				var mess=Cookies.get("message");
				if(mess!==undefined){
					$(".messages").addClass("alert").addClass("alert-info").html(mess)
					Cookies.remove("message")
					$("body,html").animate({scrollTop: $("#notifications").offset().top},'slow')
				}
			</script>
			<form  method="post" action="sendNotifications.php" enctype="multipart/form-data">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" style="font-family: Cookie,cursive;width: 60px;">To:</span>
						</div>
						<select class="custom-select" name="target" style="cursor: pointer;">
							<option value="all">All</option>
							<option value="citizen_profile">Citizens</option>
							<option value="politician_profile">Politicians</option>
							<option value="admin_profile">Admins</option>
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
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" style="font-family: Cookie,cursive;width: 60px;">Type:</span>
						</div>
						<select class="custom-select" name="type" style="cursor: pointer;">
							<option value="Important">Important</option>
							<option value="Activity">Site Activity</option>
							<option value="Changes">Change Log</option>
							<option value="Other">Other</option>
						</select>
					</div>
				</div>
				<textarea required="" style="font-family: courier new;font-size: 16px;" class="form-control mb-3" name="message" rows="15"></textarea>
				<button class="btn btn-info" style="width: 100px;">Send</button>
			</form>
		</div>
	</div>
</body>
</html>