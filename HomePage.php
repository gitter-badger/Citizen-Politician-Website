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
	<link rel="stylesheet" type="text/css" href="Logged.css">
	<link rel="stylesheet" type="text/css" href="LoggedPhone.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="MainJS.js"></script>
</head>
<body>
	<?php
		require 'NavBar.php';
		$file=fopen("Resources/Site Data/SiteEmail.txt", "r");
		$from = fgets($file);
		fclose($file);
	?>
	<div class="row container-fluid" style="background: url(background.JPG) no-repeat top;background-size: cover;background-attachment: fixed;padding: 0px;margin: 0"><tr style="padding: 0;"><td style="padding: 0;">
		<div class="row" id="main" style="background-color: rgba(0,0,0,0.6);height: 80%;margin: 0;">
			<div class="col-lg-12" style="height: 100px"></div>
				<div class="col-lg-7 container">
					<div id="intro" class="container-fluid" style="margin: 0;word-wrap: break-word;">
					  	<div class="jumbotron" style="background-color: rgba(0,0,0,0.2);padding-top: 20px;padding-bottom: 10px;">
					    	<span class="display-4 text-light" style="font-family: Cookie,cursive;line-height: 50px;"><i class="fas fa-user"></i> Mwananchi.<br><small class="display-4 text-light" style="line-height: 20px !important;font-family: book antiqua;font-size: 30px;">A Citizen-Politician Website.</small></span>
					    	<br>
					    	<span class="text-light" style="font-family: Comic Sans MS,cursive,sans-serif;font-size: 14px;">Welcome to mwananchi website. This is the official site landing page. You can login, sign up and enjoy our services. You could also use the links above to spy across the page and see our features and contact information. Enjoy!</span><br><br>
					    	<span class="row container">
					    		<span class="col-xs-6 mb-3" style="float: left;color: ghostwhite; font-size: 14px; font-family: Work Sans, Calibri, sans-serif; font-weight: 600;line-height: 23px;">Email us: <a href="mailto:<?php echo $from;?>" style="color: #888888; font-size: 14px; font-family: Hind Siliguri, Calibri, Sans-serif; font-weight: 400;margin-right: 60px;"><?php echo $from;?></a>
					    		</span>
					    		<span class="col-xs-6 mb-3">
					    			<a target='_blank' href='https://github.com/dopesky/citizen-politician-website' style='float:left;margin-right: 30px;margin-left: 20px;display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' class="rounded-circle" style='display: block;' src='github.png' alt=''></a>
					    			<a target='_blank' href='https://twitter.com/dopesky001' style='float:left;margin-right: 30px;display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='http://i.imgur.com/Qc3zTxn.png' alt=''></a>
					    			<a target='_blank' href='https://www.facebook.com/voxy.v.mcmwenda' style='float:left;margin-right: 30px;display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='http://i.imgur.com/RBRORq1.png' alt=''></a>
					    			<a target='_blank' href='https://linkedin.com/in/kevin-kathendu-759062147' style='float:left;display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='https://cdn3.iconfinder.com/data/icons/free-social-icons/67/linkedin_circle_gray-24.png' alt=''></a>
					    		</span>
					    	</span>
					  	</div>
					</div>
				</div>
				<div class="col-lg-5 container" style="padding: 25px;padding-top: 0px;">
					<div class="container-fluid" id="loginForm">
						<ul class="nav nav-tabs">
							<li class="nav-item" style="width: 100%;">
						    	<a class="nav-link active bg-info text-light" style="border-radius: 0px;" data-toggle="tab" href="#signIn">Login</a>
						  	</li>
						</ul>

						<div class="tab-content" style="border: 1px ridge rgba(255,255,255,0.5);border-radius: 10px;border-top-left-radius: 0px;border-top-right-radius: 0px;background-color: whitesmoke;">
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
									    	<a class="text-info" href="" id="safeReset" data-toggle="modal" data-target="#forgotPassword">Forgot Password</a>
									  	</div>
									  <button type="submit" class="btn btn-info">Submit</button>
								</form>
							</div>
						</div>
					</div>
				</div>
		</div></div>

	<div class="modal" id="forgotPassword">
			<div class="modal-dialog">
			  	<div class="modal-content">
			      	<div class="modal-header">
					  	<h4 class="modal-title">Change Password</h4>
					  	<button type="button" class="close" data-dismiss="modal">&times;</button>
				  	</div>
			      	<div class="modal-body">
			      		For your password to be reset, you have to provide your working email or username and a reset url will be sent to your email.
				        <form id="passForm">
				        	<input class="form-control" type="text" id="getEmail" placeholder="Username or Email">
				        </form>
				  	</div>
				    <div class="modal-footer">
				    	<button type="button" class="btn btn-info" id="changePassword" data-dismiss="modal">Send Email</button>
				    </div>
			    </div>
			</div>
	</div>

	<div class="container-fluid" style="background-color: transparent;padding: 15px;padding-top: 0;">
			<form style="padding-top: 0.5px;" method="post" enctype="multipart/form-data">
				<fieldset style="border: 1px ridge rgba(0,0,0,0.1);border-radius: 10px;background-image: linear-gradient(-270deg,whitesmoke 10%,ghostwhite 90%)">
					<legend class="text-light bg-info" style="width: 100%;padding: 15px;">Sign Up</legend>
					<div class="row" style="padding: 25px;">
						<div class="col-lg-6">
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
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<div class="custom-file">
									<input type="file" accept="image/png,image/jpeg" class="custom-file-input border" name="photo" id="photo" style="cursor: pointer;">
									<label for="photo" class="custom-file-label" id="labelPhoto">Profile Photo <span class="text-secondary">(Optional): </span></label>
								</div>
							</div>
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
								<div class="row">
									<div class="col">
										<label>Gender: </label>
										<div class="custom-control custom-radio">
										    <input type="radio" class="custom-control-input" id="male" name="gender" value="male" required="">
										    <label class="custom-control-label" for="male">Male</label>
										</div>
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="female" name="gender" value="female" required="">
										    <label class="custom-control-label" for="female">Female</label>
										</div>
									</div>
									<div class="col">
										<label>Account type: </label>
										<div class="custom-control custom-radio">
										    <input type="radio" class="custom-control-input" id="citizen" name="type" value="citizen" required="">
										    <label class="custom-control-label" for="citizen">Citizen</label>
										</div>
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="politician" name="type" value="politician" required="">
										    <label class="custom-control-label" for="politician">Politician</label>
										</div>
									</div>
								</div>
							</div><br>
							<div class="form-group mb-3">
								<button type="submit" class="btn btn-info">Submit</button>
							</div>
						</div>
					</div>
				</fieldset>
			</form>
	</div>
	
	<script>
		var cookie=Cookies.get("invalid");
		if(cookie!==undefined){
			$("#log").addClass("alert").addClass("alert-danger").html("Invalid "+cookie+".")
		}
		function fade(){
			if(screen.width>992){
				if($(window).width()>992){
					var div=$("#main").height()
					var top=$("body,html").scrollTop()
					var percentage=1-(parseFloat(top)/parseFloat(div))
					if(percentage>0.1){
						$("#intro,#loginForm").fadeTo(0,Math.round(percentage*10)/10)
					}
				}else{
					$("#intro,#loginForm").fadeTo(0,1)
				}
			}
		}
		setInterval(fade,0)
	</script>
</body>
</html>