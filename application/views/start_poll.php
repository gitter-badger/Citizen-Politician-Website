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
<script>$("a[href='<?php echo base_url()?>start_poll.html']").addClass("active");</script>
<div class="container" style="position: relative;top: 60px">
	<?php echo $this->session->flashdata("log"); ?>
	<legend class="text-info">Poll Form</legend>
	<form class="mb-5" method="post" action="<?php echo site_url('submit_poll')?>" style="border-radius: 5px;box-shadow: 0px 0px 10px rgba(0,0,0,0.5);padding: 10px;">
		<fieldset style="padding: 30px">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">?</span>
				</div>
				<input type="text" name="question" class="form-control" placeholder="Poll Question. . ." required="">
			</div>
			<label for="type">What type of poll is this?: </label>
			<select class="custom-select mb-3" id="type" name="type" required="">
				<option>Yes/No</option>
				<option>Good/Bad</option>
				<option>Likely/Unlikely</option>
				<option>Percentage</option>
				<option>Words</option>
			</select>
			<?php
				if($this->session->userdata("usertype") ==="admin"){
					echo "<div class='custom-control custom-checkbox mb-3'><input class='custom-control-input' type='checkbox' name='potw' value='yes' id='potw'><label class='custom-control-label' for='potw'>Poll of The Week?</label></div>";
				}
			?>
			<button type="submit" class="btn btn-info">Submit</button>
		</fieldset>
	</form>
	<div class="mb-5">
		<legend class="text-info">Polls History</legend>
		<div class="alert alert-light mb-5">
			<div>
				<div class="text-info mb-3 ml-3" style="font-size: 21px;">My Polls</div>
				<table class="table table-borderless w-100">
					<thead><tr style="display: none;"><td>My Polls</td></tr></thead>
					<?php echo $myPolls;?>
				</table>
				<div class="text-info mb-3 mt-5" style="font-size: 21px;">Polls by Others</div>
				<table class="table table-borderless w-100">
					<thead><tr style="display: none;"><td>Others' Polls</td></tr></thead>
					<?php echo $othersPolls;?>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
<script>$("table").DataTable({ordering:false,"info":false,"pageLength":10,"lengthChange":false});</script>
</html>