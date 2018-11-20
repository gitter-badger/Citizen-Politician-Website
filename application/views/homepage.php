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
		@media screen and (max-width: 992px) {
		  div.main,div#contacts{
		    height: auto !important;
		  }
		  .docs{
		  	font-size: 11px !important;
		  }
		}
		@media screen and (max-width: 1200px) {
		  a[data-target="#signUp"]{
		  	text-align: left !important;
		  }
		}
		@media screen and (max-width: 576px) {
		  nav.navbar,#bottom{
		  	display: none !important;
		  }
		}
		.docs:hover{
			background-color: whitesmoke;
		}
		.docs{
			font-size: 13px;
		}
	</style>
</head>
<body data-spy="scroll" data-target=".navbar">
<?php echo $navbar;?>
<script>
	$(".navbar li a").on('click', function(event) {
		if (this.hash !== "") {
  			event.preventDefault();
  			var hash = this.hash;
  			$('html, body').animate({
    			scrollTop: $(hash).offset().top
  			}, function(){
    			window.location.hash = hash;
  			});
		}
	});
</script>
<div class="row container-fluid main" style="background: url(<?php echo base_url('resources/background_image_home.JPG');?>) no-repeat top;background-size: cover;background-attachment: fixed;padding: 0px;margin: 0;height: 100%">
	<div class="row" id="main" style="background-color: rgba(0,0,0,0.6);margin: 0;">
		<div class="col-lg-12 text-center" style="height: 50px"></div>
			<div class="col-lg-7 container">
				<div id="intro" class="container-fluid" style="margin: 0;word-wrap: break-word;">
				  	<div class="jumbotron" style="background-color: rgba(0,0,0,0.2);padding-top: 20px;padding-bottom: 10px;">
				    	<span class="display-4 text-light" style="font-family: Cookie,cursive;line-height: 50px;"><i class="fas fa-user"></i> Mwananchi.<br><small class="display-4 text-light" style="line-height: 20px !important;font-family: book antiqua;font-size: 30px;">A Citizen-Politician Website.</small></span>
				    	<br>
				    	<span class="text-light" style="font-family: Comic Sans MS,cursive,sans-serif;font-size: 14px;">Welcome to Mwananchi. This is the official site landing page. You can login, sign up and enjoy our services. Scroll down to view the contact form, location of our offices and Frequently Asked Questions. If you have forgotten your password, use the <strong>forgot password link</strong> to reset it. For more links, scroll down to the <a href='' onclick="event.preventDefault();$('body,html').animate({scrollTop: document.body.scrollHeight},1000)" class='text-info'>end of the page.</a></span><br><br>
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
									      	<span class="input-group-text" onclick="showPassword(this,'#passWord')" style="cursor: pointer;"><img src="<?php echo base_url();?>resources/show_password_icon.png" style="width: 23px;height: 23px;"></span>
									    </div>
									</div>
								</div>
								  	<div class="row">
								    	<a class="text-info col-xl-7 mb-2" href="" id="safeReset" data-toggle="modal" data-target="#forgotPassword">Forgot Password</a>
								    	<a class="text-info col-xl-5 mb-3 text-right" href="" data-toggle="modal" data-target="#signUp">Create an Account</a>
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
		  	<form method="post" enctype="multipart/form-data" action="<?php echo site_url('home/reset_password')?>">
		      	<div class="modal-body">
		      		For your password to be reset, you have to provide your working email or username and reset instructions will be sent to your email.
			        <input class="form-control" type="text" name="email" placeholder="Username or Email" required="">
			  	</div>
			    <div class="modal-footer">
			    	<button type="submit" class="btn btn-info">Send Email</button>
			    </div>
		    </form>
	    </div>
	</div>
</div>

