<?php
require "Connection.php";
session_start();
if(!isset($_SESSION["username"])||$_SESSION["usertype"]!=="admin"){
	header("Location: Homepage.php");
	return;
}
$photo=$_SESSION["photo"];
date_default_timezone_set("Africa/Nairobi");
$currDate=date("Y-m-d");
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
	<style>
		@media screen and (max-width: 992px){
			div.collapse{
				max-height: 320px;
				overflow-y: auto;
			}
		}
	</style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body style="background-color: whitesmoke">
	<nav class="navbar bg-info navbar-light navbar-expand-lg fixed-top" style="border-radius: 5px;">
		<a class="navbar-brand text-dark" href="StartAdmin.php" style="font-family: Cookie,cursive;font-size: 24px;padding-bottom: 2px;padding-top: 2px;"><i class="fas fa-user"></i> Mwananchi</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#smallScreen" style="outline: none;">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="smallScreen">
			<ul class="navbar-nav mr-auto">
		      <li class="nav-item navigationBar">
		        <a class="nav-link text-light" href="StartAdmin.php">Home</a>
		      </li>
		      <li class="nav-item navigationBar">
		        <a class="nav-link text-light" href="BugReport.php">Bug Report</a>
		      </li>
		      <li class="nav-item navigationBar">
		        <a class="nav-link text-light" href="ContactsPage.php">Contacts</a>
		      </li> 
		      <li class="nav-item navigationBar">
		        <a class="nav-link text-light" href="HelpPage.php">Help</a>
		      </li> 
		    </ul>
		    <ul class="navbar-nav">
		    	<li class="nav-item navigationBar"><a class="nav-link text-light" href="Settings.php"><span class="fas fa-cog"></span> Settings</a></li>
		    	<li class="nav-item dropdown navigationBar"><a class="nav-link dropdown-toggle text-light" data-toggle="dropdown" href=""><span class="rounded-circle"><img src="<?php echo $photo; ?>" width="25px" height="25px"></span> My Profile </a>
		    		<div class="dropdown-menu bg-info" style="padding: 3px;border-radius: 5px;padding-top: 13px">
		    			<a class="dropdown-item text-dark" href="MyProfile.php">@ <?php echo $_SESSION["username"]; ?></a><hr>
			    			<a class="dropdown-item text-dark" href="Stories.php">Recent Stories</a>
			    			<a class="dropdown-item text-dark" href="Functions.php">Functions</a>
			    			<a class="dropdown-item text-dark" href="SendEmails.php">Send Emails</a>
			    			<a class="dropdown-item text-dark" href="RegisterAdmin.php">Add Admin</a>
			    			<a class="dropdown-item text-dark" href="AdminDelete.php">Delete Accounts</a>
			    			<a class="dropdown-item text-dark" href="Logout.php">Logout</a>
		    		</div>
		    	</li>
		    </ul>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="container" style="position: relative;top: 120px;">
			<div class="alerts"></div>
			<script>
				var date=Cookies.get("date")
				if(date!==undefined){
					$('.alerts').addClass('alert').addClass('alert-success').html(date)
					$("body,html").animate({scrollTop: 0},'fast')
					Cookies.remove("date")
				}
				var update=Cookies.get("update")
				if(update!==undefined){
					$('.alerts').addClass('alert').addClass('alert-success').html(update)
					$("body,html").animate({scrollTop: 0},'fast')
					Cookies.remove("update")
				}
			</script>
			<div class="jumbotron"><span class="display-4 text-info">Site Settings Page.</span><br><small class="text-secondary">Here you can add more supported counties, constituencies or wards, set leaders for various regions, set the election date, etc.</small></div>
			<div class="alert alert-info" style="text-align: center;padding-bottom: 25px;"><strong>Next Election Date is: </strong><span id="electionDate"><?php $file=fopen("Resources/Site Data/ElectionDate.txt", "r");$date=fgets($file);fclose($file);if($currDate>$date){
				$file=fopen("Resources/Site Data/ElectionDate.txt", "w+");
				fwrite($file,"Unknown");
				fclose($file);
				echo "Unknown";
			}else echo $date;?></span><button class="btn btn-primary float-right" style="width: 100px" data-toggle="modal" data-target="#changeDate">Change</button></div>
			<table class="table table-dark table-striped table-hover">
				<thead>
					<tr>
						<td colspan="3"><div class="jumbotron text-dark"><span class="display-4">Counties</span><br><small class="text-secondary">Here are some of the registered counties.</small></div></td>
					</tr>
				</thead>
				<tr class="bg-secondary text-dark">
					<td>County ID</td><td>County Name</td><td>County Governor</td>
				</tr>
				<tr>
					<?php
						$stmt=$connection->query("select * from counties");
						if($stmt){
							if(mysqli_num_rows($stmt)>0){
								while($row=$stmt->fetch_array(MYSQLI_NUM))
									echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
							}else{
								echo "<tr><td class='text-info' colspan='3'>No Counties in Database.</td></tr>";
							}
						}else{
							echo "<script>$('.alerts').addClass('alert').addClass('alert-danger').html(\"".$connection->error."\")</script>";
						}
					?>
				</tr>
				<tr><td colspan="3"><button class="btn btn-primary" style="width: 250px" data-toggle="modal" data-target="#governor">Set Governor</button> <button class="btn btn-primary" style="width: 250px">Add More Counties</button></td></tr>
			</table><br>
			<table class="table table-dark table-striped table-hover">
				<thead>
					<tr>
						<td colspan="4"><div class="jumbotron text-dark"><span class="display-4">Constituencies</span><br><small class="text-secondary">Here are some of the registered constituencies.</small></div></td>
					</tr>
				</thead>
				<tr class="bg-secondary text-dark">
					<td>Constituency ID</td><td>Constituency Name</td><td>County Location</td><td>Member of Parliament</td>
				</tr>
				<tr>
					<?php
						$stmt=$connection->query("select constituencyID,constituency,County,MP from constituencies left join counties on countyNo=CountyID");
						if($stmt){
							if(mysqli_num_rows($stmt)>0){
								while($row=$stmt->fetch_array(MYSQLI_NUM))
									echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
							}else{
								echo "<tr><td class='text-info' colspan='4'>No Constituencies in Database.</td></tr>";
							}
						}else{
							echo "<script>$('.alerts').addClass('alert').addClass('alert-danger').html(\"".$connection->error."\")</script>";
						}
					?>
				</tr>
				<tr><td colspan="4"><button class="btn btn-primary" style="width: 250px" data-toggle="modal" data-target="#mp">Set MPs</button> <button class="btn btn-primary" style="width: 250px">Add More Constituencies</button></td></tr>
			</table><br>
			<table class="table table-dark table-striped table-hover">
				<thead>
					<tr>
						<td colspan="5"><div class="jumbotron text-dark"><span class="display-4">Wards</span><br><small class="text-secondary">Here are some of the registered wards.</small></div></td>
					</tr>
				</thead>
				<tr class="bg-secondary text-dark">
					<td>Ward ID</td><td>Ward Name</td><td>Constituency Location</td><td>County Location</td><td>Member of County Assembly</td>
				</tr>
				<tr>
					<?php
						$stmt=$connection->query("select wardID,Ward,constituency,County,MCA from wards left join (select constituencyID,constituency,County from constituencies left join counties on countyNo=CountyID) as temp on temp.constituencyID=wards.constituencyID;");
						if($stmt){
							if(mysqli_num_rows($stmt)>0){
								while($row=$stmt->fetch_array(MYSQLI_NUM))
									echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
							}else{
								echo "<tr><td class='text-info' colspan='5'>No Constituencies in Database.</td></tr>";
							}
						}else{
							echo "<script>$('.alerts').addClass('alert').addClass('alert-danger').html(\"".$connection->error."\")</script>";
						}
					?>
				</tr>
				<tr><td colspan="5"><button class="btn btn-primary" style="width: 250px" data-toggle="modal" data-target="#MCA">Set MCAs</button> <button class="btn btn-primary" style="width: 250px">Add More Wards</button></td></tr>
			</table><br>
		</div>
	</div>
	<div id="changeDate" class="modal">
	  	<div class="modal-dialog">
		  	<div class="modal-content">
		      	<div class="modal-header">
				  	<h4 class="modal-title">Change Election Date</h4>
				  	<button type="button" class="close" data-dismiss="modal">&times;</button>
			  	</div>
		      	<div class="modal-body">
			        <form>
			        	<input class="form-control" type="date" min="<?php echo $currDate;?>" id="date" required="">
			        </form>
			  	</div>
			    <div class="modal-footer">
			    	<button type="button" class="btn btn-info" id="change" data-dismiss="modal">Change</button>
			    </div>
		    </div>
		</div>
	</div>

	<div id="governor" class="modal">
	  	<div class="modal-dialog">
		  	<div class="modal-content">
		      	<div class="modal-header">
				  	<h4 class="modal-title">Change Governor</h4>
				  	<button type="button" class="close" data-dismiss="modal">&times;</button>
			  	</div>
		      	<div class="modal-body">
			        <form>
			        	<select class="custom-select mb-3" id="counties" style="cursor: pointer;" required="">
							<?php
								$stmt=$connection->query("Select * from counties");
								if ($stmt->num_rows > 0) {
								    while($row = $stmt->fetch_array(MYSQLI_NUM)) {
        								echo "<option id=$row[0]>$row[1]</option>";
    								}
								} else {
    								echo "<option>No Supported Counties</option>";
								}
							?>
						</select>
			        	<input class="form-control" type="text" id="govName" placeholder="Governor Name">
			        </form>
			  	</div>
			    <div class="modal-footer">
			    	<button type="button" class="btn btn-info" id="setGovernor" data-dismiss="modal">Set Governor</button>
			    </div>
		    </div>
		</div>
	</div>

	<div id="mp" class="modal">
	  	<div class="modal-dialog">
		  	<div class="modal-content">
		      	<div class="modal-header">
				  	<h4 class="modal-title">Change MP</h4>
				  	<button type="button" class="close" data-dismiss="modal">&times;</button>
			  	</div>
		      	<div class="modal-body">
			        <form>
			        	<select class="custom-select mb-3" id="constituencies" style="cursor: pointer;" required="">
							<?php
								$stmt=$connection->query("Select * from constituencies");
								if ($stmt->num_rows > 0) {
								    while($row = $stmt->fetch_array(MYSQLI_NUM)) {
        								echo "<option id=$row[0]>$row[1]</option>";
    								}
								} else {
    								echo "<option>No Supported Constituencies</option>";
								}
							?>
						</select>
			        	<input class="form-control" type="text" id="MPName" placeholder="MP Name">
			        </form>
			  	</div>
			    <div class="modal-footer">
			    	<button type="button" class="btn btn-info" id="setMP" data-dismiss="modal">Set MP</button>
			    </div>
		    </div>
		</div>
	</div>


	<div id="MCA" class="modal">
	  	<div class="modal-dialog">
		  	<div class="modal-content">
		      	<div class="modal-header">
				  	<h4 class="modal-title">Change MCA</h4>
				  	<button type="button" class="close" data-dismiss="modal">&times;</button>
			  	</div>
		      	<div class="modal-body">
			        <form>
			        	<select class="custom-select mb-3" id="wards" style="cursor: pointer;" required="">
							<?php
								$stmt=$connection->query("Select * from wards");
								if ($stmt->num_rows > 0) {
								    while($row = $stmt->fetch_array(MYSQLI_NUM)) {
        								echo "<option id=$row[0]>$row[1]</option>";
    								}
								} else {
    								echo "<option>No Supported Wards</option>";
								}
							?>
						</select>
			        	<input class="form-control" type="text" id="MCAName" placeholder="MCA Name">
			        </form>
			  	</div>
			    <div class="modal-footer">
			    	<button type="button" class="btn btn-info" id="setMCA" data-dismiss="modal">Set MCA</button>
			    </div>
		    </div>
		</div>
	</div>
	<script>
		$('#change').click(()=>{
			var date=$("#date").val().trim()
			if(date.length!==0){
				$.post('ElectionDate.php',{date:date}, data=> {
					Cookies.set("date",data)
					location.reload(true)
	   			});
			}
		})
		
		$("#setGovernor").click(()=>{
			var county=$("#counties").find(":selected").attr("id")
			var gov=$("#govName").val().trim()
			if(gov.length!==0){
				$.post("updateLeaders.php",{table:"counties",id:county,governor:gov},data=>{
					Cookies.set("update",data);
					location.reload(true)
				})
			}
		})	

		$("#setMP").click(()=>{
			var consti=$("#constituencies").find(":selected").attr("id")
			var mp=$("#MPName").val().trim()
			if(mp.length!==0){
				$.post("updateLeaders.php",{table:"constituencies",id:consti,governor:mp},data=>{
					Cookies.set("update",data);
					location.reload(true)
				})
			}
		})

		$("#setMCA").click(()=>{
			var ward=$("#wards").find(":selected").attr("id")
			var mca=$("#MCAName").val().trim()
			if(mca.length!==0){
				$.post("updateLeaders.php",{table:"wards",id:ward,governor:mca},data=>{
					Cookies.set("update",data);
					location.reload(true)
				})
			}
		})	
	</script>";
	
</body>
</html>