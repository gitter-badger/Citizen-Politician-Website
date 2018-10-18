<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head;?>
</head>
<body>
<?php echo $navbar;?>
<script>$("a[href='<?php echo base_url()?>news_feed.html']").addClass("active");</script>
<div class="container-fluid" style="position: relative;top: 65px;">
	<div class="row mb-3">
		<div class="col-md-3 mb-3">
			<form id="search">
				<div id="search_errors"></div>
				<div class="input-group">
					<input class="form-control" type="text" name="search" placeholder="Search for something . . . " required="">
					<div class="input-group-append">
						<button type="submit" class="btn btn-info">Search</button>
					</div>
				</div>
			</form>
			<script>
				$("#search").submit(event=>{
					event.preventDefault()
					var word=$("input[name='search']").val().trim()
					if(word.match(/[a-z]|[0-9]|[ .:_-]/i)===null){
						$("#search_errors").addClass("alert").addClass("alert-warning").text("Your search string contains unwanted characters.")
						return;
					}
					if(word.match(/[a-z]|[0-9]|[ .:_-]/ig).length!==word.length){
						$("#search_errors").addClass("alert").addClass("alert-warning").text("Your search string contains unwanted characters.")
						return;
					}
					location.assign("<?php echo base_url()?>"+"search/"+word.split(' ').join('-')+".html")
				})
			</script>
		</div>
		<div class="col-md-6 text-center text-info">
			<legend>News_Feed</legend>
		</div>
		<div class="col-md-3 text-center" id="online">
			<div class="custom-control custom-radio">
				<input type="radio" class="custom-control-input" id="isOnline" name="isOnline" disabled="">
				<label class="custom-control-label text-info" for="isOnline">Online</label>
			</div>
		</div>
		<script>
			function checkOnline(){
				$("#isOnline").prop("checked",navigator.onLine)
			}
			setInterval(checkOnline,2000)
		</script>
	</div>
	<div class="row d-flex">
		<div class="col-lg-3 mb-5">
			<div class="text-center">
				<a class="text-muted" style="text-decoration: none;" href="">
	            <img src="<?php echo $this->session->userdata('photo');?>" class="rounded-circle img-thumbnail mb-2 w-50"><br>
	            <span style="text-transform: capitalize;font-size: 24px;font-weight: bolder;">@ <?php echo $this->session->userdata('username');?></span></a>
	        </div><hr><hr>
	        <?php echo $activity;?>
		</div>
		<div class="col-lg-6 mb-5 p-0" style="width: 100%">
			<div>
				<ul class="nav nav-tabs bg-info d-flex justify-content-between">
		            <li class="nav-item" style="width: 33%"><a class="nav-link active" style="color: darkslategray;border-radius: 0" data-toggle="tab" href="#Comments">Comments</a></li>
		            <li class="nav-item" style="width: 34%"><a class="nav-link" style="color: darkslategray;border-radius: 0" data-toggle="tab" href="#Achievements">Achievements</a></li>
		            <li class="nav-item" style="width: 33%;"><a class="nav-link" style="color: darkslategray;border-radius: 0;w" data-toggle="tab" href="#Critiques">Critiques</a></li>
		        </ul>
		        <div class="tab-content mb-5" style="border: 1px solid rgba(0,0,0,0.1);border-radius: 10px;border-top-left-radius: 0px;border-top-right-radius: 0px;background-color: white">
	            	<div class="tab-pane container active show mt-3 mb-4" id="Comments">
                		<?php echo $comments;?>
					</div>
					<div class="tab-pane container fade mt-3 mb-4" id="Achievements">
						<?php echo $achievements;?>
					</div>
					<div class="tab-pane container fade mt-3 mb-4" id="Critiques">
						<?php echo $critiques;?>
					</div>
				</div>
		    </div>
		</div>
		<div class="col-lg-3 mb-5">
	        <?php echo $potw.$election_date;?>
		</div>
	</div>
</div>
</body>
<script>$("table").DataTable({ordering:false,"info":false,"pageLength":25,"lengthChange":false});</script>
</html>