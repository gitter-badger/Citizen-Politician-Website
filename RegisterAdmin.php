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
	<script src="MainJS.js"></script>
</head>
<body style="background-color: whitesmoke">
<div class="container-fluid">
	<?php
	require 'NavBar.php';
	?>
	<div class="container" id="signUp" style="position: relative;top: 100px;">
		<div id="alerts"></div>
		<form style="padding: 15px;padding-top: 35px;" method="post" action="AdminRegister.php" enctype="multipart/form-data">
			<fieldset style="padding: 20px;border-radius: 10px;background-color: whitesmoke;background-image: linear-gradient(-180deg,whitesmoke 10%,white 90%);">
				<legend class="text-info">Register an Admin</legend>
				<div class="form-group">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="user" id="user" placeholder="Username" required="">
					    <div class="input-group-append">
					      	<span class="input-group-text fa" id="1"></span>
					    </div>
					</div>
				</div>
				<div id="userError"></div>
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
					      	<span class="input-group-text" id="showSecret" style="cursor: pointer;"><img src="eye-icon.png" style="width: 23px;height: 23px;"></span>
					    </div>
						<input type="password" class="form-control" name="secret" id="secret" placeholder="Password" required="">
						<div class="input-group-append">
						   	<span class="input-group-text fa" id="4"></span>
						</div>
					</div>
				</div>
				<div id="secretError"></div>
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
					      	<span class="input-group-text" id="showSecretRe" style="cursor: pointer;"><img src="eye-icon.png" style="width: 23px;height: 23px;"></span>
					    </div>
						<input type="password" class="form-control" name="secretRe" id="secretRe" placeholder="Repeat Password" required="">
					    <div class="input-group-append">
					      	<span class="input-group-text fa" id="5"></span>
					    </div>
					</div>
				</div>
				<div id="secretReError"></div>
				<div class="form-group mb-3">
					<label>Gender: </label>
					<div class="custom-control custom-radio">
					    <input type="radio" class="custom-control-input" id="male" name="gender" value="male" required="">
					    <label class="custom-control-label" for="male">Male</label>
					</div>
					<div class="custom-control custom-radio">
						<input type="radio" class="custom-control-input" id="female" name="gender" value="female" required="">
					    <label class="custom-control-label" for="female">Female</label>
					</div>
				</div><br>
				<div class="form-group mb-3">
					<button type="submit" class="btn btn-info">Submit</button>
				</div>
			</fieldset>
		</form>
	</div>


	<div class="container" style="position: relative;top: 150px;" id="reset">
		<form id="passChange" style="padding: 15px;padding-top: 35px;" method="POST" action="adminReset.php" enctype="multipart/form-data">
			<fieldset style="padding: 20px;border-radius: 10px;background-color: whitesmoke;background-image: linear-gradient(-180deg,whitesmoke 10%,white 90%);">
				<legend class="text-info">Reset Other Admin's Password</legend>
				<div class="form-group">
					<div class="input-group mb-3">
						<input type="email" onkeyup="checkEmail()" class="form-control" name="email" id="email" placeholder="Enter email to send password reset instructions . . . " required="">
					    <div class="input-group-append">
					      	<span class="input-group-text fa" id="6"></span>
					    </div>
					</div>
				</div>
				<input type="text" name="passcode" id="passcode" style="display: none">
				<div id="emailError"></div>
				<div class="form-group">
					<div class="input-group mb-3">
						<input type="text" class="form-control" onkeyup="checkAdmin()" name="admin" id="admin" placeholder="Enter admin's Username . . ." required="">
						<div class="input-group-append">
						   	<span class="input-group-text fa" id="7"></span>
						</div>
					</div>
				</div>
				<div id="adminError"></div>
				<br>
				<div class="form-group mb-3">
					<button type="submit" class="btn btn-info">Submit</button>
				</div>
			</fieldset>
		</form>
	</div>

	<div class="container mb-5" style="position: relative;top: 150px;">
		<div style="padding: 35px;border-radius: 10px;background-color: whitesmoke;background-image: linear-gradient(-180deg,whitesmoke 10%,white 90%);">
			<legend class="text-info">Password Reset Log</legend>
			<input class="form-control mb-3" type="text" placeholder="Search for specific request . . . " onkeyup="toggle(this)">
			<script>
				function toggle(event){
					var value = $(event).val().toLowerCase();
					var array= value.split(",")
				    $('.all').filter(function() {
				    	var count=0;
				    	for(var i=0;i<array.length;i++){
				    		if($(this).text().toLowerCase().indexOf(array[i])>-1){
				    			count++
				    		}
				    	}
				    	if(count!==array.length){
				    		$(this).hide()
				    	}else{
				    		$(this).show()
				    	}
				    });
				}
			</script>
			<?php
				$user=$_SESSION['username'];
				date_default_timezone_set("Africa/Nairobi");
				$stmt=$connection->query("select requestor,timestamp,photo,used from emailGetCredentials left join admin_profile on adminUserName=requestor where userEmail='$user' and type='password' order by timestamp desc");
				if($stmt){
					if(mysqli_num_rows($stmt)>0){
						while($row=$stmt->fetch_array(MYSQLI_NUM)){
							$used=($row[3]==="0") ? "This request has not yet been used.":"This request has been used.";
							echo "<div class='media border mb-3 p-3 all'><img src='$row[2]' alt=$row[0] class='align-self-start mr-3 mt-3 rounded-circle' style='width:60px;'><div class='media-body'><h4>$row[0] <small style='font-size:14px;'><i>Requested on ".date_format(date_create($row[1]),'F d,Y h:i a')."</i></small></h4><p>$used</p></div></div>";
						}
					}else{
						echo "<div>Nothing to display here</div>";
					}
				}else{
					echo "<div class='alert alert-danger'>$connection->error</div>";
				}
			?>
		</div>
	</div>
