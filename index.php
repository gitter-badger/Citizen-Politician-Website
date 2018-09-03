<!DOCTYPE html>
<html>
<head>
	<title>MwanaNchi</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png" href="MwananchiIcon.png">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="MainCSS.css">
	<style>
		button span {
		  	cursor: pointer;
		  	display: inline-block;
		  	position: relative;
		  	transition: 0.5s;
		}

		button span:after {
		  	content: '\00bb';
		  	position: absolute;
		  	opacity: 0;
		  	top: 0;
		  	right: -20px;
		  	transition: 0.5s;
		}

		button:hover span {
		  	padding-right: 20px;
		}

		button:hover span:after {
		  	opacity: 1;
		  	right: 0px;
		}
	</style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="jquery.animateNumber.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="MainJS.js"></script>
</head>
<body style="background-image: none;background-color: rgba(0,0,0,0.1);">
	<script>
		var screenWidth=screen.width,screenHeight=screen.height
		if(screenWidth<576||screenHeight<576){
			location.assign("HomePage.php")
		}
	</script>


	<div class="container-fluid" style="width: 100%;height: 100%;margin: 0;padding: 0;">
		<div id="one" style="background: url(backgroundAbout.png) no-repeat center center;background-size: 100% 100%;height: 100%;width: 100%;">
			<div id="two" style="height: inherit;width: inherit;background-color: rgba(0,0,0,0.7);">
				<div style="position: absolute;top: 68%;left: -10%;margin-left:-85px;color: gray;font-family: Cookie,cursive;font-size: 24px;transition: left 1s;transition-timing-function: ease" id="three">Created by: Kevin and Esther...</div>
				<div id="four" style="position: absolute;top: 73%;left: 50%;margin-left:-85px;color: gray;font-family: Cookie,cursive;font-size: 24px;">Version: <span id="version" style="letter-spacing: 2px;"></span></div>
				<button class="btn" style="background-color: rgba(255,255,255,0.15);color: darkgray;position: absolute;top: 80%;left: 50%;margin-left:-70px;font-family: Cookie,cursive;font-size: 24px;padding: 5px 10px;transition: all 0.5s;transition-timing-function: ease-out;display: inline-block;text-align: center;width: 130px" onclick="location.assign('HomePage.php')"><span>Proceed</span></button>
			</div>
		</div>
	</div>
	<script>
		var decimal_places = 2;
		var decimal_factor = 100;
		$("div,button").not("div.container-fluid").hide();
		$("#one").fadeIn(1500)
		$("#two").fadeIn(1000,()=>{
			$("#three").show().css({left:"50%"})
			$("#four").fadeIn(1300,()=>{
				$('#version').animateNumber({number: 1 * decimal_factor,easing: 'easeInQuad',numberStep: function(now, tween) {
        			var floored_number = Math.floor(now) / decimal_factor;
        			var target = $(tween.elem);
			        target.text(floored_number.toFixed(decimal_places));
      			}
    			},3000,()=>{
    				$("#version").html("1.0 <i style='font-size: 16px'>https://mwananchi.herokuapp.com</i>")
    			});
    			$("button").slideDown()
			})
		})
	</script>
</body>
</html>