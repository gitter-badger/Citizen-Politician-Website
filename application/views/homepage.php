<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->session->unset_userdata(array('username','photo','usertype'));
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head;?>
	<style>
		ul#safeReset li a {
			border-color: transparent; 
			color: gray;
		}
		ul#safeReset li a:hover {
			color: #17a2b8;
		}
		ul#safeReset li a.active {
			color: #17a2b8;
			border-color: transparent;
			border-bottom-color: #17a2b8;
		}
		div.main{
			background: url(<?php echo base_url('resources/background_image_home.JPG');?>) no-repeat top;
			background-size: cover;
			background-attachment: fixed;
			padding: 0px;
			margin: 0;
			height: 100%;
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
		  a[href="#signUp"]{
		  	text-align: left !important;
		  }
		}
		@media screen and (max-width: 576px) {
		  nav.navbar,#bottom{
		  	display: none !important;
		  }
		}
	</style>
</head>
<body data-spy="scroll" data-target=".navbar" ng-app="main">
<?php echo $navbar;?>
<div class="row container-fluid main">
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
				    			<a target='_blank' href='https://github.com/dopesky/citizen-politician-website' style='float:left;margin-right: 30px;margin-left: 20px;display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' class="rounded-circle" style='display: block;' src='<?php echo base_url();?>resources/github_icon.png' alt=''></a>
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
								    	<a class="text-info col-xl-7 mb-2" href="#forgotPassword" data-toggle="modal">Forgot Password</a>
								    	<a class="text-info col-xl-5 mb-3 text-right" href="#signUp" data-toggle="modal">Create an Account</a>
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
	      	<div class="modal-body">
	      		<div class="container-fluid">
					<ul class="nav nav-tabs nav-justified" id="safeReset">
						<li class="nav-item">
					    	<a class="nav-link active" style="border-radius: 0px;" data-toggle="tab" href="#resetEmail">via Email</a>
					  	</li>
					  	<!-- <li class="nav-item">
					    	<a class="nav-link" style="border-radius: 0px;" data-toggle="tab" href="#resetPhone">via Phone</a>
					  	</li> -->
					</ul>
					<div class="tab-content" style="padding: 10px;">
						<div class="tab-pane active" id="resetEmail">
							<form method="post" enctype="multipart/form-data" action="<?php echo site_url('home/reset_password')?>">
								To reset your password, provide your working email, username or phone number and reset instructions will be sent to your EMAIL.
				        		<input class="form-control mt-2" type="text" name="email" placeholder="Username, Email or Phone Number" required="">
				        		<hr><button type="submit" class="btn btn-info float-right">Send Email</button>
				        	</form>
						</div>
						<div class="tab-pane" id="resetPhone">
							<form method="post" enctype="multipart/form-data" action="<?php echo site_url('home/reset_password')?>">
								To reset your password, provide your working email, username or phone number and reset instructions will be sent to your PHONE via text.
				        		<input class="form-control mt-2" type="text" name="phone" placeholder="Username, Email or Phone Number" required="">
				        		<hr><button type="submit" class="btn btn-info float-right">Send Text</button>
				        	</form>
						</div>
					</div>
			    </div>
		  	</div>
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
								<input type="text" class="form-control" name="user" onblur="checkAvailable(this,'#spanUser','<?php echo site_url('home/check_available')?>')" onkeyup="checkUser(this,'#spanUser')" placeholder="Username" required="">
							    <div class="input-group-append">
							      	<span class="input-group-text fa" id="spanUser"></span>
							    </div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<input type="email" class="form-control" name="email" onblur="checkAvailable(this,'#spanEmail','<?php echo site_url('home/check_available')?>')" onkeyup="checkEmail(this,'#spanEmail')" placeholder="Email" required="">
							    <div class="input-group-append">
							      	<span class="input-group-text fa" id="spanEmail"></span>
							    </div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
							      	<span class="input-group-text">+</span>
							    </div>
								<input type="text" class="form-control" name="phone" onblur="checkAvailable(this,'#spanPhone','<?php echo site_url('home/check_available')?>')" onkeyup="checkPhone(this,'#spanPhone')" placeholder="Phone" required="">
							    <div class="input-group-append">
							      	<span class="input-group-text fa" id="spanPhone"></span>
							    </div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
							      	<span class="input-group-text" onclick="showPassword(this,'#secret')" style="cursor: pointer;"><img src="<?php echo base_url();?>resources/show_password_icon.png" style="width: 23px;height: 23px;"></span>
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
							      	<span class="input-group-text" onclick="showPassword(this,'#secretRe')" style="cursor: pointer;"><img src="<?php echo base_url();?>resources/show_password_icon.png" style="width: 23px;height: 23px;"></span>
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
								<input type="file" accept="image/*" class="custom-file-input border" name="photo" id="photo" style="cursor: pointer;" onchange="check_photo(event,'#labelPhoto')">
								<label for="photo" class="custom-file-label" id="labelPhoto">Profile Photo <span class="text-secondary">(Optional) </span></label>
							</div>
						</div>
						<div class="form-group mb-2" ng-controller="select_controller" id="select_module">
							<label for="countries"> Country:</label>
							<select class="custom-select mb-3" ng-model="select_value" ng-change="change_select()" name="countries" id="countries" style="cursor: pointer;" required="">
								<option value="{{x[0]}}" ng-repeat="x in countries">{{x[1]}}</option>
							</select>
							<label for="counties"> County:</label>
							<select class="custom-select mb-3" name="counties" id="counties" style="cursor: pointer;" required="">
								<option value="{{x[0]}}" ng-repeat="x in select_counties">{{x[1]}}</option>
							</select>
						</div>
						<div class="form-group mb-2">
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
    			<a target='_blank' href='https://github.com/dopesky/citizen-politician-website' style='float:left;margin-right: 30px;margin-left: 20px;display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' class="rounded-circle" style='display: block;' src='<?php echo base_url();?>resources/github_icon.png' alt=''></a>
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
	<div class="bg-info d-flex p-2 text-light" style="font-size: 20px;">Frequently Asked Questions (FAQs)</div>
	<div class="p-3" ng-controller="faq_controller">
		<form onsubmit="event.preventDefault()">
			<div class="input-group" style="width: 350px;float: right;">
				<input type="text" style="box-shadow: none;" class="form-control" placeholder="Search" ng-model="search_field">
				<div class="input-group-append">
					<button style="box-shadow: none;" ng-click="searchFunction()" class="btn btn-info">Search</button>
				</div>
			</div>
		</form>
		<table class="table table-borderless w-100">
			<tr style="display: none;" id="no_faq">
				<td>
					<div class="d-flex justify-content-center">No Questions to Show.</div>
				</td>
			</tr>
			<tr style="display: none;" id="faq_loader">
				<td>
					<div class="d-flex justify-content-center"><div class="loader"></div></div>
				</td>
			</tr>
			<tr ng-repeat="x in data">
				<td>
					<div class="media border p-2 rounded">
						<img src="https://res.cloudinary.com/dkgtd3pil/image/upload/v1542838690/mwananchi/site/anonymous.svg" class="mr-3 mt-3 rounded-circle align-self-start" alt="{{x[1]}}" style="width: 60px">
						<div class="media-body">
							<h4>{{x[1]}} <small title="{{x[6]}}" class="text-muted" style="font-size: 14px;cursor: default;"><i style="font-family: Helvetica, Arial, sans-serif;font-size: 11px;">{{x[5]}}</i></small></h4>
							<p>
								<b class="text-info" style="font-size: 14px; font-family: Work Sans, Calibri, sans-serif; font-weight: 600;line-height: 23px;">Email: </b>
								<a href="mailto:{{x[2]}}" style="color: #888888; font-size: 14px; font-family: Hind Siliguri, Calibri, Sans-serif; font-weight: 400;margin-right: 60px;">{{x[2]}}</a>
							</p>
							<div class="text-dark" ng-bind-html="x[3]"></div>
							<div class="p-3 text-muted" ng-bind-html="x[4]"></div>
						</div>
					</div>
				</td>
			</tr>
			<tr id="faq_pagination">
				<td>
					<nav aria-label="Navigation Bar" class="d-flex justify-content-center align-items-center">
						<ul class="pagination">
					    	<li class="page-item">
					      		<a class="page-link" style="box-shadow: none;" title="Previous" href="#" ng-click='prevNext($event)' onclick="event.preventDefault()" aria-label="Previous">
					        		<span aria-hidden="true">&laquo;</span>
					        		<span class="sr-only">Previous</span>
					      		</a>
					    	</li>
					    	<li ng-repeat="y in pages_array" ng-class="{'active':y[0]==current_page,'disabled':y[0]=='...'}" class="page-item"><a style="box-shadow: none;" href="#" title="{{y[2]}}" ng-click="change_page($event)" data-offset="{{y[1]}}" class="page-link" onclick="event.preventDefault()">{{y[0]}}</a></li>
					    	<li class="page-item">
					      		<a title="Next" style="box-shadow: none;" class="page-link" href="#" ng-click='prevNext($event)' onclick="event.preventDefault()" aria-label="Next">
					        		<span aria-hidden="true">&raquo;</span>
					        		<span class="sr-only">Next</span>
					      		</a>
					    	</li>
					  	</ul>
					</nav>
				</td>
			</tr>
		</table>
	</div>
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
	var app=angular.module('main',[])
	app.controller('select_controller',function($scope){
		$scope.countries=[]
		$scope.counties=[]
		$scope.select_counties=[]
		<?php foreach ($countries as $value) {?>
			$scope.countries.push(["<?php echo $value->countryID;?>","<?php echo $value->country;?>"])
		<?php }?>
		<?php foreach ($counties as $value) {?>
			$scope.counties.push(["<?php echo $value->CountyID;?>","<?php echo $value->County;?>","<?php echo $value->countryNo;?>"])
		<?php }?>
		$scope.change_select=function(){
			$scope.select_counties=[]
			for(var i=0;i<$scope.counties.length;i++){
				if($scope.counties[i][2].localeCompare($scope.select_value)===0){
					$scope.select_counties.push([$scope.counties[i][0],$scope.counties[i][1],$scope.counties[i][2]])
				}
			}
		}
		$scope.select_value=$scope.countries[0][0]
		$scope.change_select()
	})
	app.controller('faq_controller',['$scope','$sce',function($scope,$sce){
		$scope.data=[]
		$scope.data_count=0
		$scope.page_count=0
		$scope.pages_array=[]
		$scope.current_page=1
		$scope.searchFunction=function(){
			search_angular($scope,$sce,'#faq_loader',"<?php echo site_url('home/get_faq')?>")
		}
		$scope.check_page=function(){
			check_page($scope,"#faq_pagination","#no_faq","a[title='Previous']","a[title='Next']")
		}
		$scope.change_page=function($event){
			change_page($event,$scope,$sce,'#faq_loader',"<?php echo site_url('home/get_faq')?>","#faq")
		}
		$scope.prevNext=function($event){
			prev_next($event,$scope,$sce,'#faq_loader',"<?php echo site_url('home/get_faq')?>","#faq")
		}
		$scope.search_field=''
		$scope.searchFunction()
	}])
	setInterval(fade,0)
	$(".navbar li a").on('click', function(event) {scrollAnimate(event)});
</script>
</body>
</html>