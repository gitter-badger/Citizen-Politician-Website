<!DOCTYPE html>
<html>
<head>
	<?php echo $head?>
	<style>
		@media screen and (max-width: 576px){
			.display-4{
				font-size: 40px;
			}
		}
	</style>
</head>
<body ng-app="main" style="height: auto">
	<?php echo $navbar?>
	<div class="container mb-3" style="margin-top: 60px">
		<div class="display-4 text-info" style="font-family: Cookie,cursive;">
			<span><i class="fas fa-user"></i> Mwananchi: </span><span>Sign Up</span>
		</div>
		<?php if($form==='basic'){?>
			<legend class="text-muted">Basic Information</legend>
			<div id="sign_up_error"><?php echo validation_errors('<div class="alert alert-danger alert-dismissable fade show">', '<button type="button" class="close" style="line-height:0.83;outline:none;" data-dismiss="alert"><span>&times;</span></button></div>'); ?></div>
			<form ng-controller="dateOfBirth" ng-submit="submit($event)" style="width: 100%;" method="post" action="<?php echo site_url('register/add_user')?>" enctype="multipart/form-data">
				<div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="text" value="<?php echo set_value('user')?>" class="form-control" name="user" onblur="checkAvailable(this,'#spanUser','<?php echo site_url('register/check_available')?>')" onkeyup="checkUser(this,'#spanUser')" placeholder="Username" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text"><span class="fas" id="spanUser"></span></span>
								    </div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="email" value="<?php echo set_value('email')?>" class="form-control" name="email" onblur="checkAvailable(this,'#spanEmail','<?php echo site_url('register/check_available')?>')" onkeyup="checkEmail(this,'#spanEmail')" placeholder="Email" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text"><span class="fas" id="spanEmail"></span></span>
								    </div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								      	<span class="input-group-text">+</span>
								    </div>
									<input type="text" value="<?php echo set_value('phone')?>" class="form-control" name="phone" onblur="checkAvailable(this,'#spanPhone','<?php echo site_url('register/check_available')?>')" onkeyup="checkPhone(this,'#spanPhone')" placeholder="Phone" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text"><span class="fas" id="spanPhone"></span></span>
								    </div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								      	<span class="input-group-text" onclick="showPassword(this,'#secret')" style="cursor: pointer;"><img src="<?php echo base_url();?>resources/show_password_icon.png" style="width: 23px;height: 23px;"></span>
								    </div>
									<input type="password" value="<?php echo set_value('secret')?>" class="form-control" onkeyup="checkPass(this,'#spanSecret','#secretRe','#spanRepeat')" name="secret" id="secret" placeholder="Password" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text"><span class="fas" id="spanSecret"></span></span>
								    </div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
								      	<span class="input-group-text" onclick="showPassword(this,'#secretRe')" style="cursor: pointer;"><img src="<?php echo base_url();?>resources/show_password_icon.png" style="width: 23px;height: 23px;"></span>
								    </div>
									<input type="password" value="<?php echo set_value('secretRe')?>" class="form-control" name="secretRe" onkeyup="checkRepeat('#secret',this,'#spanRepeat')" id="secretRe" placeholder="Repeat Password" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text"><span class="fas" id="spanRepeat"></span></span>
								    </div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group mb-2" ng-controller="select_controller" id="select_module">
								<label for="countries"> Country:</label>
								<select class="custom-select mb-3" ng-model="select_value" ng-change="change_select()" name="countries" id="countries" required="">
									<option value="{{x[0]}}" ng-repeat="x in countries">{{x[1]}}</option>
								</select>
								<label for="counties"> County:</label>
								<select class="custom-select mb-3" name="counties" id="counties" required="">
									<option value="{{x[0]}}" ng-repeat="x in select_counties">{{x[1]}}</option>
								</select>
							</div>
							<div class="form-group">
								<label> Date of Birth:</label>
								<div class="d-flex justify-content-between">
									<select class="form-control mr-4" ng-model="day" name="day"><option ng-repeat="x in days">{{x}}</option></select>
									<select class="form-control mr-4" ng-model="month" ng-change="get_days()" name="month"><option ng-repeat="x in months" value="{{x[0]}}">{{x[1]}}</option></select>
									<select class="form-control" ng-model="year" ng-change="get_months()" name="year"><option ng-repeat="x in years">{{x}}</option></select>
								</div>
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
					<input type="text" name="age" hidden="">
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-info">Sign Up</button>
					</div>
				</div>
			</form>
		<?php }elseif($form==='email'){
			if($this->session->userdata('basic_data')===null) redirect(site_url('sign_up/basic'),'location');
		?>
			<legend class="text-muted">Email Verification</legend>
			<div id="sign_up_error"><?php echo validation_errors('<div class="alert alert-danger alert-dismissable fade show">', '<button type="button" class="close" style="line-height:0.83;outline:none;" data-dismiss="alert"><span>&times;</span></button></div>');echo $this->session->flashdata('error'); ?></div>
			<form style="width: 100%;" method="post" onsubmit="return checkNumber('input[name=code]','')" action="<?php echo site_url('register/verify_code')?>" enctype="multipart/form-data">
				<p class="text-secondary p-1">Welcome to Mwananchi, <i><?php echo $this->session->userdata('basic_data')['user'];?>.</i> We are glad to have you on board. An email has been sent to <i><?php echo $this->session->userdata('basic_data')['email'];?>.</i> Please input the code sent to you so we can verify that the email is yours.</p>
				<input type="text" name="email" value="<?php echo $this->session->userdata('basic_data')['user'];?>" hidden="">
				<div class="form-group">
					<input type="text" name="code" class="form-control mb-3" placeholder="Code . . .">
					<div class="d-flex justify-content-end">
						<a href="" data-username="<?php echo $this->session->userdata('basic_data')['user'];?>" data-email="<?php echo $this->session->userdata('basic_data')['email'];?>" onclick="event.preventDefault();showLoader(this,'<?php echo site_url('register/resend_code')?>')" class="text-info">Resend Code . . .</a>
					</div>
				</div>
				<button type="submit" class="btn btn-info">Verify Email</button>
			</form>
		<?php }elseif($form==='phone'){
			if($this->session->userdata('basic_data')===null) redirect(site_url('sign_up/basic'),'location');
		?>
			<legend class="text-muted">Phone Verification</legend>
			<div id="sign_up_error"><?php echo validation_errors('<div class="alert alert-danger alert-dismissable fade show">', '<button type="button" class="close" style="line-height:0.83;outline:none;" data-dismiss="alert"><span>&times;</span></button></div>');echo $this->session->flashdata('error'); ?></div>
			<form style="width: 100%;" method="post" onsubmit="return checkNumber('input[name=code]','')" action="<?php echo site_url('register/verify_code')?>" enctype="multipart/form-data">
				<p class="text-secondary p-1">A text has been sent to <i><?php echo $this->session->userdata('basic_data')['number'];?>.</i> Please input the code sent to you so we can verify that the phone number is yours.</p>
				<input type="text" name="phone" value="<?php echo $this->session->userdata('basic_data')['user'];?>" hidden="">
				<div class="form-group">
					<input type="text" name="code" class="form-control mb-3" placeholder="Code . . .">
					<div class="d-flex justify-content-end">
						<a href="" data-username="<?php echo $this->session->userdata('basic_data')['user'];?>" data-phone="<?php echo $this->session->userdata('basic_data')['number'];?>" onclick="event.preventDefault();showLoader(this,'<?php echo site_url('register/resend_code')?>')" class="text-info">Resend Code . . .</a>
					</div>
				</div>
				<button type="submit" class="btn btn-info">Verify Phone</button>
			</form>
		<?php }?>
	</div>
	<script>
		function showLoader(event,url){
			$('div#sign_up_error').html('<div class="d-flex justify-content-center"><div class="loader"></div></div>');
			$(event).hide()
			$("button[type='submit']").hide()
			var user=$(event).attr('data-username'),email=$(event).attr('data-email')
			if(email===undefined){
				$.post(url,{user:user,phone:$(event).attr('data-phone')},data=>{
					$('div#sign_up_error').html(data)
					$(event).fadeIn()
					$("button[type='submit']").fadeIn()
				})
				return
			}
			$.post(url,{user:user,email:email},data=>{
				$('div#sign_up_error').html(data)
				$(event).fadeIn()
				$("button[type='submit']").fadeIn()
			})
		}

		function checkNumber(input,span){
			if(checkPhone(input,span)){
				$('div#sign_up_error').html('');
				return true;
			}else{
				$('div#sign_up_error').html('<div class="alert alert-danger">Invalid code format. Please use numbers.</div>');
				return false;
			}
		}

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
		
		app.controller('dateOfBirth',["$scope","$window",function($scope,$window){
			dateChooser($scope,$window)
			$scope.year=("<?php echo set_value('year')?>".length>0)?"<?php echo set_value('year')?>":$scope.year
			$scope.get_months()
			$scope.month=("<?php echo set_value('month')?>".length>0)?"<?php echo set_value('month')?>":$scope.month
			$scope.get_days()
			$scope.day=("<?php echo set_value('day')?>".length>0)?"<?php echo set_value('day')?>":$scope.day
		}])
	</script>
</body>
</html>