</div>
<script>
	var non=Cookies.get("none")
	if(non!==undefined){
		$("div#adminError").addClass("alert").addClass("alert-danger").html("The username does not exist in our databases or the username belongs to you.")
		$("#admin").val(non)
		$("body,html").animate({scrollTop:$("#emailError").offset().top},'slow')
		Cookies.remove('none')
	}
	var success=Cookies.get("success")
	if(success!==undefined){
		$("div#alerts").addClass("alert").addClass("alert-success").html(success)
		Cookies.remove('success')
	}
	var dup=Cookies.get("duplicate")
	if(dup!==undefined){
		$("div#userError").addClass("alert").addClass("alert-danger").html("Username already exists.")
		$("#user").val(dup)
		Cookies.remove('duplicate')
	}
	function checkEmail(){
		var email=$("#email").val().trim()
		var posAt=email.indexOf("@")
		var posDot=email.lastIndexOf(".")
		if(email.length===0){
			$("span#6").removeClass("fa-times").removeClass("fa-check")
			return;
		}
		if(posAt<1||(posAt+2)>posDot||(posDot+2)>=email.length){
			$("span#6").removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return;
		}
		$("span#6").removeClass("fa-times").addClass("fa-check").css("color","limegreen")
	}
	function checkAdmin(){
		var user=$("#admin").val().trim()
		if(user.length===0){
			$("span#7").removeClass("fa-times").removeClass("fa-check")
			return;
		}
		$.post("checkAdmin.php",{admin:user},data=>{
			if(data.localeCompare("true")===0){
				$("span#7").removeClass("fa-times").addClass("fa-check").css("color","limegreen")
			}else if(data.localeCompare("false")===0){
				$("span#7").removeClass("fa-check").addClass("fa-times").css("color","indianred")
			}else{
				$("span#7").removeClass("fa-times").removeClass("fa-check")
				$("#adminError").addClass("alert").addClass("alert-danger").html(data)
			}
		})
	}

	function makeid(integer) {
	  var text = "";
	  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	  for (var i = 0; i < integer; i++)
	    text += possible.charAt(Math.floor(Math.random() * possible.length));

	  return text;
	}

	$("#passChange").submit(()=>{
		var email=$("#email").val().trim()
		var posAt=email.indexOf("@")
		var posDot=email.lastIndexOf(".")
		if(posAt<1||(posAt+2)>posDot||(posDot+2)>=email.length){
			$("#emailError").addClass("alert").addClass("alert-danger").html("Email is not of correct format")
			return false;
		}
		var passcode=makeid(Math.floor(Math.random()*20)+10)
		$("#passcode").val(passcode)
		return true;
	})
</script>
</body>
</html>