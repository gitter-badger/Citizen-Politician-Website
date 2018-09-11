<?php
	require "Connection.php";
	session_start();
	session_destroy();
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
	<link rel="stylesheet" type="text/css" href="MainCSS.css">
	<link rel="stylesheet" type="text/css" href="PhoneMainCSS.css">
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
	<script src="MainJS.js"></script>
</head>
<body>
	<div class="container-fluid home">
		<nav class="navbar bg-info navbar-light navbar-expand-lg" style="border-radius: 5px;">
			<a class="navbar-brand text-dark" href="" style="font-family: Cookie,cursive;font-size: 24px;padding-bottom: 2px;padding-top: 2px;"><i class="fas fa-user"></i> Mwananchi</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#smallScreen" style="outline: none;">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="smallScreen">
				<ul class="navbar-nav">
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
			</div>
		</nav>
		<div class="Main">
			<div class="Mini">
				<ul class="nav nav-tabs">
					<li class="nav-item">
				    	<a class="nav-link active" data-toggle="tab" href="#signIn">Login</a>
				  	</li>
				  	<li class="nav-item">
				    	<a class="nav-link" data-toggle="tab" href="#signUp">Sign Up</a>
				  	</li>
				</ul>

				<div class="tab-content" style="border: 1px ridge rgb(255,255,255,0.5);border-radius: 10px;border-top-left-radius: 0px;border-top-right-radius: 0px;background-color: whitesmoke;">
					<div class="tab-pane container active" id="signIn">
						<form style="padding: 15px;padding-top: 35px;" method="post" action="Login.php" enctype="multipart/form-data">
							<div id="log"></div>
							<div class="form-group">
								<div class="input-group mb-3">
								    <div class="input-group-prepend">
								      	<span class="input-group-text">@</span>
								    </div>
								    <input type="text" class="form-control" name="userName" id="userName" placeholder="Username or Email" required="">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="password" class="form-control" id="passWord" name="passWord" placeholder="Password" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text" id="show" style="cursor: pointer;"><img src="eye-icon.png" style="width: 23px;height: 23px;"></span>
								    </div>
								</div>
							</div>
							  	<div class="form-group form-check" style="padding-left: 0px">
							    	<a class="text-info" href="">Forgot Password</a>
							  	</div>
							  <button type="submit" class="btn btn-info">Submit</button>
						</form>
					</div>

					<div class="tab-pane container fade" id="signUp">
						<form style="padding: 15px;padding-top: 35px;" method="post" enctype="multipart/form-data">
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
									<input type="email" class="form-control" name="email" id="email" placeholder="Email" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text fa" id="2"></span>
								    </div>
								</div>
							</div>
							<div id="emailError"></div>
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								      	<span class="input-group-text">+254</span>
								    </div>
									<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text fa" id="3"></span>
								    </div>
								</div>
							</div>
							<div id="phoneError"></div>
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
							<div class="form-group">
								<div class="custom-file">
									<input type="file" accept="image/png,image/jpeg" class="custom-file-input border" name="photo" id="photo" style="cursor: pointer;">
									<label for="photo" class="custom-file-label" id="labelPhoto">Profile Photo <span class="text-secondary">(Optional): </span></label>
								</div>
							</div>
							<br><br>
							<div class="form-group mb-2">
								<label for="counties"> County:</label>
								<select class="custom-select mb-3" name="counties" id="counties" style="cursor: pointer;" required="">
									<?php
										$stmt=$connection->query("Select * from counties");
										if ($stmt->num_rows > 0) {
										    while($row = $stmt->fetch_array(MYSQLI_NUM)) {
        										echo "<option id=$row[0]>$row[1]</option>";
    										}
										} else {
    										echo "<option>No Supported Counties</option>";
										}
									?>
								</select>

								<label>Account type: </label>
								<div class="custom-control custom-radio">
								    <input type="radio" class="custom-control-input" id="citizen" name="type" value="citizen" required="">
								    <label class="custom-control-label" for="citizen">Citizen</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="politician" name="type" value="politician" required="">
								    <label class="custom-control-label" for="politician">Politician</label>
								</div>
						</div><br>
						<div class="form-group mb-3">
							<button type="submit" class="btn btn-info">Submit</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var cookie=Cookies.get("invalid");
		if(cookie!==undefined){
			$("#log").addClass("alert").addClass("alert-danger").html("Invalid "+cookie+".")
		}
	</script>
</body>
</html>