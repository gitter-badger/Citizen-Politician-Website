<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head;?>
	<style>
		a{
			cursor: pointer;
		}
	</style>
</head>
<body>
	<?php echo $navbar;?>
	<div class="rounded bg-info p-1 text-light text-center" style="position: fixed;bottom: 20px;z-index: 100;right: 20px;width: 60px;font-family: Cookie,cursive;font-size: 20px;cursor: pointer;" onclick="$('body,html').animate({scrollTop:0})">Top</div>
	<script>
		function scroll(){
			if($('body,html').scrollTop()>320){
				$("div.text-center").fadeIn()
			}else{
				$("div.text-center").fadeOut()
			}
		}
		$("div.text-center").hide()
		setInterval(scroll,0)
	</script>
	<div class="container-fluid" style="position: relative;top: 60px;">
		<div class="row">
			<div class="col-md-3">
				<form id="search">
					<div class="input-group mb-4">
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
				<?php echo $potw.$election_date;?>
				<script>
					function answerPoll(event){
						var answer=(event.target.nodeName.toLowerCase().localeCompare('input')===0) ? $(event.currentTarget).val():$(event.currentTarget).children().text();
						answer=(event.target.nodeName.localeCompare('BUTTON')===0) ? $(event.currentTarget).parent().find('textarea').val():answer
						if(answer===undefined) return
						if(answer.length<1) return
						id=$(event.currentTarget).parent().parent().attr('id').substring($(event.currentTarget).parent().parent().attr('id').lastIndexOf('_')+1)
						var parent=$(event.currentTarget).parent().parent()
						parent.fadeOut(()=>{
							$.post("<?php echo site_url('submit_poll_answer')?>",{pollID:id,answer:answer},data=>{
								if(data.localeCompare('Failure')===0){
									$("#search_errors").addClass('alert').addClass('alert-danger').html("Poll not answered. Please try again!");
									$("#otherpolls").find('.close').trigger('click')
								}else{
									data=(data==="") ? "<div class='text-muted'>This poll has been answered</div>":data;
									parent.html(data)
									parent.fadeIn()
								}
							})
						})
					}
				</script>
			</div>
			<div class="col-md-8">
				<table class="table table-borderless" style='width:100%'>
					<thead>
						<tr>
							<td class='text-info lead' style="font-size: 26px"><strong>My Notifications</strong></td>
						</tr>
					</thead>
					<?php foreach ($notifications as $row) {?>
						<tr><td><div class="border rounded p-3" style="font-family: Comic Sans MS, cursive, sans-serif;"><strong><?php echo $row->subject?></strong><br><i style="font-family: Cookie,cursive;font-size: 18px;"><?php echo $row->type?></i><br><?php echo $row->notification?></div></td></tr>
					<?php }?>
				</table>
			</div>
		</div>
	</div>
	<?php
		$this->db->query("update notifications set isRead=1 where target=?",$this->session->userdata('username'));
	?>
	<script>$("table").DataTable({ordering:false,"info":false,"pageLength":10,"lengthChange":false});</script>
</body>
</html>