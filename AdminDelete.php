<?php
session_start();
if(!isset($_SESSION["username"])||$_SESSION["usertype"]!=="admin"){
	header("Location: Homepage.php");
	return;
}
?>
<!DOCTYPE html>
<html lang="en">
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
	<script src="MainJS.js"></script>
</head>
<body>
	<?php
		require 'NavBar.php';
	?>
	<div class="container-fluid">
	<div class="container" style="position:relative;top:100px">
		<div class="alerts"></div>
		<script>
			var del=Cookies.get("success")
			if(del!==undefined){
				$('.alerts').addClass('alert').addClass('alert-success').html(del)
				Cookies.remove("success")
			}
		</script>
		<input class="form-control mb-3" type="text" placeholder="Search for specific user . . . " onkeyup="toggle(this)">
			<script>
				function toggle(event){
					var value = $(event).val().toLowerCase();
					var array= value.split(",")
				    $('.all').filter(function() {
				    	var count=0;
				    	for(var i=0;i<array.length;i++){
				    		if($(this).text().toLowerCase().indexOf(array[i])>-1){
				    			count++
				    		}
				    	}
				    	if(count!==array.length){
				    		$(this).hide()
				    	}else{
				    		$(this).show()
				    	}
				    });
				}
			</script>
		<div class="row d-flex justify-content-center">
			<div class="col-lg-12"><div class="jumbotron"><span class="display-4 text-danger">Account Deactivation</span><br><small>The following are accounts registered on the system.</small></div></div>
		</div>
			<?php
			$stmt=$connection->query("select username,gender,type,photo from citizen_profile union all select userName,gender,accountType,photo from politician_profile where accountVerified=1");
			if($stmt){
				if(mysqli_num_rows($stmt)>0){
					for($count=0;$row = $stmt->fetch_array(MYSQLI_NUM);$count++){
						if($count%4===0&&$count!==0){
							echo "</div></div></div><div class='row d-flex justify-content-center'><div class='col-lg-6 mb-3'><div class='row d-flex justify-content-center'>";
						}else if($count%2===0&&$count!==0){
							echo "</div></div><div class='col-lg-6 mb-3'><div class='row d-flex justify-content-center'>";
						}
						if($count===0){
							echo "<div class='row d-flex justify-content-center'><div class='col-lg-6 mb-3'><div class='row d-flex justify-content-center'>";
						}
						echo "<div class='col-sm-6 mb-3'><div class='card all' style='width:250px'><img class='card-img-top' src='$row[3]' alt='Card image'><div class='card-body'><h4 class='card-title'>$row[0]</h4><p class='card-text'>$row[1]<br>$row[2]<br></p><form action='Delete.php' method='post' class='delete' id='$row[0]'><input type='text' name='action' value='delete' style='display:none'><input style='display:none' type='text' name='user' value='$row[0]'><button type='submit' class='btn btn-danger'>Deactivate Account</button></form></div></div></div>";
					}
					echo "</div></div></div>";
				}else{
					echo "<div class='row d-flex justify-content-center'><div class='text-info col-lg-12'>No Accounts in the database.</div></div>";
				}
			}else{
				echo "<script>$('.alerts').addClass('alert').addClass('alert-danger').html(\"".$connection->error."\")</script>";
			}
			?>
			<div class="row d-flex justify-content-center">
				<div class="col-lg-12"><div class="jumbotron"><span class="display-4 text-success">Account Reactivation</span><br><small>The following are accounts can be reactivated.</small></div></div>
			</div>
			<?php
			$stmt=$connection->query("select username,gender,accountType,photo from deactivated_accounts");
			if($stmt){
				if(mysqli_num_rows($stmt)>0){
					for($count=0;$row = $stmt->fetch_array(MYSQLI_NUM);$count++){
						if($count%4===0&&$count!==0){
							echo "</div></div></div><div class='row d-flex justify-content-center'><div class='col-lg-6 mb-3'><div class='row d-flex justify-content-center'>";
						}else if($count%2===0&&$count!==0){
							echo "</div></div><div class='col-lg-6 mb-3'><div class='row d-flex justify-content-center'>";
						}
						if($count===0){
							echo "<div class='row d-flex justify-content-center'><div class='col-lg-6 mb-3'><div class='row d-flex justify-content-center'>";
						}
						echo "<div class='col-sm-6 container mb-3'><div class='card all' style='width:250px'><img class='card-img-top' src='$row[3]' alt='Card image'><div class='card-body'><h4 class='card-title'>$row[0]</h4><p class='card-text'>$row[1]<br>$row[2]<br></p><form action='Delete.php' method='post' class='reactivate' id='$row[0]'><input type='text' name='action' value='reactivate' style='display:none'><input style='display:none' type='text' name='user' value='$row[0]'><button type='submit' class='btn btn-success'>Reactivate Account</button></form></div></div></div>";
					}
					echo "</div>";
				}else{
					echo "<div class='row d-flex justify-content-center'><div class='text-info col-lg-12 mb-3'>No Accounts have been deactivated yet.</div></div>";
				}
			}else{
				echo "<script>$('.alerts').addClass('alert').addClass('alert-danger').html(\"".$connection->error."\")</script>";
			}
			?>
	</div>
	<script>
		$("form.delete").submit(event=>{
			var ans=confirm("Are you sure you want to deactivate account where username is "+$(event.currentTarget).attr("id")+"?");
			if(!ans){
				return false;
			}
		})

		$("form.reactivate").submit(event=>{
			var ans=confirm("Are you sure you want to reactivate account where username is "+$(event.currentTarget).attr("id")+"?");
			if(!ans){
				return false;
			}
		})
	</script>
</div>
</body>
</html>