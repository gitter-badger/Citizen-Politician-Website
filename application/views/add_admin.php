<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head;?>
	<style>a{cursor: pointer;}</style>
</head>
<body>
	<?php echo $navbar;?>
	<div class="rounded bg-info p-1 text-light text-center" style="position: fixed;bottom: 20px;z-index: 100;right: 20px;width: 60px;font-family: Cookie,cursive;font-size: 20px;cursor: pointer;" onclick="$('body,html').animate({scrollTop:0})">Top</div>
	<script>
		function scroll(){
			if($('body,html').scrollTop()>320){
				$("div.text-center").fadeIn()
			}else{
				$("div.text-center").fadeOut()
			}
		}
		$("div.text-center").hide()
		setInterval(scroll,0)
	</script>
	<div class="container-fluid" style="position: relative;top: 50px">
	<div class="container">
		<form style="padding: 15px;padding-top: 35px;" method="post" action="<?php echo site_url('register/register_admin')?>" enctype="multipart/form-data">
			<fieldset style="padding: 20px;border-radius: 10px;background-color: whitesmoke;background-image: linear-gradient(-180deg,whitesmoke 10%,white 90%);">
				<legend class="text-info">Register an Admin</legend>
				<?php echo $this->session->flashdata('log')?>
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
					      	<span class="input-group-text">@</span>
					    </div>
						<input type="text" class="form-control" name="user" placeholder="Username" required="">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
					      	<span class="input-group-text" id="showSecret" style="cursor: pointer;"><img src="<?php echo base_url('resources/show_password_icon.png')?>" style="width: 23px;height: 23px;"></span>
					    </div>
						<input type="password" class="form-control" name="secret" id="secret" placeholder="Password" required="">
					</div>
				</div>
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
					      	<span class="input-group-text" id="showSecretRe" style="cursor: pointer;"><img src="<?php echo base_url('resources/show_password_icon.png')?>" style="width: 23px;height: 23px;"></span>
					    </div>
						<input type="password" class="form-control" name="secretRe" id="secretRe" placeholder="Repeat Password" required="">
					</div>
				</div>
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
</body>
</html>