<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head;?>
	<style>a{cursor: pointer;}</style>
</head>
<body>
	<?php echo $navbar;?>
	<script>$("a[href='<?php echo site_url('manifesto')?>']").addClass("active");</script>
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
	<div class="container-fluid" style="position: relative;top: 60px">
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
				<?php echo $this->session->flashdata('log');if($this->session->userdata('usertype')==='politician'){?>
					<div class='text-info lead mb-3' style='font-size: 26px'><strong>My Manifesto</strong></div>
					<?php if(isset($my_manifesto)){?>
						<div class="mb-3 d-flex">
							<a href="<?php echo $my_manifesto->manifesto?>" class="btn btn-outline-success mr-3">View My Manifesto</a>
							<form method="post" enctype="multipart/form-data" action="<?php echo site_url('manifesto/edit')?>">
								<input type="file" name="image" hidden='' onchange="$(this).parent().submit()">
								<button onclick="event.preventDefault();$('input[name=image]').trigger('click')" class="btn btn-outline-success">Post New Manifesto</button>
							</form>
						</div>
					<?php }else{?>
						<div class="mb-3">
							<form method="post" enctype="multipart/form-data" action="<?php echo site_url('manifesto/add')?>">
								<input type="file" name="image" hidden='' onchange="$(this).parent().submit()">
								<button onclick="event.preventDefault();$('input[name=image]').trigger('click')" class="btn btn-outline-success">Post New Manifesto</button>
							</form>
						</div>
					<?php }?>
				<?php }?>
				<table class="table table-borderless" style='width:100%'>
					<thead>
						<tr>
							<td class='text-info lead' style="font-size: 26px"><strong>Politician Manifestos</strong></td>
						</tr>
					</thead>
					<?php foreach($manifestos as $manifesto){?>
						<tr>
							<td>
								<div class="media border rounded p-3 mb-3">
									<img src="<?php echo $manifesto->photo?>" alt="<?php echo $manifesto->owner?>" class='align-self-start mr-3 rounded-circle' style='width:60px;'>
									<div class='media-body'>
										<h4><?php echo $manifesto->owner?> <small style='font-size:14px;'><i>Posted on <?php echo date_format(date_create($manifesto->time),'F d,Y h:i a');?> </i></small></h4>
										<div>
											<a href="<?php echo $manifesto->manifesto?>" class="btn btn-outline-success">View <?php echo $manifesto->owner?>'s Manifesto</a>
										</div>
								</div>
							</td>
						</tr>
					<?php }?>
				</table>
			</div>
		</div>
	</div>
	<script>$("table").DataTable({ordering:false,"info":false,"pageLength":10,"lengthChange":false});</script>
</body>
</html>