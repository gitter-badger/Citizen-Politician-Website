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
	<div class="container-fluid" style="position: relative;top: 50px">
		<div class="text-info" style="font-size: 30px">Account Termination</div>
		<div class='row'>
		<?php foreach ($accounts as $value): ?>
			<div class='col-xs mb-3'>
				<div class='card mr-3' style='width:250px'>
					<img class='card-img-top' src="<?php echo $value->photo?>" alt='Card image'><div class='card-body'><h4 class='card-title'><?php echo $value->UserName?></h4><p class='card-text'><?php echo $value->gender?><br><?php echo $value->type?><br></p><button type='submit' class='btn btn-danger'>Deactivate Account</button></div>
				</div>
			</div>
		<?php endforeach ?>
		</div>
	</div>
</body>
</html>