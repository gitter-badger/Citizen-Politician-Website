<!DOCTYPE html>
<html>
<head>
	<title>Mwananchi</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png" href="MwananchiIcon.png">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
	<style>
		body,html{
			margin:0;
			height: 100%;
		}
	</style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body style="background: url(03.jpg) no-repeat center center;background-size: cover">
	<div class="container" style="background-color: rgba(0,0,0,0.6);height: 100%; width: 100%">
		<div class="jumbotron text-info" style="position: relative;top: 110px;background-color: transparent;"><span class="display-1" style="font-family: Cookie,cursive;line-height: 50px;"><i class="fas fa-user"></i> Mwananchi</span><br><br><span class="display-3 text-light" style="font-family: Comic sans MS">We are Going Live Soon...</span><br><br><span class="display-4 text-secondary">CountDown: <span id="time" class="display-3" style="font-family: Cookie,cursive;"></span></span></div>
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
		$("#time").text(days+" : "+hours+" : "+minutes+" : "+seconds)
	}
	setInterval(getTime,0)
</script>
</html>