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
		<?php if($form==='basic'){
			$this->session->unset_userdata('basic_data');
		?>
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
				<div class="form-group mb-0">
					<input type="text" name="code" class="form-control" placeholder="Code . . .">
					<div class="d-flex justify-content-end p-2">
						<a href="" data-username="<?php echo $this->session->userdata('basic_data')['user'];?>" data-phone="<?php echo $this->session->userdata('basic_data')['number'];?>" data-type="text" onclick="event.preventDefault();showLoader(this,'<?php echo site_url('register/resend_code')?>')" class="text-info mr-5">Resend Text . . .</a>
						<a href="" data-username="<?php echo $this->session->userdata('basic_data')['user'];?>" data-phone="<?php echo $this->session->userdata('basic_data')['number'];?>" data-type="call" onclick="event.preventDefault();showLoader(this,'<?php echo site_url('register/resend_code')?>')" class="text-info">Call Me . . .</a>
					</div>
				</div>
				<button type="submit" class="btn btn-info">Verify Phone</button>
			</form>
		<?php }elseif($form==='politics'){
			if($this->session->userdata('basic_data')===null) redirect(site_url('sign_up/basic'),'location');
			if(strtolower($this->session->userdata('basic_data')['type'])!=='politician') redirect(site_url('sign_up/basic'),'location');
		?>
			<legend class="text-muted">Political Information</legend>
			<div id="sign_up_error"><?php echo validation_errors('<div class="alert alert-danger alert-dismissable fade show">', '<button type="button" class="close" style="line-height:0.83;outline:none;" data-dismiss="alert"><span>&times;</span></button></div>'); ?></div>
			<form style="width: 100%;" onsubmit="return checkYears('input[name=political_years]','#spanPolitical_years')" method="post" action="<?php echo site_url('register/political_info')?>" enctype="multipart/form-data">
				<div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<input type="text" value="<?php echo set_value('full_names')?>" class="form-control" name="full_names"placeholder="Full Names" required="">
							</div>
							<div class="form-group">
								<div class="input-group mb-3">
									<input type="text" value="<?php echo set_value('political_years')?>" class="form-control" name="political_years" onkeyup="checkPhone(this,'#spanPolitical_years')" placeholder="Political Years" required="">
								    <div class="input-group-append">
								      	<span class="input-group-text"><span class="fas" id="spanPolitical_years"></span></span>
								    </div>
								</div>
							</div>
							<div class="form-group" ng-controller="political_seats">
								<label for="political_seat"> Current Political Seat:</label>
								<select class="custom-select" name="political_seat" id="political_seat"><option ng-repeat="x in seats" value="{{x.seatID}}">{{x.seat}}</option></select>
							</div>
							<div class="form-group" ng-controller="areas">
								<label> Constituency and Ward:</label>
								<div class="d-flex justify-content-between">
									<select class="form-control mr-5" ng-model="const" name="constituency" ng-change="change_wards()"><option ng-repeat="x in constituencies" value="{{x.constituencyID}}">{{x.constituency}}</option></select>
									<select class="form-control ml-5" name="ward"><option ng-repeat="x in wards_to_show" value="{{x.wardID}}">{{x.Ward}}</option></select>
								</div>
							</div>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-info">Sign Up</button>
					</div>
				</div>
			</form>
		<?php }elseif($form==='history'){
			if($this->session->userdata('basic_data')===null||$this->session->userdata('political_data')===null) redirect(site_url('sign_up/basic'),'location');
			if(strtolower($this->session->userdata('basic_data')['type'])!=='politician') redirect(site_url('sign_up/basic'),'location');
		?>
			<style>
				button{
					outline: none !important;
				}
			</style>
			<legend class="text-muted">Political History</legend>
			<div id="sign_up_error"></div>
			<p>What posts did you hold in the <?php echo $this->session->userdata('political_data')['political_years'];?> years you were in politics? <br><strong>Note: </strong>The 'From' and 'To' columns require valid dates in the format DD-MM-YYYY.</p>
			<div class="table-responsive-sm">
				<table class="table table-light mt-3" ng-controller="history">
					<thead class="thead-light">
						<tr>
							<th scope="col">Username</th>
							<th scope="col">Seat</th>
							<th scope="col">From</th>
							<th scope="col">To</th>
							<th class="text-center" scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="x in data">
							<th scope="row">{{x[1]}}</th>
							<td data-value="{{x[1].seatID}}">{{x[2].seat}}</td>
							<td>{{x[3]}}</td>
							<td>{{x[4]}}</td>
							<td class="text-center"><button class="close fas fa-times text-danger float-none" ng-click="remove_data($event)" data-id="{{x[0]}}" title="Remove"></button></td>
						</tr>
						<tr class="table-info">
							<th scope="row" id="user"><?php echo $this->session->userdata('basic_data')['user'];?></th>
							<td><select class="form-control" ng-model="seat" name="political_seat"><option ng-repeat="x in seats" value="{{x.seatID}}">{{x.seat}}</option></select></td>
							<td><input class="form-control" id="fromDate" placeholder="Date from"></td>
							<td><input class="form-control" id="toDate" placeholder="Date to"></td>
							<td class="d-flex justify-content-around">
								<button class="close fas fa-plus text-muted float-none" ng-click="add_data()" title="Add"></button>
								<button class="close fas fa-share text-success float-none" title="Next"></button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php }?>
	</div>
	<script>
		import DateTime from './resources/js/luxon/luxon';
		//alert(DateTime.fromISO('2016-05-25'))
		alert(DateTime.local())
		function showLoader(event,url){
			$('div#sign_up_error').html('<div class="d-flex justify-content-center"><div class="loader"></div></div>');
			$(event).hide()
			$("button[type='submit']").hide()
			var user=$(event).attr('data-username'),email=$(event).attr('data-email')
			if(email===undefined){
				$.post(url,{user:user,phone:$(event).attr('data-phone'),type:$(event).attr('data-type')},data=>{
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
				$('div#sign_up_error').html('<div class="alert alert-danger"><strong>Error! </strong>Invalid code format. Please use numbers.</div>');
				return false;
			}
		}

		function checkYears(input,span){
			if(checkPhone(input,span)){
				$('div#sign_up_error').html('');
				return true;
			}else{
				$('div#sign_up_error').html('<div class="alert alert-danger"><strong>Error! </strong>Invalid political years. Please use numbers.</div>');
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

		app.controller('political_seats',function($scope){
			$scope.seats=JSON.parse('<?php echo $seats?>');
		})

		app.controller('areas',function($scope){
			$scope.constituencies=[]
			$scope.wards=[]
			$scope.wards_to_show=[]

			var temp=JSON.parse('<?php echo $constituencies?>')
			for (var i = 0; i < temp.length; i++) {
				if(temp[i].countyNo=="<?php echo $this->session->userdata('basic_data')['counties']?>")
					$scope.constituencies.push(temp[i])
			}

			temp=JSON.parse('<?php echo $wards?>')
			for (var i = 0; i < temp.length; i++) {
				$scope.wards.push(temp[i])
			}

			$scope.change_wards=function(){
				$scope.wards_to_show=[]
				for (var i = 0; i < $scope.wards.length; i++) {
					if($scope.wards[i].constituencyID==$scope.const)
						$scope.wards_to_show.push($scope.wards[i])
				}
			}

			$scope.const=$scope.constituencies[0].constituencyID
			$scope.change_wards()
		})

		app.controller('history',function($scope){
			$scope.seats=JSON.parse('<?php echo $seats?>');
			$scope.data=[]
			$scope.seat='0'
			$scope.add_data=function(){
				$('div#sign_up_error').html('')
				var from=$('#fromDate').val().trim(),to=$('#toDate').val().trim(),user=$('#user').text().trim()
				if(from.length<1||to.length<1){
					$('div#sign_up_error').html('<div class="alert alert-danger"><strong>Error! </strong>Input valid dates in "From" and "To" columns.</div>')
					return
				}
				var temp=-1
				for (var i = 0; i < $scope.seats.length; i++) {
					if($scope.seat==$scope.seats[i].seatID)
						temp=$scope.seats[i]
				}
				if(temp!==-1){
					$scope.data.push([$scope.data.length,user,temp,from,to])
				}else{
					$('div#sign_up_error').html('<div class="alert alert-danger"><strong>Error! </strong>An unknown error occurred.</div>')
					return
				}
			}
			$scope.remove_data=function($event){
				var index=parseInt($($event.currentTarget).attr('data-id'))
				for (var i = 0; i < $scope.data.length; i++) {
					if(parseInt($scope.data[i][0])==index)
						$scope.data.splice(i,1)
				}
			}
			$scope.sort_data=function($event){

			}
		})
	</script>
</body>
</html>