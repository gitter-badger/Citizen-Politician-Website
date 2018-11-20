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

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			border-radius: 5px;
			box-shadow: 0 0 8px #D0D0D0;
			margin-bottom: 0px;
		}
		.docs:hover{
			background-color: lightgray;
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
			#container{
				margin: 2px;
			}
			body,html {
				margin: 5px;
				margin-top: 40px;
			}
		}
	</style>
</head>
<body>
	<nav class='navbar bg-info navbar-expand-sm navbar-dark fixed-top' style='padding-top:2px;padding-bottom:2px;'>
		<a class='navbar-brand text-dark' href="<?php echo site_url('home')?>" style='font-family: Cookie,cursive;'><i class='fas fa-user'></i> Mwananchi</a>
		<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#smallScreen' style='outline: none;'>
			<span class='navbar-toggler-icon'></span>
		</button>
		<div class='collapse navbar-collapse' id='smallScreen'>
			<ul class='navbar-nav'>
				<li class='nav-item'><a class='nav-link' href="<?php echo site_url('home')?>">Go to Site</a></li>
			</ul>
		</div>
	</nav>
	<div id="container" style="position: relative;top: 20px;">
		<h1 style="font-family: Consolas, Monaco, Courier New, Courier, monospace;">Password Reset.</h1>
		<div class="container" style="padding-top: 5px;"><?php echo $data; ?></div>
	</div>
	<div class="p-0 w-100 row d-flex justify-content-center" style="position: relative; top: 70px;">
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('privacy')?>">Privacy Statement</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('terms')?>">Terms and Conditions</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('help')?>">Help Center</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('cookies')?>">Cookie Policy</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('security')?>">Account Security</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('features')?>">Features</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('dev_zone')?>">Developers</a>
		<a class="col-xs-2 p-3 docs text-muted" href="<?php echo site_url('about')?>">About</a>
	</div>
	<div class="text-dark text-center w-100 row d-flex justify-content-center" style="position: relative;top: 80px;">
		<span class="col-12">
			<a class='text-info' href="<?php echo site_url('home')?>" style='font-family: Cookie,cursive;font-size: 18px'><i class='fas fa-user'></i> Mwananchi</a><sup class='text-info'>TM</sup> &copy; Leadership with Service.
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