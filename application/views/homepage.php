<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->session->unset_userdata(array('username','photo','usertype'));
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head?>      
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
			margin-top: -35px;
		}
		@media screen and (max-width: 991px) {
			div.main{
				height: auto;
				margin-top: 0px;
			}
		}
	</style>
</head>
<body ng-app="main">
<div class="row container-fluid main">
	<div class="row" id="main" style="background-color: rgba(0,0,0,0.6);margin: 0;">
		<div class="col-lg-12 text-center" style="height: 50px"></div>
		<div class="col-lg-7 container">
			<div id="intro" class="container-fluid" style="margin: 0;word-wrap: break-word;">
			  	<div class="jumbotron" style="background-color: rgba(0,0,0,0.2);padding-top: 20px;padding-bottom: 10px;">
			    	<span class="display-4 text-light" style="font-family: Cookie,cursive;line-height: 50px;"><i class="fas fa-user"></i> Mwananchi.<br><small class="display-4 text-light" style="line-height: 20px !important;font-family: book antiqua;font-size: 30px;">A Citizen-Politician Website.</small></span>
			    	<br>
			    	<span class="text-light" style="font-family: Comic Sans MS,cursive,sans-serif;font-size: 14px;">Welcome to Mwananchi Website. Link up with your politician right here on this site. Get his info and be a part of the team of users that get to decide how popular or efficient a politician is in their area. This is the official site landing page. You can login or sign up and enjoy our services. <br><br>
			    	<span class="row ml-0 text-center">
			    		<span class="col-xs-6 mb-3" style="color: ghostwhite; font-size: 14px; font-family: Work Sans, Calibri, sans-serif; font-weight: 600;line-height: 23px;">Email us: <a href="mailto:<?php echo $mail_from;?>" style="color: #888888; font-size: 14px; font-family: Hind Siliguri, Calibri, Sans-serif; font-weight: 400;margin-right: 60px;"><?php echo $mail_from;?></a>
			    		</span>
			    		<span class="col-xs-6 mb-3">
			    			<span class="d-flex justify-content-center">
				    			<a target='_blank' class="mr-5" href='https://github.com/dopesky/citizen-politician-website' style='display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' class="rounded-circle" style='display: block;' src='<?php echo base_url();?>resources/github_icon.png' alt=''></a>
				    			<a target='_blank' class="mr-5" href='https://twitter.com/dopesky001' style='display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='http://i.imgur.com/Qc3zTxn.png' alt=''></a>
				    			<a target='_blank' class="mr-5" href='https://www.facebook.com/voxy.v.mcmwenda' style='display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='http://i.imgur.com/RBRORq1.png' alt=''></a>
				    			<a target='_blank' href='https://linkedin.com/in/kevin-kathendu-759062147' style='display: block; border-style: none !important; border: 0 !important;'><img width='24' border='0' style='display: block;' src='https://cdn3.iconfinder.com/data/icons/free-social-icons/67/linkedin_circle_gray-24.png' alt=''></a>
				    		</span>
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
							    	<a class="text-info col-12 mb-2 text-right" href="#forgotPassword" data-toggle="modal">Forgot Password</a>
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
					  	<li class="nav-item">
					    	<a class="nav-link" style="border-radius: 0px;" data-toggle="tab" href="#resetText">via Text</a>
					  	</li>
					  	<li class="nav-item">
					    	<a class="nav-link" style="border-radius: 0px;" data-toggle="tab" href="#resetCall">via Call</a>
					  	</li>
					</ul>
					<div class="tab-content" style="padding: 10px;">
						<div class="tab-pane active" id="resetEmail">
							<form method="post" enctype="multipart/form-data" action="<?php echo site_url('home/reset_password')?>">
								To reset your password, provide your working email, username or phone number and reset instructions will be sent to your EMAIL.
				        		<input class="form-control mt-2" type="text" name="email" placeholder="Username, Email or Phone Number" required="">
				        		<hr><button type="submit" class="btn btn-info float-right">Email Me</button>
				        	</form>
						</div>
						<div class="tab-pane" id="resetText">
							<form method="post" enctype="multipart/form-data" action="<?php echo site_url('home/reset_password')?>">
								To reset your password, provide your working email, username or phone number and reset instructions will be sent to your PHONE via text.
				        		<input class="form-control mt-2" type="text" name="phone" placeholder="Username, Email or Phone Number" required="">
				        		<hr><button type="submit" name="submit" value="text" class="btn btn-info float-right">Text Me</button>
				        	</form>
						</div>
						<div class="tab-pane" id="resetCall">
							<form method="post" enctype="multipart/form-data" action="<?php echo site_url('home/reset_password')?>">
								To reset your password, provide your working email, username or phone number and reset instructions will be sent to your PHONE via call.
				        		<input class="form-control mt-2" type="text" name="phone" placeholder="Username, Email or Phone Number" required="">
				        		<hr><button type="submit" name="submit" value="call" class="btn btn-info float-right">Call Me</button>
				        	</form>
						</div>
					</div>
			    </div>
		  	</div>
	    </div>
	</div>
</div>

<!-- <div class="container-fluid p-0" id="contacts"  style="height: 100%;background-image: linear-gradient(-200deg,whitesmoke 0%,ghostwhite 100%)">
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
 -->
<div class="p-0 w-100">
	<div class="w-100 row d-flex justify-content-center" style="padding-left: 1em;padding-right: 1em;">
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('sign_up/basic')?>">Sign Up</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('privacy')?>">Privacy Policy</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('terms')?>">Terms</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('help')?>">Help Center</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('cookies')?>">Cookies</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('security')?>">Account</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('features')?>">Features</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('dev_zone')?>">Developers</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('about')?>">About</a>
		<a class="col-xs p-2 docs text-muted" style="font-family: Cookie,cursive;cursor: text;font-size: 13px !important;"><span ><i class="fas fa-user"></i> Mwananchi</span></a>
	</div>
</div>

<script>
	var app=angular.module('main',[])
	app.controller('faq_controller',['$scope','$window','$sce',function($scope,$window,$sce){
		$scope.data=[]
		$scope.data_count=0
		$scope.page_count=0
		$scope.pages_array=[]
		$scope.current_page=-1
		$scope.searchFunction=function(){
			var assets={loader:'#faq_loader',no_data:"#no_faq",pagination:"#faq_pagination",search_element:"input[ng-model='search_field']"}
			search_angular($scope,$sce,assets,"<?php echo site_url('home/get_faq')?>")
		}
		$scope.check_page=function(){
			var assets={pagination:"#faq_pagination",no_data:"#no_faq",previous:"a[title='Previous']",next:"a[title='Next']"}
			check_page($scope,assets)
		}
		$scope.change_page=function($event){
			var assets={loader:'#faq_loader',pagination:"#faq_pagination",top:"#faq",search_element:"input[ng-model='search_field']"}
			change_page($event,$scope,$sce,assets,"<?php echo site_url('home/get_faq')?>")
		}
		$scope.prevNext=function($event){
			var assets={loader:'#faq_loader',pagination:"#faq_pagination",top:"#faq",search_element:"input[ng-model='search_field']"}
			prev_next($event,$scope,$sce,assets,"<?php echo site_url('home/get_faq')?>")
		}
		$scope.search_field=''
		$scope.searchFunction()
	}])
</script>
</body>
</html>