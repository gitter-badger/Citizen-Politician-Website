<?php
require "Connection.php";
?>
<style>
	@media screen and (max-width: 992px){
		div.collapse{
			max-height: 400px;
			overflow-y: auto;
		}
	}
</style>

<nav class="navbar bg-info navbar-light navbar-expand-lg fixed-top" style="padding-top: 2px;padding-bottom: 2px;">
	<a class="navbar-brand text-dark" href="" style="font-family: Cookie,cursive;font-size: 20px;"><i class="fas fa-user"></i> Mwananchi</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#smallScreen" style="outline: none;">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="smallScreen">
		<ul class="navbar-nav">
	      <li class="nav-item here home">
	        <a class="nav-link text-light" href="">Home</a>
	      </li>
	      <li class="nav-item navigationBar">
	        <a class="nav-link text-light" href="BugReport.php">Bug Report</a>
	      </li>
	      <li class="nav-item navigationBar">
	        <a class="nav-link text-light" href="ContactsPage.php">Contacts</a>
	      </li> 
	      <li class="nav-item navigationBar">
	        <a class="nav-link text-light" href="HelpPage.php">Help</a>
	      </li> 
	    </ul>
	    <?php
	    	$home="HomePage.php";
	    	if(isset($_SESSION['username'])){
	    		echo "<script>$('.navigationBar').hide()</script>";
	    		$home="Stories.php";
	    		$userName=$_SESSION['username'];
				$notifications=$connection->query("select subject,notification,type from notifications where target='$userName' and isRead=0 order by notificationID desc");
				$messages=(mysqli_num_rows($notifications)>0) ? mysqli_num_rows($notifications):"";
	    		$photo=$_SESSION["photo"];
	    		if(mysqli_num_rows($notifications)>0){
	    			$content=array();
		    		for($i=0;($row=$notifications->fetch_array(MYSQLI_NUM)) && $i<2;$i++){
		    			$data=(strlen($row[1])>105) ? substr($row[1],0,105)."...":$row[1];
				    	$content[$i]="<div class=\"alert alert-secondary\" style=\"font-family: Comic Sans MS, cursive, sans-serif;\"><strong>$row[0]</strong><br><i style=\"font-family: Cookie,cursive;font-size: 18px;\">$row[2]</i><br>$data</div><hr>";
				    }
				}else{
					$content= 'No New Notifications to display.';
				}
		    	if($_SESSION['usertype']==="admin"){
		    		echo "<ul class='navbar-nav'><li class='nav-item navigationBar'><a class='nav-link text-light' href='Functions.php'>Set Functions</a></li><li class='nav-item navigationBar'><a class='nav-link text-light' href='SiteSettings.php'>Site Settings</a></li><li class='nav-item navigationBar'><a class='nav-link text-light' href='OpinionPolls.php'>Start Poll</a></li></ul><ul class='navbar-nav ml-auto'><li class='nav-item navigationBar'><a class='nav-link text-light' href='Settings.php'><span class='fas fa-cog'></span> Settings</a></li><li class='nav-item' style='width: 50px;text-align: center;white-space: nowrap;' data-toggle='popover' title='Recent Notifications' data-trigger='hover' data-placement='bottom' data-content='".implode($content)."'><a class='nav-link text-light' href='Notifications.php'><span class='fas fa-bell'></span> <sup class='badge badge-dark' style='text-align: center;white-space: nowrap;'>$messages</sup></a></li><li class='nav-item dropdown navigationBar'><a class='nav-link dropdown-toggle text-light' data-toggle='dropdown' href=''><span class='rounded'><img class='rounded' src='$photo' width='25px' height='25px' style='width: 25px;height:25px;'></span> My Profile </a>
		    			<div class='dropdown-menu bg-info' style='padding: 3px;border-radius: 5px;padding-top: 13px'>
		    					<a class='dropdown-item text-dark' href='MyProfile.php'>@ $userName</a><hr>
				    			<a class='dropdown-item text-dark' href='SendEmails.php'>Send Emails</a>
				    			<a class='dropdown-item text-dark' href='RegisterAdmin.php'>Add Admin</a>
				    			<a class='dropdown-item text-dark' href='AdminDelete.php'>Drop Accounts</a>
				    			<a class='dropdown-item text-dark' href='Logout.php'>Logout</a>
				    	</div></li></ul>";
		    	}
		    }
	    ?>
	</div>
</nav>
<script>
	$('[data-toggle="popover"]').hover(event=>{
		if($(window).width()<992){
			$('[data-toggle="popover"]').popover("disable")
		}else{
			$('[data-toggle="popover"]').popover("enable")
		}
	})
	$('[data-toggle="popover"]').popover({html:true,delay: {"hide": 400 },template:'<div class="popover" style="max-height:420px;overflow-y:hidden;" role="popover"><div class="popover-inner"><div class="popover-header bg-info" style="font-family: courier new;font-weight: bolder"></div><div class="popover-body bg-secondary"></div></div>'});
	$(".home>a,.navbar-brand").attr("href","<?php echo $home;?>")
	var pathname=location.pathname.substr(location.pathname.lastIndexOf("/")+1)
	if(pathname.localeCompare("SendEmails.php")===0){
		$("a[href='SendEmails.php']").hide()
		$(".here").removeClass("here").addClass("navigationBar")
	}else if(pathname.localeCompare("RegisterAdmin.php")===0){
		$("a[href='RegisterAdmin.php']").hide()
		$(".here").removeClass("here").addClass("navigationBar")
	}else if(pathname.localeCompare("AdminDelete.php")===0){
		$("a[href='AdminDelete.php']").hide()
		$(".here").removeClass("here").addClass("navigationBar")
	}else if(pathname.localeCompare("Logout.php")===0){
		$("a[href='Logout.php']").hide()
		$(".here").removeClass("here").addClass("navigationBar")
	}else if(pathname.localeCompare("MyProfile.php")===0){
		$(".here").removeClass("here").addClass("navigationBar")
	}else if(pathname.localeCompare("SiteSettings.php")===0){
		$(".here").removeClass("here").addClass("navigationBar")
		$("a[href='SiteSettings.php']").parent().removeClass("navigationBar").addClass("here")
	}else if(pathname.localeCompare("Settings.php")===0){
		$(".here").removeClass("here").addClass("navigationBar")
		$("a[href='Settings.php']").parent().removeClass("navigationBar").addClass("here")
	}else if(pathname.localeCompare("OpinionPolls.php")===0){
		$(".here").removeClass("here").addClass("navigationBar")
		$("a[href='OpinionPolls.php']").parent().removeClass("navigationBar").addClass("here")
	}
</script>