<div class="modal fade" id="signUp">
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
								<input type="text" class="form-control" name="user" onkeyup="checkUser(this,'#spanUser')" placeholder="Username" required="">
							    <div class="input-group-append">
							      	<span class="input-group-text fa" id="spanUser"></span>
							    </div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input type="email" class="form-control" name="email" onkeyup="checkEmail(this,'#spanEmail')" placeholder="Email" required="">
							    <div class="input-group-append">
							      	<span class="input-group-text fa" id="spanEmail"></span>
							    </div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
							      	<span class="input-group-text">+254</span>
							    </div>
								<input type="text" class="form-control" name="phone" onkeyup="checkPhone(this,'#spanPhone')" placeholder="Phone" required="">
							    <div class="input-group-append">
							      	<span class="input-group-text fa" id="spanPhone"></span>
							    </div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
							      	<span class="input-group-text" onclick="showPassword(this,'#secret')" style="cursor: pointer;"><img src="<?php echo base_url();?>/resources/show_password_icon.png" style="width: 23px;height: 23px;"></span>
							    </div>
								<input type="password" class="form-control" onkeyup="checkPass(this,'#spanSecret','#secretRe','#spanRepeat')" name="secret" id="secret" placeholder="Password" required="">
							    <div class="input-group-append">
							      	<span class="input-group-text fa" id="spanSecret"></span>
							    </div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
							      	<span class="input-group-text" onclick="showPassword(this,'#secretRe')" style="cursor: pointer;"><img src="<?php echo base_url();?>/resources/show_password_icon.png" style="width: 23px;height: 23px;"></span>
							    </div>
								<input type="password" class="form-control" name="secretRe" onkeyup="checkRepeat('#secret',this,'#spanRepeat')" id="secretRe" placeholder="Repeat Password" required="">
							    <div class="input-group-append">
							      	<span class="input-group-text fa" id="spanRepeat"></span>
							    </div>
							</div>
						</div>
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

<div class="container-fluid p-0" id="contacts"  style="height: 100%;background-image: linear-gradient(-200deg,whitesmoke 0%,ghostwhite 100%)">
	<div class="bg-info d-flex p-2 text-light" style="font-size: 20px">Contact Us</div>
	<div style="padding-top: 20px !important;">
		<div class="row p-3 w-100">
			<div class="col-lg-7 mb-4">
				<legend class="text-muted"><small>You can visit our offices here...</small></legend>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.775177929563!2d36.810415914753825!3d-1.3102142990443888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10f7f93622cf%3A0x28ef1277cf4abe5e!2sStrathmore+Business+School!5e0!3m2!1sen!2ske!4v1541360315434" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
			<form method="post" class="col-lg-5 mb-4" action="<?php echo site_url('home/contact_us')?>">
				<fieldset>
					<legend class="text-muted"><small>Get in touch with us...</small></legend>
					<?php echo $this->session->flashdata('error')?>
					<div class="form-group">
						<input class="form-control" type="text" name="name" placeholder="Your Name" required="">
					</div>
					<div class="form-group">
						<input class="form-control" type="email" name="email" placeholder="Your Email" required="">
					</div>
					<textarea required="" class="form-control mb-3" name="comment" placeholder="Question/Comment..." style="resize: none;" rows="3"></textarea>
					<button type="submit" class="btn btn-info">Submit</button>
				</fieldset>
			</form>
		</div>
		<div class="d-flex justify-content-center row w-100 p-3">
    		<span class="mb-2 col-xs-6 text-info text-center" style="font-size: 14px; font-family: Work Sans, Calibri, sans-serif; font-weight: 600;">Email us: <a href="mailto:<?php echo $mail_from;?>" class="text-muted" style="font-size: 14px; font-family: Hind Siliguri, Calibri, Sans-serif; font-weight: 400;"><?php echo $mail_from;?></a>
    		</span>
    		<span class="mb-2 col-xs-6 text-center">
    			<a target='_blank' href='https://github.com/dopesky/citizen-politician-website' style='float:left;margin-right: 30px;margin-left: 20px;display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' class="rounded-circle" style='display: block;' src='<?php echo base_url();?>/resources/github_icon.png' alt=''></a>
    			<a target='_blank' href='https://twitter.com/dopesky001' style='float:left;margin-right: 30px;display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='http://i.imgur.com/Qc3zTxn.png' alt=''></a>
    			<a target='_blank' href='https://www.facebook.com/voxy.v.mcmwenda' style='float:left;margin-right: 30px;display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='http://i.imgur.com/RBRORq1.png' alt=''></a>
    			<a target='_blank' href='https://linkedin.com/in/kevin-kathendu-759062147' style='float:left;display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='https://cdn3.iconfinder.com/data/icons/free-social-icons/67/linkedin_circle_gray-24.png' alt=''></a>
    		</span>
		</div>
		<div class="d-flex justify-content-center text-center p-1 w-100 row">
			<span class="mb-3 text-muted col-12" style="font-size: 14px; font-family: Work Sans, Calibri, sans-serif; font-weight: 600;">
				Office Numbers:	<a href="tel:+254702192746" class="text-muted">+254702192746</a>, <a href="tel:+254792141986" class="text-muted">+254792141986</a>, <a href="tel:+25479037835" class="text-muted">+254729037835</a>.
			</span>
		</div>
	</div>
