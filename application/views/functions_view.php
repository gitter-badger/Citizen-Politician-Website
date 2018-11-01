<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $head;?>
</head>
<body data-spy="scroll" data-target="#scrollspy" data-offset="60" style="height: 200%">
	<?php echo $navbar;?>
	<script>$("a[href='<?php echo site_url('functions')?>']").addClass("active");</script>
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
	<div class="container-fluid" style="position: relative;top:60px">
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
				<nav class="navbar bg-secondary navbar-dark rounded mb-3" id="scrollspy">
					<ul class="navbar-nav">
					    <li class="nav-item">
					    	<a class="nav-link" href="#governor">Governor Roles</a>
					    </li>
					    <li class="nav-item">
					    	<a class="nav-link" href="#senator">Senetor Roles</a>
					    </li>
					    <li class="nav-item">
					    	<a class="nav-link" href="#Wrep">Women Representative Roles</a>
					    </li>
					    <li class="nav-item">
					    	<a class="nav-link" href="#mp">MP Roles</a>
					    </li>
					    <li class="nav-item">
					    	<a class="nav-link" href="#mca">Member of County Assembly Roles</a>
					    </li>
					</ul>
				</nav>
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
				<div id="governor" class="mb-5">
					<table class="table table-borderless" style='width:100%'>
						<thead>
							<tr>
								<td class='text-info lead' style="font-size: 26px"><strong>Governor Roles</strong></td>
							</tr>
						</thead>
						<tr>
							<td>
								<div class="p-4 bg-light rounded">
									<div style="font-weight: bold;">Who is a Governor?</div>
									The county executive is headed by the governor and his deputy. The governor position is one of the positions that citizens delegate power to during the general election. In Kenya, we have 47 governors, one for each county. A governor is elected alongside his or her running mate. He is ultimately the president in the county. Here are the key roles of a County Governor.
								</div>
							</td>
						</tr>
						<?php foreach($governor_roles as $role){?>
							<tr>
								<td>
									<div class="border p-3 rounded">
										<div style="font-weight: bold;"><?php echo $role->Roles;?></div>
										<div class="p-3"><?php echo $role->Explanation;?></div>
									</div>
								</td>
							</tr>
						<?php }?>
					</table>
				</div>
				<div id="senator" class="mb-5">
					<table class="table table-borderless" style='width:100%'>
						<thead>
							<tr>
								<td class='text-info lead' style="font-size: 26px"><strong>Senator Roles</strong></td>
							</tr>
						</thead>
						<tr>
							<td>
								<div class="p-4 bg-light rounded">
									<div style="font-weight: bold;">Who is a Senator?</div>
									Senate is the oversite arm of the national government where persons elected oversee and approve various stuff. What are the main functions of the Senator according to the law?
								</div>
							</td>
						</tr>
						<?php foreach($senator_roles as $role){?>
							<tr>
								<td>
									<div class="border p-3 rounded">
										<div style="font-weight: bold;"><?php echo $role->Roles;?></div>
										<div class="p-3"><?php echo $role->Explanation;?></div>
									</div>
								</td>
							</tr>
						<?php }?>
					</table>
				</div>
				<div id="Wrep" class="mb-5">
					<table class="table table-borderless" style='width:100%'>
						<thead>
							<tr>
								<td class='text-info lead' style="font-size: 26px"><strong>Women Representative Roles</strong></td>
							</tr>
						</thead>
						<tr>
							<td>
								<div class="p-4 bg-light rounded">
									<div style="font-weight: bold;">Who is a Woman Representative?</div>
									The position of women representatives is provided for in Article 97 of the Constitution of Kenya. In describing the composition of the, National Assembly, the constitution stipulates that the house consists of 47 women representatives, one from each county. The Women Representative position is an affirmative seat that is meant to increase representation of women in parliament in an attempt to bridge the wide representation gap that existed before the new constitution took effect in 2010.Therefore, the role of women representatives is the same as that of any other member of the national assembly though it goes beyond, in that it is specific to women and girls as exhibited below.
								</div>
							</td>
						</tr>
						<?php foreach($wrep_roles as $role){?>
							<tr>
								<td>
									<div class="border p-3 rounded">
										<div style="font-weight: bold;"><?php echo $role->Roles;?></div>
										<div class="p-3"><?php echo $role->Explanation;?></div>
									</div>
								</td>
							</tr>
						<?php }?>
					</table>
				</div>
				<div id="mp" class="mb-5">
					<table class="table table-borderless" style='width:100%'>
						<thead>
							<tr>
								<td class='text-info lead' style="font-size: 26px"><strong>Member of Parliament Roles</strong></td>
							</tr>
						</thead>
						<tr>
							<td>
								<div class="p-4 bg-light rounded">
									<div style="font-weight: bold;">Who is an Mp?</div>
									National assembly is the legislative arm of the national government where persons elected to represent the people at  sub-county level sit. During campaigns, aspirants seeking to be elected as Members of National Assembly make all kinds of promises to citizens. While some of those promises might be in line with their constitutional mandate, often times they are not. What are the main functions of the National Assembly according to the law?
								</div>
							</td>
						</tr>
						<?php foreach($mp_roles as $role){?>
							<tr>
								<td>
									<div class="border p-3 rounded">
										<div style="font-weight: bold;"><?php echo $role->Roles;?></div>
										<div class="p-3"><?php echo $role->Explanation;?></div>
									</div>
								</td>
							</tr>
						<?php }?>
					</table>
				</div>
				<div id="mca" class="mb-5">
					<table class="table table-borderless" style='width:100%'>
						<thead>
							<tr>
								<td class='text-info lead' style="font-size: 26px"><strong>Member of County Assembly Roles</strong></td>
							</tr>
						</thead>
						<tr>
							<td>
								<div class="p-4 bg-light rounded">
									<div style="font-weight: bold;">Who is an MCA?</div>
									This is significantly the most unknown person in a county. Most people do not know the mca of their areas. An MCA should represent the people from his or her ward in the county government just like an MP represents the people of his or her constituency in the national assembly. He represents the interests of his ward at the county assembly. Here are some of his/her other roles. 
								</div>
							</td>
						</tr>
						<?php foreach($mca_roles as $role){?>
							<tr>
								<td>
									<div class="border p-3 rounded">
										<div style="font-weight: bold;"><?php echo $role->Roles;?></div>
										<div class="p-3"><?php echo $role->Explanation;?></div>
									</div>
								</td>
							</tr>
						<?php }?>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script>
		$("table").DataTable({ordering:false,"info":false,"pageLength":10,"lengthChange":false});
		$("#scrollspy li a").on('click', function(event) {
    		if (this.hash !== "") {
      			event.preventDefault();
      			var hash = this.hash;
      			$('html, body').animate({
        			scrollTop: $(hash).offset().top
      			}, function(){
        			window.location.hash = hash;
      			});
    		}
  		});
	</script>
</body>
</html>