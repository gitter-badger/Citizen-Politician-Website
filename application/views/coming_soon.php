<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head?>
	<style>
		button span {
		  	cursor: pointer;
		  	display: inline-block;
		  	position: relative;
		  	transition: 0.5s;
		}
		button span:before {
		  	content: '\00ab';
		  	position: absolute;
		  	opacity: 0;
		  	top: 0;
		  	left: -20px;
		  	transition: 0.5s;
		}
		button:hover span {
		  	padding-left: 20px;
		}

		button:hover span:before {
		  	opacity: 1;
		  	left: 0px;
		}
	</style>
</head>
<body>
		<?php echo $navbar?>
		<div class="container-fluid text-center mb-5" style="position: relative;top: 60px;">
			<div class="display-3 d-flex"><div class="w-100">Oops! We are sorry to disappoint you!</div></div>
			<div class="container text-muted mt-3">
				<span class="lead"><i class="fas fa-laptop-code"></i> The feature you are looking for is not available at this time because it is still under development... <i class="fas fa-laptop-code"></i></span>
				<p class="mt-3">Our developers are working day and night to ensure the feature is made available ASAP! We are sorry if this has caused you any inconvenience. Feel free to contact us any time from <a class="text-info" href="<?php echo site_url('home')?>#contacts">here.</a></p>
				<p>For more information about this feature, visit our <a class="text-info" href="<?php echo site_url('features')?>">features</a> page. If you would like to help in the development of this feature then visit the <a href="<?php echo site_url('dev_zone')?>" class="text-info">dev_zone</a>. For Frequently Asked Questions, visit our <a class="text-info" href="<?php echo site_url('home')?>#faq">homepage.</a></p>
				<p class="text-secondary"><strong>Note: </strong>If you visit our homepage your session will be terminated and you will be required to log in again.</p>
				<div class="d-flex justify-content-center mt-3 mb-3"><a class="text-info" href="<?php echo site_url('home')?>" style="font-size: 18px;font-family: Cookie,cursive;"><i class="fas fa-user"></i> Mwananchi</a> - Leadership with Service.</div>
				<div class="w-100 text-left"><button onclick="window.history.back()" style="width: 100px;margin-left: -200px;transform: scale(0);" class="btn btn-info"><span>Back</span></button></div>
			</div>
		</div>
		<script>
			anime({targets:".btn",scale:{value:1,duration:300,delay:300,easing:"easeInOutSine"},marginLeft:{value:30,delay:300,duration:1000}})
			anime.timeline({loop:true}).add({targets:".fa-laptop-code",rotate:{value:-15,duration:75}}).add({targets:".fa-laptop-code",rotate:{value:0,duration:50}}).add({targets:".fa-laptop-code",rotate:{value:15,duration:75}}).add({targets:".fa-laptop-code",rotate:{value:0,duration:50}})
		</script>
</body>
</html>