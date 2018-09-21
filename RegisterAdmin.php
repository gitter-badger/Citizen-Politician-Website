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
</div>
<script>
	var dup=Cookies.get("duplicate")
	if(dup!==undefined){
		$("div#userError").addClass("alert").addClass("alert-danger").html("Username already exists.")
		$("#user").val(dup)
		Cookies.remove('duplicate')
	}
</script>
</body>
</html>