</div>

<div class="container-fluid mr-4 p-0" style="background-image: linear-gradient(-200deg,whitesmoke 0%,ghostwhite 100%)" id="faq">
	<div class="bg-info d-flex p-2 text-light" style="font-size: 20px">Frequently Asked Questions (FAQs)</div>
	<div class="p-3">
		<table class="table table-borderless w-100">
			<thead>
				<tr hidden="">
					<td>Frequently Asked Questions (FAQs)</td>
				</tr>
			</thead>
			<?php foreach ($faq as $value): ?>
				<tr>
					<td>
						<div class="media border p-2 rounded">
							<img src="<?php echo base_url('resources/anonymous.svg')?>" class="mr-3 mt-3 rounded-circle align-self-start" alt="<?php echo $value->name?>" style="width: 60px">
							<div class="media-body">
								<h4><?php echo $value->name?> <small class="text-muted" style="font-size: 14px"><i style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;"><?php echo $this->formatter->formatDate($value->time);?></i></small></h4>
								<p><b class="text-info" style="font-size: 14px; font-family: Work Sans, Calibri, sans-serif; font-weight: 600;line-height: 23px;">Email: </b>
									<a href="mailto:<?php echo $value->email;?>" style="color: #888888; font-size: 14px; font-family: Hind Siliguri, Calibri, Sans-serif; font-weight: 400;margin-right: 60px;"><?php echo $value->email;?></a>
								</p>
								<p class="text-dark">
									<?php echo $value->question?>
								</p>
								<p class="p-2 text-muted">
									<?php echo $value->reply?>
								</p>
							</div>
						</div>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
	</div>
	<script>
		$("table").DataTable({ordering:false,"info":false,"pageLength":10,"lengthChange":false});
		$("table").on("page.dt",event=>{
			$('body,html').scrollTop($('#faq').offset().top)
		})
	</script>
</div>

<div class="p-0 w-100" style="background-color: white">
	<div class="w-100 row d-flex justify-content-center" style="padding-left: 1em;padding-right: 1em;">
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('privacy')?>">Privacy Statement</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('terms')?>">Terms and Conditions</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('help')?>">Help Center</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('cookies')?>">Cookie Policy</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('security')?>">Account Security</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('features')?>">Features</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('dev_zone')?>">Developers</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('about')?>">About</a>
	</div>
</div>

<div id='bottom' style="height: 40px"></div>

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
	setInterval(fade,0)
	$("input,textarea").not("#userName,#passWord").focus(event=>{
		if($(window).width()<=992){
			$("body,html").scrollTop($(event.currentTarget).offset().top)
		}
	})
	$('#userName,#passWord').focus(event=>{
		if($(window).width()<=992){
			$("body,html").scrollTop($("#loginForm").offset().top)
		}
	})
</script>
</body>
</html>