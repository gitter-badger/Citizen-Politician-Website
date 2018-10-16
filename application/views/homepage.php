<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->session->unset_userdata(array('username','photo','usertype'));
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head;?>
	<style>
		.carousel-indicators li{
		    background-color: #33C1FF;
		}
		.carousel-indicators .active {
		    background-color: gray;
		}
		.carousel-control-prev-icon {
		    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23808080' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
		}

		.carousel-control-next-icon {
		    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23808080' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
		}
		/*#signUp .modal-content{
			transform: scale(0);
		}*/
	</style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="100">
<?php echo $navbar;?>
<div class="row container-fluid" style="background: url(<?php echo base_url();?>resources/background_image_home.JPG) no-repeat top;background-size: cover;background-attachment: fixed;padding: 0px;margin: 0;">
	<div class="row" id="main" style="background-color: rgba(0,0,0,0.6);margin: 0;">
		<div class="col-lg-12" style="height: 100px"></div>
			<div class="col-lg-7 container">
				<div id="intro" class="container-fluid" style="margin: 0;word-wrap: break-word;">
				  	<div class="jumbotron" style="background-color: rgba(0,0,0,0.2);padding-top: 20px;padding-bottom: 10px;">
				    	<span class="display-4 text-light" style="font-family: Cookie,cursive;line-height: 50px;"><i class="fas fa-user"></i> Mwananchi.<br><small class="display-4 text-light" style="line-height: 20px !important;font-family: book antiqua;font-size: 30px;">A Citizen-Politician Website.</small></span>
				    	<br>
				    	<span class="text-light" style="font-family: Comic Sans MS,cursive,sans-serif;font-size: 14px;">Welcome to mwananchi website. This is the official site landing page. You can login, sign up and enjoy our services. You could also use the links above to spy across the page and see our features and contact information. Enjoy!</span><br><br>
				    	<span class="row container">
				    		<span class="col-xs-6 mb-3" style="float: left;color: ghostwhite; font-size: 14px; font-family: Work Sans, Calibri, sans-serif; font-weight: 600;line-height: 23px;">Email us: <a href="mailto:<?php echo $mail_from;?>" style="color: #888888; font-size: 14px; font-family: Hind Siliguri, Calibri, Sans-serif; font-weight: 400;margin-right: 60px;"><?php echo $mail_from;?></a>
				    		</span>
				    		<span class="col-xs-6 mb-3">
				    			<a target='_blank' href='https://github.com/dopesky/citizen-politician-website' style='float:left;margin-right: 30px;margin-left: 20px;display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' class="rounded-circle" style='display: block;' src='<?php echo base_url();?>/resources/github_icon.png' alt=''></a>
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
							<form style="padding: 15px;padding-top: 35px;" method="post" action="<?php echo base_url();?>home/login.html" enctype="multipart/form-data">
								<?php echo $this->session->flashdata('log');?>
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
									      	<span class="input-group-text" id="show" style="cursor: pointer;"><img src="<?php echo base_url();?>resources/show_password_icon.png" style="width: 23px;height: 23px;"></span>
									    </div>
									</div>
								</div>
								  	<div class="form-group form-check d-flex justify-content-between" style="padding-left: 0px">
								    	<a class="text-info" href="" id="safeReset" data-toggle="modal" data-target="#forgotPassword">Forgot Password</a>
								    	<a class="text-info" href="" data-toggle="modal" data-target="#signUp">Create an Account</a>
								  	</div>
								  <button type="submit" class="btn btn-info">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>

<div class="modal fade" id="forgotPassword">
	<div class="modal-dialog">
	  	<div class="modal-content">
	      	<div class="modal-header">
			  	<h4 class="modal-title">Change Password</h4>
			  	<button type="button" class="close" data-dismiss="modal">&times;</button>
		  	</div>
		  	<form method="post" enctype="multipart/form-data" action="<?php echo base_url()?>home/reset_password.html">
		      	<div class="modal-body">
		      		For your password to be reset, you have to provide your working email or username and a reset url will be sent to your email.
			        <input class="form-control" type="text" name="email" placeholder="Username or Email" required="">
			  	</div>
			    <div class="modal-footer">
			    	<button type="submit" class="btn btn-info">Send Email</button>
			    </div>
		    </form>
	    </div>
	</div>
