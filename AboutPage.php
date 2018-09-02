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
	<script src="jquery.animateNumber.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="MainJS.js"></script>
</head>
<body style="background-image: none;background-color: rgba(0,0,0,0.1);">
	<div class="container-fluid" style="width: 100%;height: 100%;margin: 0;padding: 0;">
		<div id="one" style="background: url(backgroundAbout.png) no-repeat center center;background-size: 100% 100%;height: 100%;width: 100%;">
			<div id="two" style="height: inherit;width: inherit;background-color: rgba(0,0,0,0.6);">
				<div style="position: absolute;top: 68%;left: -10%;margin-left:-85px;color: gray;font-family: Cookie,cursive;font-size: 24px;" id="three">Created by: Kevin and Esther...</div>
				<div id="four" style="position: absolute;top: 73%;left: 50%;margin-left:-85px;color: gray;font-family: Cookie,cursive;font-size: 24px;">Version: <span id="version"></span></div>
			</div>	
		</div>
	</div>
	<script>
		var decimal_places = 2;
		var decimal_factor = 100;
		$("div").not("div.container-fluid").hide();
		$("#one").fadeIn(1500)
		$("#two").fadeIn(1000,()=>{
			$("#three").show().animate({left:"50%"},1000,"swing",()=>{
				$("#four").fadeIn(1000,()=>{
					$('#version').animateNumber({number: 1 * decimal_factor,numberStep: function(now, tween) {
        				var floored_number = Math.floor(now) / decimal_factor;
        				var target = $(tween.elem);
				        target.text(floored_number.toFixed(decimal_places));
      				}
    				},5000,()=>{
    					$("#version").text("1.0")
    				});
				})
			})
		})
	</script>
</body>
</html>