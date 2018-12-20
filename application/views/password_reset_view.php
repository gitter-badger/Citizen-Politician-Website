<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<title>Mwananchi</title>

	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>

	<link rel='shortcut icon' type='image/png' href="<?php echo base_url('resources/favicon.png')?>">

	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css' integrity='sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU' crossorigin='anonymous'><link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>

	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js'></script>

	<style type="text/css">
		::selection { background-color: darkslategray; color: white; }
		::-moz-selection { background-color: darkslategray; color: white; }
		::-webkit-scrollbar {width: 10px;background: whitesmoke;height: 10px;}
		::-webkit-scrollbar-track {box-shadow: inset 0 0 15px gray;border-radius: 0px;}
		::-webkit-scrollbar-thumb {background: #17a2b8;border-radius: 5px;}
		::-webkit-scrollbar-thumb:hover {background: #03525e;}

		html,body {
			background-color: whitesmoke;
			margin: 40px;
			font: 14px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
			height: 85%;
		}
		.docs{
			text-align: center;
			font-size: 13px;
		}
		#new:hover{
			color: darkslategray !important;
		}
		@media screen and (max-width: 992px){
			.docs{
				font-size: 12px !important;
			}
			body,html {
				margin: 5px;
				margin-top: 40px;
			}
		}
	</style>
</head>
<body>
	<div class="container">
		<div style="font-family: Cookie,cursive;" class="display-4 text-info"><i class="fas fa-user"></i> Mwananchi: Password Reset.</div>
		<div class="container" style="padding-top: 5px;"><?php echo $data; ?></div>
	</div>
	<div class="w-100 row d-flex justify-content-center" style="position: relative; top: 10px;padding-left: 1em;padding-right: 1em;">
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('sign_up/basic')?>">Sign Up</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('privacy')?>">Privacy Policy</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('terms')?>">Terms</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('help')?>">Help Center</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('cookies')?>">Cookies</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('security')?>">Account</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('features')?>">Features</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('dev_zone')?>">Developers</a>
		<a class="col-xs p-2 docs text-muted" href="<?php echo site_url('about')?>">About</a>
	</div>
	<div class="text-dark text-center w-100 row d-flex justify-content-center" style="position: relative;top: 20px;">
		<span class="col-12">
			<a class='text-info' href="<?php echo base_url()?>" style='font-family: Cookie,cursive;font-size: 18px'><i class='fas fa-user'></i> Mwananchi</a><sup class='text-info'>TM</sup> &copy; Leadership with Service.
		</span>
	</div>
	<script>
		$('[data-toggle="popover"]').popover('show')
		$('#new').click(event=>{
			anime({targets: '#new',scale: {value: 0.8,duration: 50}}).finished.then(()=>{
				anime({targets: '#new',scale: {value: 1, duration: 700}}).finished.then(()=>{location.replace("<?php echo site_url('home')?>")})
				$('[data-toggle="popover"]').popover('dispose')
			})
			var copyt=$('#field').select()
			document.execCommand("copy")
		})
	</script>
</body>
</html>