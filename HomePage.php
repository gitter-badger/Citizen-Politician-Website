<?php
	require "Connection.php";
?>
<!DOCTYPE html>
<html>
<head lang="en">
	<title>MwanaNchi</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png" href="MwananchiIcon.png">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="MainCSS.css">
	<link rel="stylesheet" type="text/css" href="PhoneMainCSS.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="MainJS.js"></script>
</head>
<body>
	<div class="container-fluid home">
		<nav class="navbar bg-info navbar-light navbar-expand-lg" style="border-radius: 5px;">
			<a class="navbar-brand" href="" style="border: 1px ridge rgba(0,0,0,0.2);border-radius: 5px;background-image: url(MwananchiLogo.png);background-size: 100% 100%;"><pre style="font-size: 12px;">                 </pre></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#smallScreen" style="outline: none;">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="smallScreen">
				<ul class="navbar-nav">
			      <li class="nav-item here">
			        <a class="nav-link text-light" href="">Home</a>
			      </li>
			      <li class="nav-item navigationBar">
			        <a class="nav-link text-light" href="ContactsPage.php">Contacts</a>
			      </li>
			      <li class="nav-item navigationBar">
			        <a class="nav-link text-light" href="AboutPage.php">About</a>
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
						<form style="padding: 15px;padding-top: 35px;">
							<div class="form-group">
								<div class="input-group mb-3">
								    <div class="input-group-prepend">
								      	<span class="input-group-text">@</span>
								    </div>
								    <input type="text" class="form-control" id="userName" placeholder="Username or Email" required="">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="password" class="form-control" id="passWord" placeholder="Password" required="">
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
						<form style="padding: 15px;padding-top: 35px;">
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="text" class="form-control" id="user" placeholder="Username" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text fa" id="1"></span>
								    </div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="email" class="form-control" id="email" placeholder="Email" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text fa" id="2"></span>
								    </div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								      	<span class="input-group-text">+254</span>
								    </div>
									<input type="text" class="form-control" id="phone" placeholder="Phone" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text fa" id="3"></span>
								    </div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								      	<span class="input-group-text" id="showSecret" style="cursor: pointer;"><img src="eye-icon.png" style="width: 23px;height: 23px;"></span>
								    </div>
									<input type="password" class="form-control" id="secret" placeholder="Password" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text fa" id="4"></span>
								    </div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								      	<span class="input-group-text" id="showSecretRe" style="cursor: pointer;"><img src="eye-icon.png" style="width: 23px;height: 23px;"></span>
								    </div>
									<input type="password" class="form-control" id="secretRe" placeholder="Repeat Password" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text fa" id="5"></span>
								    </div>
								</div>
							</div>
							<br><br>
							<div class="form-group">
								<label for="counties"> County:</label>
								<select class="form-control" id="counties" style="cursor: pointer;">
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
							</div>
							<div class="form-group">
								<label for="accountType"> Account Type:</label>
								<select class="form-control" id="accountType" style="cursor: pointer;">
									<option id="citizen">Citizen</option>
									<option id="politician">Politician</option>
								</select>
							</div>
							<button type="submit" class="btn btn-info">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>