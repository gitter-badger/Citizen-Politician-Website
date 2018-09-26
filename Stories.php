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
	</div>
	<div class="container-fluid" style="position: relative;top: 65px;">
		<div class="row mb-3">
			<div class="col-md-3 mb-3">
				<form>
					<div class="input-group">
						<input class="form-control" type="text" name="search" placeholder="Search for something . . . " required="">
						<div class="input-group-append">
							<button type="submit" class="btn btn-info">Search</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-6 text-center text-info">
				<legend>News Feed</legend>
			</div>
			<div class="col-md-3 text-center" id="online">
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="isOnline" name="isOnline" readonly="">
					<label class="custom-control-label text-info" for="isOnline">Online</label>
				</div>
			</div>
			<script>
				$("#isOnline").prop("checked",navigator.onLine)
			</script>
		</div>
		<div class="row">
			<div class="col-md-3 mb-5">
				<div class="text-center">
	              <img src="<?php echo $photo;?>" class="avatar img-circle img-thumbnail mb-2 w-75">
	            </div><hr><hr>             
	            <ul class="list-group w-75 ml-auto mr-auto" style="overflow-x: auto;">
	              <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center"><div>Activity <small>(One Week)</small></div> <i class="fab fa-hotjar"></i></li>
	              <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Shares</strong> <span class="badge badge-info ml-auto">125</span></li>
	              <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Likes</strong> <span class="badge badge-info ml-auto">13</span></li>
	              <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Posts</strong> <span class="badge badge-info ml-auto">37</span></li>
	              <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Followers</strong> <span class="badge badge-info ml-auto">78</span></li>
	            </ul><hr><hr>
			</div>
			<div class="col-md-6 mb-5">
				<div>
					<ul class="nav nav-tabs bg-info">
		              <li class="nav-item" style="width: 33.333333%"><a class="nav-link active" style="color: darkslategray;border-radius: 0" data-toggle="tab" href="#Comments">Comments</a></li>
		              <li class="nav-item" style="width: 33.333333%"><a class="nav-link" style="color: darkslategray;border-radius: 0" data-toggle="tab" href="#Achievements">Achievements</a></li>
		              <li class="nav-item" style="width: 33.333333%"><a class="nav-link" style="color: darkslategray;border-radius: 0" data-toggle="tab" href="#Critiques">Critiques</a></li>
		            </ul>

		            <div class="tab-content mb-5" style="border: 1px ridge rgba(0,0,0,0.1);border-radius: 10px;border-top-left-radius: 0px;border-top-right-radius: 0px;background-image: linear-gradient(-200deg,whitesmoke 10%,ghostwhite 90%);">
		            	<div class="tab-pane container active show" id="Comments">
	                		<hr>
	                		<form style="padding-left: 30px;padding-right: 30px;" class="mb-4">
								<div class="form-group mb-0" style="border-bottom-right-radius: 7px !important;box-shadow: 8px 10px 16px rgba(0,0,0,0.3);">
									<textarea class="form-control" rows="3" style="border-bottom-left-radius: 0;border-bottom-right-radius: 0;width: 100%;" name="comment" placeholder="Post a Comment . . . " required=""></textarea>
									<div class="alert alert-secondary mb-0" style="border-top-left-radius: 0;border-top-right-radius: 0;padding: 0px;">
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-muted p-2" style="font-family: Cookie,cursive;"><i class="fa fa-user"></i> Mwananchi</span>
											<button type="submit" class="btn btn-info rounded-0"  style="width: 70px;border-bottom-right-radius: 3px !important;">Post</button>
										</div>
									</div>
								</div>
							</form>
							<hr>
						</div>
						<div class="tab-pane container fade" id="Achievements">
							<hr>
	                		<form style="padding-left: 30px;padding-right: 30px;" class="mb-4">
								<div class="form-group mb-0" style="border-bottom-right-radius: 7px !important;box-shadow: 8px 10px 16px rgba(0,0,0,0.3);">
									<textarea class="form-control" rows="3" style="border-bottom-left-radius: 0;border-bottom-right-radius: 0;width: 100%;" name="achievement" placeholder="Post an Achievement . . . " required=""></textarea>
									<div class="alert alert-secondary mb-0" style="border-top-left-radius: 0;border-top-right-radius: 0;padding: 0px;">
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-muted p-2" style="font-family: Cookie,cursive;"><i class="fa fa-user"></i> Mwananchi</span>
											<button type="submit" class="btn btn-info rounded-0"  style="width: 70px;border-bottom-right-radius: 3px !important;">Post</button>
										</div>
									</div>
								</div>
							</form>
							<hr>
						</div>
						<div class="tab-pane container fade" id="Critiques">
							<hr>
	                		<form style="padding-left: 30px;padding-right: 30px;" class="mb-4">
								<div class="form-group mb-0" style="border-bottom-right-radius: 7px !important;box-shadow: 8px 10px 16px rgba(0,0,0,0.3);">
									<textarea class="form-control" rows="3" style="border-bottom-left-radius: 0;border-bottom-right-radius: 0;width: 100%;" name="critique" placeholder="Post a Critique . . . " required=""></textarea>
									<div class="alert alert-secondary mb-0" style="border-top-left-radius: 0;border-top-right-radius: 0;padding: 0px;">
										<div class="d-flex justify-content-between align-items-center">
											<span class="text-muted p-2" style="font-family: Cookie,cursive;"><i class="fa fa-user"></i> Mwananchi</span>
											<button type="submit" class="btn btn-info rounded-0"  style="width: 70px;border-bottom-right-radius: 3px !important;">Post</button>
										</div>
									</div>
								</div>
							</form>
							<hr>
						</div>
		            </div>
				</div>
			</div>
			<div class="col-md-3 mb-5">
				<audio src="https://res.cloudinary.com/dkgtd3pil/video/upload/v1537849052/mwananchi/tonightstart.mp3" controls="">The Browser Does Not Support This Element</audio>
				<video src="biggie%20(2).mp4" width="100%" height="auto" controls="">Not Supported</video>
			</div>
		</div>
	</div>
	
</body>
</html>