</div>

<div class="modal" id="signUp">
	<div class="modal-dialog" style="min-width: 70%;">
		<div class="modal-content" style="background-image: linear-gradient(-270deg,whitesmoke 10%,ghostwhite 90%);">
			<div class="text-light bg-info modal-header">
				<div class="modal-title" style="font-size: 18px;">Sign Up</div>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form style="width: 100%;" method="post" enctype="multipart/form-data">
				<div class="row modal-body" style="padding: 25px;box-sizing: border-box;width: 100%;">
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
							      	<span class="input-group-text" id="showSecret" style="cursor: pointer;"><img src="<?php echo base_url();?>/resources/show_password_icon.png" style="width: 23px;height: 23px;"></span>
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
							      	<span class="input-group-text" id="showSecretRe" style="cursor: pointer;"><img src="<?php echo base_url();?>/resources/show_password_icon.png" style="width: 23px;height: 23px;"></span>
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
									foreach ($counties as $county) {
										echo "<option id=$county->CountyID>$county->County</option>";
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
					</div>
				</div>
				<div class="form-group mb-3 modal-footer">
					<button type="submit" class="close">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="container-fluid p-0 text-center" style="padding-top: 20px !important;">
	<div class="carousel slide" id="carousel" data-ride="carousel">
		<ul class="carousel-indicators">
		    <li data-target="#carousel" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel" data-slide-to="1"></li>
		    <li data-target="#carousel" data-slide-to="2"></li>
		    <li data-target="#carousel" data-slide-to="3"></li>
		</ul>
		<div class="carousel-inner">
	    	<div class="carousel-item active">
	    		<img class="rounded-circle" width="130px" height="130px" style="width: 130px;height: 130px" src="<?php echo base_url('resources/communication.jpg')?>" alt="Communication">
			    <h3>Communication</h3>
			    <p>Get recent communications from the politicians themselves.</p><br>
	    	</div>
	    	<div class="carousel-item">
	    		<img class="rounded-circle" width="130px" height="130px" style="width: 130px;height: 130px" src="<?php echo base_url('resources/socialize.jpg')?>" alt="Socialize">
	    		<h3>Socialize</h3>
			    <p>Post comments and get to know what others think.</p><br>
	    	</div>
	    	<div class="carousel-item">
	    		<img class="rounded-circle" width="130px" height="130px" style="width: 130px;height: 130px" src="<?php echo base_url('resources/contact.jpg')?>" alt="Contact">
	    		<h3>Contact</h3>
			    <p>Get in touch with all the politicians around the country.</p><br>
	    	</div>
	    	<div class="carousel-item">
	    		<img class="rounded-circle" width="130px" height="130px" style="width: 130px;height: 130px" src="<?php echo base_url('resources/analyze.jpg')?>" alt="Analyze">
	    		<h3>Analyze</h3>
			    <p>Be part of the team that analyzes the success of the leaders in their terms of office.</p><br>
	    	</div>
		</div>
		<a class="carousel-control-prev" href="#carousel" data-slide="prev">
	    	<span class="carousel-control-prev-icon"></span>
		</a>
	  	<a class="carousel-control-next" href="#carousel" data-slide="next">
	    	<span class="carousel-control-next-icon"></span>
	  	</a>
	</div>
</div>

<script>
	function fade(){
		if(screen.width>992){
			if($(window).width()>992){
				var div=$("#main").height()
				var top=$("body,html").scrollTop()
				var percentage=1-(parseFloat(top)/parseFloat(div))
				if(percentage>0.1){
					$("#intro,#loginForm").fadeTo(0,percentage)
				}
			}else{
				$("#intro,#loginForm").fadeTo(0,1)
			}
		}
	}
	$("#signUp").on("hide.bs.modal",event=>{
		anime({targets: '.modal-content',scale: {value: 0, duration:1000}})
	})
	setInterval(fade,0)
</script>
</body>
</html>