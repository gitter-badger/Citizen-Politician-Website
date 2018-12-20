<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head;?>
	<style>
		@media screen and (max-width: 992px){
			.display-4{
				font-size: 2.5em;
			}
			form{
				width: 100% !important;
			}
		}
	</style>
</head>
<body>
	<div class="container" style="position: relative;top: 40px">
		<div class="display-4 text-info" style="font-family: Cookie,cursive;">
			<span><i class="fas fa-user"></i> Mwananchi: </span><span>Password Reset</span>
		</div>
		<div class="ml-1">
			<legend class="text-muted">Input the code sent to you below to receive your new password.</legend>
			<form style="width: 60%;" method="post" action="<?php echo site_url('home/phone_reset')?>" enctype="multipart/form-data">
				<div class="form-group">
					<input type="text" name="user" value="<?php echo $user?>" hidden="">
					<input type="text" name="code" class="form-control mb-4" placeholder="Code . . .">
				</div>
				<button type="submit" class="btn btn-info">Get New Password</button>
			</form>
		</div>
	</div>
</body>
</html>