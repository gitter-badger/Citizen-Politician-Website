<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: HomePage.php");
}
?>
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
	<link rel="stylesheet" type="text/css" href="Logged.css">
	<link rel="stylesheet" type="text/css" href="LoggedPhone.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body style="background-color: whitesmoke">
	<div class="container-fluid">
		<?php
			require 'NavBar.php';
		?>
		<div class="container" style="position: relative;top: 90px">
			<div class="jumbotron"><span class="display-4 text-info">Start an Opinion Poll</span><br><small class="text-secondary">Here you can start an opinion poll to be undertaken by citizens.</small></div>
			<div class="alerts"></div>
			<script>
				var poll=Cookies.get("poll")
				var error=Cookies.get("error")
				if(poll!==undefined){
					if(error!==undefined){
						poll=error+"<br>"+poll
						Cookies.remove("error")
					}
					$(".alerts").addClass("alert").addClass("alert-success").html(poll)
					Cookies.remove("poll")
				}
			</script>
			<form class="mb-5" method="post" action="savePoll.php" style="border-radius: 5px;box-shadow: 0px 10px 20px rgba(0,0,0,0.3);padding: 10px;background-image:linear-gradient(-200deg,whitesmoke 40%,ghostwhite 90%)">
				<fieldset style="padding: 30px">
					<legend class="text-info">Poll Form</legend>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">?</span>
						</div>
						<input type="text" name="question" class="form-control" placeholder="Poll Question. . ." required="">
					</div>
					<select class="custom-select mb-3" name="type" required="">
						<option>Yes/No</option>
						<option>Good/Bad</option>
						<option>Percentage</option>
						<option>Words</option>
					</select>
					<div class="custom-control custom-checkbox mb-3">
					    <input class="custom-control-input" type="checkbox" name="potw" value="yes" id="potw">
					    <label class="custom-control-label" for="potw">Poll of The Week?</label>
					</div>
					<button type="submit" class="btn btn-info">Submit</button>
				</fieldset>
			</form>
			<div class="container mb-5">
				<legend class="text-info">Polls History</legend>
				<div class="alert alert-light">
					<div class="text-info mb-3" style="font-size: 21px;">My Polls</div>
					<?php
						$user=$_SESSION['username'];
						$stmt=$connection->query("select poll,type,time,potw,pollID from opinionpolls where poller='$user'");
						if($stmt){
							if(mysqli_num_rows($stmt)>0){
								for($i=0;$row=$stmt->fetch_array(MYSQLI_NUM);$i++){
									echo "<div class='media border p-3 mb-3'><img src='$photo' alt='$user' class='align-self-start mr-3 mt-3 rounded-circle' style='width:60px;'><div class='media-body'><h4>$user <small style='font-size:14px;'><i>Posted on ".date_format(date_create($row[2]),'F d,Y h:i:s')."</i></small></h4><p>$row[0]</p><a class='text-info' data-toggle='collapse' href='#_$row[4]'>See All Answers . . . </a><div id='_$row[4]' class='collapse container'>"; 
									$replies=$connection->query("select answerer,answer,time,ifnull(photo,'anonymous.png') from pollanswers left join citizen_profile on answerer=UserName where postID=$row[4]");
									if($replies){
										if(mysqli_num_rows($replies)>0){
											while($rows=$replies->fetch_array(MYSQLI_NUM)){
												echo "<div class='media p-3'><img src='$rows[3]' alt=$rows[0] class='align-self-start mr-3 mt-3 rounded-circle' style='width:45px;'><div class='media-body'><h4>$rows[0] <small style='font-size:14px;'><i>Answered on ".date_format(date_create($rows[2]),'F d,Y h:i:s')."</i></small></h4><p>$rows[1]</p></div></div>";
											}
										}else{
											echo "No Answers";
										}
									}else{
										echo $replies->error;
									}
									echo "</div></div></div>";
								}
							}else{
								echo "No Polls Started by $user.";
							}
						}else{
							echo $stmt->error;
						}
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>