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
		.nav .nav-item .active{
			background-color: whitesmoke;
			color: gray;
			border-color: whitesmoke;
			border-bottom-color: darkgray;
		}
	</style>
</head>
<body>
	<?php echo $navbar;?>
	<script>$("a[href='<?php echo site_url('settings')?>']").addClass("active");</script>
	<div class="container-fluid" style="position: relative;top: 60px;">
		<div class="row mb-3">
			<div class="col-md-4 mb-3">
				<form id="search">
					<div class="input-group mb-3 mt-3">
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
				<div class="text-center">
					<a class="text-muted" style="text-decoration: none;" href="<?php echo site_url('profile/'.$this->session->userdata('username'));?>">
		            <img src="<?php echo $this->session->userdata('photo');?>" class="rounded-circle img-thumbnail mb-2 w-50"><br>
		            <span style="text-transform: capitalize;font-size: 24px;font-weight: bolder;">@ <?php echo $this->session->userdata('username');?></span></a>
              		<form>
	                    <input type="file" accept="image/*" name="photo" hidden="">
                  		<button class="mb-2 mt-3 btn btn-outline-info" onclick="event.preventDefault();$('input[name=photo]').trigger('click')">Upload a different photo...</button>
                	</form>
		        </div><hr><hr>
		        <div id='activity'><?php echo $activity;?></div>
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
				<div class='text-info lead' style="font-size: 34px"><strong>Settings: <small class="text-muted"><?php echo '@'.$this->session->userdata('username')?></small></strong></div>
				<?php echo $this->session->flashdata('log')?>
				<ul class="nav nav-tabs nav-justified">
		            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Basic">Profile Settings</a></li>
		            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Political">Political Settings</a></li>
		            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Educational">Educational Settings</a></li>
		        </ul>
		        <div class="tab-content mb-5">
              		<div class="tab-pane container active" id="Basic">
                		<hr><hr>
                		<form action="##" method="post">
                  			<legend class="text-info">Basic Settings</legend>
                  			<div class="row mb-3">
                    			<div class="col-md-6">
                      				<div class="form-group">
                        				<div class="input-group mb-3">
                          					<div class="input-group-prepend">
                            					<span class="input-group-text">@</span>
                          					</div>
                          					<input type="text" class="form-control" name="user" value="<?php echo $this->session->userdata('username')?>" readonly="">
                        				</div>
                      				</div>
                      				<div class="alert alert-danger">Username cannot be changed since changing it can have undesired side consequences.</div>
                      				<div class="form-group mb-2">
                      					<label>Gender: </label>
                        				<div class="custom-control custom-radio mb-1">
                            				<input type="radio" class="custom-control-input" id="male" name="gender" value="male" required="">
                            				<label class="custom-control-label" for="male">Male</label>
                        				</div>
                        				<div class="custom-control custom-radio mb-1">
                          					<input type="radio" class="custom-control-input" id="female" name="gender" value="female" required="">
                            				<label class="custom-control-label" for="female">Female</label>
                        				</div>
                      				</div>
                    			</div>
                    			<div class="col-md-6">
                    				<div class="form-group">
                        				<div class="input-group mb-3">
                          					<input type="email" class="form-control" name="email" id="email" placeholder="Email" required="">
                            				<div class="input-group-append">
                                				<span class="input-group-text fa" id="2"></span>
                            				</div>
                        				</div>
                      				</div>
                    				<div class="form-group">
                        				<div class="input-group mb-3">
                          					<div class="input-group-prepend">
				                                <span class="input-group-text">+254</span>
				                          	</div>
                          					<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required="">
				                            <div class="input-group-append">
				                                <span class="input-group-text fa" id="3"></span>
				                            </div>
                        				</div>
                      				</div>
                      				<div class="form-group mb-2">
                        				<label for="counties"> County:</label>
                        				<select class="custom-select mb-3" name="counties" id="counties" style="cursor: pointer;" required="">
                        				</select>
                      				</div>
                    			</div>
                  			</div>
                  			<div class="row"><div class="col">
                    			<div class="form-group mb-3 d-flex justify-content-center">
                      				<button style="margin-right: 20px;" type="submit" class="btn btn-info"><i class="fas fa-arrow-alt-circle-down"></i> Save</button> <button type="button" class="btn btn-secondary"><i class="fas fa-redo-alt"></i> Redo</button>
                    			</div>
                  			</div></div>
                		</form><hr><hr>
                		<div class="row">
                  			<div class="col-12 container">
                    			<div class="text-info" style="font-size: 24px">Account Settings</div><br>
                      			<form>
                        			<legend class="text-info" style="font-size: 18px">Change Password</legend><hr>
                      				<div class="input-group mb-3">
                        				<div class="input-group-prepend">
                            				<span class="input-group-text" id="showOldSecret" style="cursor: pointer;"><img src="<?php echo base_url('resources/show_password_icon.png')?>" style="width: 23px;height: 23px;"></span>
                        				</div>
                        				<input type="password" class="form-control" name="oldSecret" id="oldSecret" placeholder="Old Password" required="">
                        				<div class="input-group-append">
                          					<span class="input-group-text fa" id="4"></span>
                        				</div>
                      				</div>
                          			<div class="input-group mb-3">
                            			<div class="input-group-prepend">
                                  			<span class="input-group-text" id="showSecret" style="cursor: pointer;"><img src="<?php echo base_url('resources/show_password_icon.png')?>" style="width: 23px;height: 23px;"></span>
                              			</div>
                            			<input type="password" class="form-control" name="secret" id="secret" placeholder="New Password" required="">
                              			<div class="input-group-append">
                                  			<span class="input-group-text fa" id="5"></span>
                              			</div>
                          			</div>
                          			<div class="input-group mb-3">
                            			<div class="input-group-prepend">
                                  			<span class="input-group-text" id="showSecretRe" style="cursor: pointer;"><img src="<?php echo base_url('resources/show_password_icon.png')?>" style="width: 23px;height: 23px;"></span>
                              			</div>
                            			<input type="password" class="form-control" name="secretRe" id="secretRe" placeholder="Repeat Password" required="">
                              			<div class="input-group-append">
                                  			<span class="input-group-text fa" id="6"></span>
                              			</div>
                          			</div>
			                        <div class="form-group mb-3">
			                          	<button type="submit" class="btn btn-info">Change Password</button>
			                        </div>
                      			</form><hr><hr>
                      		</div>
                      	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>