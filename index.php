<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mwananchi</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png" href="MwananchiIcon.png">
	<link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="Index.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="jquery.animateNumber.min.js"></script>
	<script src="Index.js"></script>
</head>
<body style="margin:0;height: 100%;background-color: whitesmoke">
	<script>
		var screenWidth=screen.width,screenHeight=screen.height,width=$(window).width(),height=$(window).height()
		if(screenWidth<576||screenHeight<576||width<1100||height<651){
			location.assign("HomePage.php")
		}
	</script>
	<div class="container-fluid ">
		<div class="holder">
			<h1 class="header">
			  	<span class="anime">
			    	<span class="line"></span>
			    	<span class="letters ampersand"><i class="fas fa-user"></i></span>
			    	<span class="letters letters-left">Mwana</span><span class="letters letters-right">Nchi</span>
			    	<span class="line line2"></span>
			  	</span>
			</h1>
		</div>
		<div id="one" style="height: 100%;width: 100%;position: absolute;left:0;">
			<div id="two" style="height: inherit;width: inherit;background-color: rgba(0,0,0,0.7);">
				<div style="position: absolute;top: 63%;left: -10%;margin-left:-45px;color: gray;font-family: Cookie,cursive;font-size: 24px;" id="three">Created by: Kevin and Esther...</div>
				<div id="four" style="position: absolute;top: 68%;left: 50%;margin-left:-45px;color: gray;font-family: Cookie,cursive;font-size: 24px;">Version: <span id="version" style="font-size: 22px;letter-spacing: 2px;color: whitesmoke;transition: color 1.5s"></span><br>Year: <span id="year" style="font-size: 22px;letter-spacing: 2px;color: whitesmoke;transition: color 1.5s"></span></div>
				<button class="btn btn-info" style="color: lightgray;position: absolute;top: 80%;left: 70%;margin-left:-30px;font-family: Cookie,cursive;font-size: 24px;padding: 5px 10px;transition: all 0.5s;transition-timing-function: ease-out;display: inline-block;text-align: center;width: 90px;opacity: 0" onclick="location.assign('HomePage.php')"><span>Proceed</span></button>
			</div>
		</div>
		<div class="alert alert-info" id="about" style="position: absolute;width: 43%;top:70px;bottom: 70px;margin-left: -600px">
			<h1 class="jumbotron" style="padding-bottom:5px;padding-top: 10px;font-family: Cookie,cursive;font-size: 54px;"><i class="fas fa-user"></i> Mwananchi Website<br><pre style="font-size: 24px;font-family: Cookie,cursive;color: darkslategray;">            Leadership with service.</pre></h1>
			Welcome to Mwananchi Website. The website is designed for Kenyan citizens to enable them to <strong>know their politicians</strong>. Kenyans do not usually know the type of leader they select. In most cases, citizens often vote for people in their party or their tribe. After elections, the elected leaders do not fulfil their duties as stipulated in the constitution or their manifesto. Citizens have no way of contacting their leaders to raise a complaint or observation. <br>This web application has come to the rescue. It <strong>displays information about a politician</strong> that is relevant to the public. With this application citizens can also <strong>contact their leaders</strong> and also <strong>post problems and comments related to their respective areas</strong>. Citizens will also be able to see <strong>a detailed analysis of their leaders to help them decide who to vote for.</strong><br>
			The developers <i>Kevin Mwenda</i> and <i>Esther Njoroge</i> believe that this web application is the key to help Kenyans move foward politically.
		</div>
	</div>
</body>
</html>