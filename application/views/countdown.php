<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head;?>
</head>
<body style="background: url(<?php echo base_url();?>/resources/background_countdown_img.jpg) no-repeat center center;background-size: cover">
	<div class="container" style="background-color: rgba(0,0,0,0.6);height: 100%; width: 100%">
		<div class="jumbotron text-info" style="position: relative;top: 200px;font-family: Cookie,cursive;text-align: center;background-color: transparent;"><span class="display-3" style="line-height: 50px;"><i class="fas fa-user"></i> Mwananchi</span><br><br><span class="row"><span class="display-4 text-secondary col-md-6 text-center">Countdown to Launch: </span><span class="display-4 text-secondary col-md-6 text-center" id="time"></span></span></div>
	</div>
</body>
<script>
	function getTime(){
		var today = new Date()
		var launch = new Date(2018, 10, 1, 0, 0, 0, 0);
		var diff = launch.getTime()-today.getTime()
		var days = parseInt(diff/(1000*60*60*24))
		var hours = parseInt((diff%(1000*60*60*24))/(1000*60*60))
		var minutes = parseInt(((diff%(1000*60*60*24))%(1000*60*60))/(1000*60))
		var seconds = parseInt((((diff%(1000*60*60*24))%(1000*60*60))%(1000*60))/1000)
		if(seconds<0||days<0||hours<0||minutes<0){
			$("#time").text(0+" : "+0+" : "+0+" : "+0)
			return;
		}
		$("#time").text(days+" : "+hours+" : "+minutes+" : "+seconds)
	}
	setInterval(getTime,0)
</script>
</html>