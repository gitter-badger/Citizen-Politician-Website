<?php
session_start();
if(!isset($_SESSION["username"])||$_SESSION["usertype"]!=="admin"){
	header("Location: Homepage.php");
	return;
}
date_default_timezone_set("Africa/Nairobi");
$currDate=date("Y-m-d");
$countyNo=0;
$constiNo=0;
$wardNo=0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mwananchi</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.7">

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
	<script src="SiteSettings.js"></script>
</head>
<body style="background-color: whitesmoke;min-width: 550px">
	<?php
		require 'NavBar.php';
	?>
	<div class="container-fluid">
		<div class="navigatorUp" style="display: none;position: fixed;bottom: 30px;left: 20px;z-index: 99;">
			<a class="rounded-circle fa fa-arrow-up text-secondary" style="background-color: rgba(0,0,0,0.3);padding: 15px;" href=""></a>
		</div>
		<div class="navigatorDown" style="position: fixed;bottom: 30px;right: 20px;z-index: 99;">
			<a class="rounded-circle fa fa-arrow-down text-secondary" style="background-color: rgba(0,0,0,0.3);padding: 15px;" href=""></a>
		</div>
		<div class="container" style="position: relative;top: 90px;">
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
			<div class="alert alert-info" style="text-align: center;"><div class="mb-1"><strong>Next Election Date is: </strong><span id="electionDate"><?php $file=fopen("Resources/Site Data/ElectionDate.txt", "r");$date=fgets($file);fclose($file);if($currDate>$date){
				$file=fopen("Resources/Site Data/ElectionDate.txt", "w+");
				fwrite($file,"Unknown");
				fclose($file);
				echo "Unknown";
			}else echo $date;?></span></div> <button class="btn btn-primary" style="width: 100px" data-toggle="modal" data-target="#changeDate">Change</button></div>
			<div class="alert alert-success" style="text-align: center;"><div class="mb-1"><strong>Site's Official Email Address is: </strong><span id="siteEmail"><?php $file=fopen("Resources/Site Data/SiteEmail.txt", "r");$email=fgets($file);fclose($file);echo $email;?></span></div><button class="btn btn-info" style="width: 100px" id="btnEmail" data-toggle="modal" data-target="#changeEmail">Change</button></div>
			<div class="alert alert-secondary">
				<span class="text-info" style="text-decoration: underline;">Table of Contents</span> <small class="text-dark">(click any link below to navigate to that table.)</small><br>
				<span class="toc" style="margin-right: 50px;"><a class="text-secondary" href="">County</a></span>
				<span class="toc" style="margin-right: 50px;"><a class="text-secondary" href="">Constituencies</a></span>
				<span class="toc" style="margin-right: 50px;"><a class="text-secondary" href="">Wards</a></span>
			</div>
			<table id="CountyTable" class="table table-dark table-striped table-hover">
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
								while($row=$stmt->fetch_array(MYSQLI_NUM)){
									$countyNo++;
									echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
								}
								$countyNo++;
							}else{
								echo "<tr><td class='text-info' colspan='3'>No Counties in Database.</td></tr>";
							}
						}else{
							echo "<script>$('.alerts').addClass('alert').addClass('alert-danger').html(\"".$connection->error."\")</script>";
						}
					?>
				</tr>
				<tr><td colspan="3"><button class="btn btn-primary mb-1" style="width: 250px" data-toggle="modal" data-target="#governor">Set Governor</button> <button class="btn btn-primary mb-1" style="width: 250px" data-toggle="modal" data-target="#addCounties">Add More Counties</button></td></tr>
			</table><br>
			<table id="ConstituenciesTable" class="table table-dark table-striped table-hover">
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
								while($row=$stmt->fetch_array(MYSQLI_NUM)){
									$constiNo++;
									echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
								}
								$constiNo++;
							}else{
								echo "<tr><td class='text-info' colspan='4'>No Constituencies in Database.</td></tr>";
							}
						}else{
							echo "<script>$('.alerts').addClass('alert').addClass('alert-danger').html(\"".$connection->error."\")</script>";
						}
					?>
				</tr>
				<tr><td colspan="4"><button class="btn btn-primary mb-1" style="width: 250px" data-toggle="modal" data-target="#mp">Set MPs</button> <button class="btn btn-primary mb-1" style="width: 250px" data-toggle="modal" data-target="#addConsti">Add More Constituencies</button></td></tr>
			</table><br>
			<table id="WardsTable" class="table table-dark table-striped table-hover">
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
								while($row=$stmt->fetch_array(MYSQLI_NUM)){
									$wardNo++;
									echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
								}
								$wardNo++;
							}else{
								echo "<tr><td class='text-info' colspan='5'>No Constituencies in Database.</td></tr>";
							}
						}else{
							echo "<script>$('.alerts').addClass('alert').addClass('alert-danger').html(\"".$connection->error."\")</script>";
						}
					?>
				</tr>
				<tr><td colspan="5"><button class="btn btn-primary mb-1" style="width: 250px" data-toggle="modal" data-target="#MCA">Set MCAs</button> <button class="btn btn-primary mb-1" style="width: 250px" data-toggle="modal" data-target="#addWards">Add More Wards</button></td></tr>
			</table><br>
		</div>
	</div>

	<div id="changeDate" class="modal">
	  	<div class="modal-dialog">
		  	<div class="modal-content">
		      	<div class="modal-header">
				  	<h4 class="modal-title">Change Election Date</h4>
				  	<button type="button" class="close" style="outline: none;" data-dismiss="modal">&times;</button>
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

	<div id="changeEmail" class="modal">
	  	<div class="modal-dialog">
		  	<div class="modal-content">
		      	<div class="modal-header">
				  	<h4 class="modal-title">Change Site's Email</h4>
				  	<button type="button" style="outline: none;" class="close" data-dismiss="modal">&times;</button>
			  	</div>
		      	<div class="modal-body">
			        <form>
			        	<div class="input-group mb-3">
				        	<input class="form-control" type="email" id="email" placeholder="Email Address" required="">
				        	<div class="input-group-append">
								<span class="input-group-text fa" id="emailTrack"></span>
							</div>
						</div>
						<div class="input-group mb-3">
				        	<input class="form-control" type="email" id="test" placeholder="Test Email Address" required="">
				        	<div class="input-group-append">
								<span class="input-group-text fa" id="testTrack"></span>
							</div>
						</div>
			        	<input class="form-control" type="password" id="emailPass" placeholder="Password" required="">
			        </form>
			  	</div>
			    <div class="modal-footer">
			    	<button type="button" class="btn btn-info" id="changEmail" data-dismiss="modal">Change</button>
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

	<div id="addCounties" class="modal">
		<div class="modal-dialog">
		  	<div class="modal-content">
		      	<div class="modal-header">
				  	<h4 class="modal-title">Add County</h4>
				  	<button type="button" class="close" data-dismiss="modal">&times;</button>
			  	</div>
		      	<div class="modal-body">
			        <form>
			        	<input class="form-control mb-3" type="text" id="countyID" value="<?php echo $countyNo;?>" readonly="">
			        	<input class="form-control mb-3" type="text" id="county" placeholder="County Name">
			        	<input class="form-control mb-3" type="text" id="countyLeader" value="Undefined">
			        </form>
			  	</div>
			    <div class="modal-footer">
			    	<button type="button" class="btn btn-info" id="addCounty" data-dismiss="modal">Add County</button>
			    </div>
		    </div>
		</div>
	</div>

	<div id="addConsti" class="modal">
		<div class="modal-dialog">
		  	<div class="modal-content">
		      	<div class="modal-header">
				  	<h4 class="modal-title">Add Constituency</h4>
				  	<button type="button" class="close" data-dismiss="modal">&times;</button>
			  	</div>
		      	<div class="modal-body">
			        <form>
			        	<input class="form-control mb-3" type="text" id="constiID" value="<?php echo $constiNo;?>" readonly="">
			        	<input class="form-control mb-3" type="text" id="consti" placeholder="Constituency Name">
			        	<select class="custom-select mb-3" id="counti" style="cursor: pointer;" required="">
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
			        	<input class="form-control" type="text" id="constiLeader" value="Undefined">
			        </form>
			  	</div>
			    <div class="modal-footer">
			    	<button type="button" class="btn btn-info" id="addConst" data-dismiss="modal">Add Constituency</button>
			    </div>
		    </div>
		</div>
	</div>

	<div id="addWards" class="modal">
		<div class="modal-dialog">
		  	<div class="modal-content">
		      	<div class="modal-header">
				  	<h4 class="modal-title">Add Wards</h4>
				  	<button type="button" class="close" data-dismiss="modal">&times;</button>
			  	</div>
		      	<div class="modal-body">
			        <form>
			        	<input class="form-control mb-3" type="text" id="wardID" value="<?php echo $wardNo;?>" readonly="">
			        	<input class="form-control mb-3" type="text" id="ward" placeholder="Ward Name">
			        	<select class="custom-select mb-3" id="consty" style="cursor: pointer;" required="">
							<?php
								$stmt=$connection->query("Select * from constituencies");
								if ($stmt->num_rows > 0) {
								    while($row = $stmt->fetch_array(MYSQLI_NUM)) {
        								echo "<option id=$row[0]>$row[1]</option>";
    								}
								} else {
    								echo "<option>No Supported Counties</option>";
								}
							?>
						</select>
			        	<input class="form-control" type="text" id="wardLeader" value="Undefined">
			        </form>
			  	</div>
			    <div class="modal-footer">
			    	<button type="button" class="btn btn-info" id="addWard" data-dismiss="modal">Add Ward</button>
			    </div>
		    </div>
		</div>
	</div>
</body>
</html>