<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $head;?>
</head>
<body  style="min-width:1200px;overflow: hidden;">
	<script>
		var screenWidth=screen.width,screenHeight=screen.height
		if(screenWidth<1100||screenHeight<623){
			location.assign("<?php echo base_url()?>home.html")
		}
	</script>
	<div class="container-fluid mb-1 table-responsive-xl" style="margin: 0px;padding: 0px;height: 100%;min-width:1200px;">
	<table class="table table-borderless" style="height:100%;position: absolute;background-color: rgba(0,0,0,0.7);margin: 0px;top:0;left:0;bottom:0;min-width:1200px;">
		<tr style="width: 100%;height: 100%">
			<td style="width: 50%;padding-left: 20px;padding-top: 70px">
				<div class="alert alert-info mb-1" id="about" style="position: relative;overflow: auto;display: inline-block;opacity: 0;word-break: keep-all;">
					<h1 class="jumbotron" style="padding-bottom:5px;padding-top: 10px;font-family: Cookie,cursive;font-size: 54px;"><i class="fas fa-user"></i> Mwananchi Website<br><pre style="font-size: 24px;font-family: Cookie,cursive;color: darkslategray;">            Leadership with service.</pre></h1>
					Welcome to Mwananchi Website. The website is originally designed for Kenyan citizens to enable them to <strong>know their politicians</strong>. It is meant to bridge the gap between the politician and the citizen in a fun way for everyone. Citizens can now <strong>communicate</strong> with their politicians and post anything with regards to their politicians <strong>on-site</strong>. They will also get a <strong>rating</strong> of the politician depending on the polician's <strong>popolarity</strong> and <strong>efficiency</strong>. Popularity will be gauged on user response to <strong>posts</strong> and <strong>number of followers</strong> while efficiency will be gauged on <strong>achievements</strong> and <strong>critiques</strong> and also the <strong>willingness to help the citizen</strong>. We hope it is fulfilling its intended duty. It was designed using a <strong>social media</strong> approach and thus works like any other social media site out there. Create an account as a <strong>politician</strong> or a <strong>citizen</strong> and enjoy. The site was developed by <strong>Kevin Mwenda</strong> from scratch using web development tools. It was taken live for a beta version on 1<sup>st</sup> November 2018 and has ever since been on maintenance and improvement. It is now in its <strong>version 1.1</strong>. This is the official site index page. Its purpose is to give a brief history of the site and the founder/initial developer. For more information contact us on our homepage. Click proceed when ready to go to the homepage.
				</div>
			</td>
			<td style="width: 50%;padding-left: 25px;padding-top: 170px">
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
							<div style="position: relative;color: gray;margin-left:-350px;font-family: Cookie,cursive;font-size: 24px;" id="three">Created by: Kevin...</div>
							<div id="four" style="position: relative;color: gray;font-family: Cookie,cursive;font-size: 24px;">Version: <span id="version" style="font-size: 22px;letter-spacing: 2px;color: whitesmoke;transition: color 1.5s"></span><br>Year: <span id="year" style="font-size: 22px;letter-spacing: 2px;color: whitesmoke;transition: color 1.5s"></span></div><br><br>
							<button class="btn btn-info" style="color: lightgray;position: relative;font-family: Cookie,cursive;font-size: 24px;padding: 5px 10px;transition: all 0.5s;transition-timing-function: ease-out;display: inline-block;text-align: center;width: 90px;opacity: 0;margin-left: 100px;" onclick="location.assign('<?php echo base_url()?>home.html')"><span>Proceed</span></button>
						</div>
					</div>
				</div>
			</td>
		</tr>	
	</table>
</div>
</body>
</html>