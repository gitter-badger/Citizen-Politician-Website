<!DOCTYPE html>
<html>
<head>
	<title>MwanaNchi</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png" href="MwananchiIcon.png">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="PhoneMainCSS.css">
	<link rel="stylesheet" type="text/css" href="MainCSS.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="MainJS.js"></script>
</head>
<body style="background-image: none;background-color: rgba(143,188,139,0.5);">
	<div class="container-fluid" style="width: 100%;height: 100%;margin: 0;padding: 0;">
		<div id="1" style="background: url(loading.png) no-repeat center center;background-size: 100% 100%;height: 100%;width: 100%;">
			<div id="2" style="height: inherit;width: inherit;background-color: rgba(0,0,0,0.6);">
				<div style="position: absolute;top: 68%;left: -10%;margin-left:-85px;color: gray;font-family: Cookie,cursive;font-size: 24px;" id="3">Created by: Kevin and Esther...</div>
				<div id="4" style="position: absolute;top: 73%;left: -10%;margin-left:-85px;color: gray;font-family: Cookie,cursive;font-size: 24px;">Version: 1.0...</div>
			</div>	
		</div>
	</div>
	<script>
		$("div").not("div.container-fluid").hide();
		$("#1").fadeIn(1000)
		$("#2").slideDown(2000,()=>{
			$("#3").show().animate({left:"50%"},800,"swing",()=>{
				$("#4").animate({left:"50%"},1,()=>{
					$("#4").fadeIn(1000)
				})
			})
		})
	</script>
</body>
</html>