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
<body  style="margin:0;background-color: whitesmoke;min-width:1200px;">
	<script>
		var screenWidth=screen.width,screenHeight=screen.height
		if(screenWidth<576||screenHeight<576){
			location.assign("HomePage.php")
		}
	</script>
	<div class="container-fluid mb-1 table-responsive-xl" style="margin: 0px;padding: 0px;height: 100%;min-width:1200px;">
	<table class="table table-borderless" style="height:100%;position: absolute;background-color: rgba(0,0,0,0.7);margin: 0px;top:0;left:0;bottom:0;min-width:1200px;">
		<tr style="width: 100%;height: 100%">
			<td style="width: 50%;padding-left: 20px;padding-top: 70px">
				<div class="alert alert-info mb-1" id="about" style="position: relative;overflow: auto;display: inline-block;opacity: 0;">
					<h1 class="jumbotron" style="padding-bottom:5px;padding-top: 10px;font-family: Cookie,cursive;font-size: 54px;"><i class="fas fa-user"></i> Mwananchi Website<br><pre style="font-size: 24px;font-family: Cookie,cursive;color: darkslategray;">            Leadership with service.</pre></h1>
					Welcome to Mwananchi Website. The website is designed for Kenyan citizens to enable them to <strong>know their politicians</strong>. Kenyans do not usually know the type of leader they select. In most cases, citizens often vote for people in their party or their tribe. After elections, the elected leaders do not fulfil their duties as stipulated in the constitution or their manifesto. Citizens have no way of contacting their leaders to raise a complaint or observation. <br>This web application has come to the rescue. It <strong>displays information about a politician</strong> that is relevant to the public. With this application citizens can also <strong>contact their leaders</strong> and also <strong>post problems and comments related to their respective areas</strong>. Citizens will also be able to see <strong>a detailed analysis of their leaders to help them decide who to vote for.</strong><br>
					The developers <i>Kevin Mwenda</i> and <i>Esther Njoroge</i> believe that this web application is the key to help Kenyans move foward politically.
				</div>
			</td>
			<td style="width: 50%;padding-left: 25px;padding-top: 190px">
				<div>
					<div class="holder">
						<h1 class="header">
						  	<span class="anime">
						    	<span class="line"></span>
						    	<span class="letters ampersand"><i class="fas fa-user"></i></span>
						    	<span class="letters letters-left">Mwana</span><span class="letters letters-right">nchi</span>
						    	<span class="line line2"></span>
						  	</span>
						</h1>
					</div>	
					<div id="one" style="position: relative;left:0;overflow: auto;width: 100%;height: 100%;">
						<div id="two" style="bottom:0;">
							<div style="position: relative;color: gray;margin-left:-350px;font-family: Cookie,cursive;font-size: 24px;" id="three">Created by: Kevin and Esther...</div>
							<div id="four" style="position: relative;color: gray;font-family: Cookie,cursive;font-size: 24px;">Version: <span id="version" style="font-size: 22px;letter-spacing: 2px;color: whitesmoke;transition: color 1.5s"></span><br>Year: <span id="year" style="font-size: 22px;letter-spacing: 2px;color: whitesmoke;transition: color 1.5s"></span></div><br><br>
							<button class="btn btn-info" style="color: lightgray;position: relative;font-family: Cookie,cursive;font-size: 24px;padding: 5px 10px;transition: all 0.5s;transition-timing-function: ease-out;display: inline-block;text-align: center;width: 90px;opacity: 0;margin-left: 100px;" onclick="location.assign('HomePage.php')"><span>Proceed</span></button>
						</div>
					</div>
				</div>
			</td>
		</tr>	
	</table>
</div>
</body>
</html>