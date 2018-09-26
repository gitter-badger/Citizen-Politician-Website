<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mwananchi</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" type="image/png" href="MwananchiIcon.png">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
</head>
<body style="background-color: lavender;">
	<?php
		require "Connection.php";
		session_start();
		$poll=$_POST['question'];
		$poller=$_SESSION['username'];
		$potw=(isset($_POST['potw']))?1:0;
		$type=$_POST['type'];
		$pollID=mysqli_num_rows($connection->query("select * from opinionpolls"))+1;
		$stmt=$connection->query("select * from opinionpolls order by pollID desc");
		date_default_timezone_set("Africa/Nairobi");
		if($stmt&&mysqli_num_rows($stmt)>0&&$potw===1){
			while($row=$stmt->fetch_array(MYSQLI_NUM)){
				if($row[5]==="1"){
					if(date("oW",strtotime($row[3]))===date("oW",strtotime(date("Y-m-d h:i:s")))){
						echo "<script>Cookies.set('error','Poll of the Week already selected. This poll has not been selected to be poll of the week.');</script>";
						$potw=0;
					}
					break;
				}
			}
		}
		if($stmt){
			$stmt=$connection->prepare("insert into opinionpolls(pollID,poll,type,poller,potw) values (?,?,?,?,?)");
			if($stmt&&$stmt->bind_param("isssi",$pollID,$poll,$type,$poller,$potw)){
				if($stmt->execute()){
					echo "<script>Cookies.set('poll','Successfully started poll. Poll ID is $pollID.');location.replace('OpinionPolls.php')</script>";
					return;
				}
			}
		}
	?>
	<br><br>
	<div class="container alert alert-danger">
		<h1 class="jumbotron text-secondary"><i class="fas fa-exclamation-triangle"></i> Error Starting a Poll. <i class="fas fa-exclamation-triangle"></i></h1>
		<div class="alert alert-info">Please take a screenshot and contact administrator of: <i class="text-secondary">https://mwananchi.herokuapp.com</i><br><strong>DO NOT TRY TO FIX ON YOUR OWN!</strong><br>We are sorry for any inconveniences this might have caused to you.</div>
		<div class="alert alert-danger"><i>
			<?php
				echo $stmt->error;
			?>
		</i></div>
	</div>
</body>
</html>


