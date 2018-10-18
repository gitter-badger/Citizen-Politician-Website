<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head;?>
	<style>
		.carousel-indicators li{
		    background-color: #33C1FF;
		}
		.carousel-indicators .active {
		    background-color: gray;
		}
		.carousel-control-prev-icon {
		    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23808080' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
		}

		.carousel-control-next-icon {
		    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23808080' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
		}
		.nav .nav-item .active{
			background-color: #17a2b8;
			color: white;
			border-color: #17a2b8;
		}
		.nav-pills .nav-item .active{
			background-color: darkgray;
			color: white;
			border-color: darkgray;
		}
	</style>
</head>
<body>
<?php echo $navbar;?>
<div class="container-fluid row" style="position: relative;top:70px">
	<div class="col-lg-9">
		<h3 class="text-info">Search Results: <small class="text-muted"><?php echo $word;?></small></h3><br>
		<div class="container-fluid p-0">
			<ul class="nav nav-tabs nav-justified">
				<li class="nav-item">
			    	<a class="nav-link active" data-toggle="tab" href="#users">Users</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#news">News</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#polls">Polls</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#leadership">Leaders</a>
			  	</li>
			</ul>
			<div class="tab-content mt-3 mb-5">
				<div class="tab-pane active" id="users">
					<?php echo $users?>
				</div>
				<div class="tab-pane" id="news">
					<ul class="nav nav-pills nav-justified">
			            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Comments">Comments</a></li>
			            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Achievements">Achievements</a></li>
			            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Critiques">Critiques</a></li>
			        </ul>
			        <div class="tab-content mt-3 mb-5">
		            	<div class="tab-pane active" id="Comments">
	                		<?php echo $comments;?>
						</div>
						<div class="tab-pane fade" id="Achievements">
							<?php echo $achievements;?>
						</div>
						<div class="tab-pane fade " id="Critiques">
							<?php echo $critiques;?>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="polls">
					
				</div>
				<div class="tab-pane" id="leadership">
					
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script>$("table").DataTable({ordering:false,"info":false,"pageLength":10,"lengthChange":false});</script>
</html>