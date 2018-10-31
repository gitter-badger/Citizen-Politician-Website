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
		a{
			cursor: pointer;
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
					<?php echo $polls;?>
				</div>
				<div class="tab-pane" id="leadership">
					
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script>
	$("table").DataTable({ordering:false,"info":false,"pageLength":25,"lengthChange":false});
	function like(id,analysis,action){
		$.post("<?php echo site_url('stories/like_function')?>",{analysis:analysis,id:id,action:action},data=>{
			if(data.localeCompare("Success")===0){
				if(action===-1){
					$('#shares_'+analysis+'_'+id).fadeOut(()=>{
						$('#shares_'+analysis+'_'+id).text(parseInt($('#shares_'+analysis+'_'+id).text())+1).slideDown()
					})
					$('#shares').text(parseInt($('#shares').text())+1)
				}else{
					$('#likes_'+analysis+'_'+id).fadeOut(()=>{
						$('#likes_'+analysis+'_'+id).text(parseInt($('#likes_'+analysis+'_'+id).text())+1).slideDown()
					})
					$('#likes').text(parseInt($('#likes').text())+1)
				}
			}
		})
	}
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
	function post_data(type,event){
		$(event.target).find('button').addClass('disabled').prop('disabled',true)
		$('#loading_'+type).fadeIn(700,()=>{
			var target=$(event.target).find("input[name='target']").val().trim()
			var comment=$(event.target).find("textarea[name='comment']").val().trim()
			var evidence=($(event.target).find("input[name='evidence']").val()===undefined) ? "":$(event.target).find("input[name='evidence']").val()
			if(evidence.length<1){
				$.post('<?php echo site_url("stories/post")?>',{table:type,target:target,comment:comment,evidence:evidence},data=>{
					if(data.indexOf("<table class='table table-borderless' style='width:100%'><thead>")!==-1){
						$('#'+type).html(data)
						$('#search_errors').removeClass('alert').removeClass('alert-warning').html("")
						$("#"+type+">table").DataTable({ordering:false,"info":false,"pageLength":25,"lengthChange":false});
						$('#posts').text(parseInt($('#posts').text())+1)
					}else{
						$('#search_errors').addClass('alert').addClass('alert-warning').html(data)
						$(event.target).find('button').removeClass('disabled').prop('disabled',false)
						$('#loading_'+type).fadeOut(700)
					}
				})
				return;
			}
			var file_data = $(event.target).find("input[name='evidence']").prop("files");
			var form = new FormData()
			for(var i=0;i<file_data.length;i++){
				form.append("evidence[]",file_data[i])
			}
			form.append("table",type)
			form.append("target",target)
			form.append("comment",comment)
			$.ajax({url: '<?php echo site_url("stories/post")?>',data: form,dataType: 'text',contentType: false,processData: false,type: 'POST',success: data=>{
				if(data.indexOf("<table class='table table-borderless' style='width:100%'><thead>")!==-1){
					$('#search_errors').removeClass('alert').removeClass('alert-warning').html("")
					$('#'+type).html(data)
					$("#"+type+">table").DataTable({ordering:false,"info":false,"pageLength":25,"lengthChange":false});
					$('#posts').text(parseInt($('#posts').text())+1)
				}else{
					$('#search_errors').addClass('alert').addClass('alert-warning').html(data)
					$(event.target).find('button').removeClass('disabled').prop('disabled',false)
					$('#loading_'+type).fadeOut(700)
				}
			},error:function(error){
				$('#search_errors').addClass('alert').addClass('alert-danger').html(error.responseText)
				$(event.target).find('button').removeClass('disabled').prop('disabled',false)
				$('#loading_'+type).fadeOut(700)
			}})
		})
	}
	function follow(event){
		var username=$(event).attr('id').split('_')
		if(username[0].localeCompare('unfollow')===0){
			unfollow(username[1],event);
			return;
		}
		$.post("<?php echo base_url('follow_user')?>",{politician:username[1]},data=>{
			if(data.localeCompare('Success')===0){
				$(event).removeClass('btn-success').addClass('btn-info').text('Unfollow').attr('id','unfollow_'+username[1])
				$('#followers_'+username[1]).text(parseInt($('#followers_'+username[1]).text())+1)
			}
		})
	}
	function unfollow(username,event){
		$.post("<?php echo base_url('unfollow_user')?>",{politician:username},data=>{
			if(data.localeCompare('Success')===0){
				$(event).addClass('btn-success').removeClass('btn-info').text('Follow').attr('id','follow_'+username)
				$('#followers_'+username).text(parseInt($('#followers_'+username).text())-1)
			}
		})
	}
</script>
</html>