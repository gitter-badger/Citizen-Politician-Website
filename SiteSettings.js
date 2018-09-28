$(document).ready(()=>{
	$('#change').click(()=>{
		var date=$("#date").val().trim()
		if(date.length!==0){
			$.post('ElectionDate.php',{date:date}, data=> {
				Cookies.set("date",data)
				location.reload(true)
	   		});
		}
	})

	$("#changEmail").click(event=>{
		var email=$("#email").val().trim();
		var pass=$("#emailPass").val().trim();
		var test=$("#test").val().trim()
		var smtp=$("#smtp").val().trim()
		if(email.length!==0&&pass.length!==0&&test.length!==0){
			if(checkEmail(email)){
				if(checkEmail(test)){
					$("#email").val("")
					$("#emailPass").val("")
					$("#test").val("")
					$(".alerts").removeClass("alert").removeClass("alert-danger").html("")
					$("#emailTrack,#testTrack").removeClass("fa-check").removeClass("fa-times")
					$("#btnEmail").attr("disabled","").text("Changing..")
					$.post("changeEmail.php",{smtp:smtp,email:email,pass:pass,test:test},data=>{
						$(".alerts").addClass("alert").addClass("alert-info").html(data)
						$("#btnEmail").removeAttr("disabled").text("Change")
					})
				}else{
					$(".alerts").addClass("alert").addClass("alert-danger").html("Test email is not of correct syntax.")
				}
			}else{
				$(".alerts").addClass("alert").addClass("alert-danger").html("The email is not of correct syntax.")
			}
		}

	})

	function checkEmail(email){
		var posAt=email.indexOf("@")
		var posDot=email.lastIndexOf(".")
		if(posAt<1||(posAt+2)>posDot||(posDot+2)>=email.length){
			return false;
		}
		return true
	}
	
	$("#email,#test").keyup(event=>{
		var email=$(event.currentTarget).val().trim()
		if(email.length===0){
			$(event.currentTarget).parent().find("span").removeClass("fa-check").removeClass("fa-times")
			return;
		}
		if(checkEmail(email)){
			$(event.currentTarget).parent().find("span").addClass("fa-check").removeClass("fa-times").css({color:'limegreen'})
		}else{
			$(event.currentTarget).parent().find("span").addClass("fa-times").removeClass("fa-check").css({color:'indianred'})
		}
	})

	$("#setGovernor").click(()=>{
		var county=$("#counties").find(":selected").attr("id")
		var gov=$("#govName").val().trim()
		if(gov.length!==0){
			$.post("updateLeaders.php",{table:"counties",id:county,governor:gov},data=>{
				Cookies.set("update",data);
				location.reload(true)
			})
		}
	})	

	$("#setMP").click(()=>{
		var consti=$("#constituencies").find(":selected").attr("id")
		var mp=$("#MPName").val().trim()
		if(mp.length!==0){
			$.post("updateLeaders.php",{table:"constituencies",id:consti,governor:mp},data=>{
				Cookies.set("update",data);
				location.reload(true)
			})
		}
	})

	$("#setMCA").click(()=>{
		var ward=$("#wards").find(":selected").attr("id")
		var mca=$("#MCAName").val().trim()
		if(mca.length!==0){
			$.post("updateLeaders.php",{table:"wards",id:ward,governor:mca},data=>{
				Cookies.set("update",data);
				location.reload(true)
			})
		}
	})	

	$("#addCounty").click(()=>{
		var id=$("#constiID").val()
		var county=$("#county").val().trim()
		var gov=$("#countyLeader").val().trim()
		if(county.length!==0&&gov.length!==0){
			$.post("registerRegions.php",{region:"counties",id:id,name:county,leader:gov},data=>{
				Cookies.set("update",data)
				location.reload(true)
			})
		}
	})

	$("#addConst").click(()=>{
		var id=$("#constiID").val()
		var consti=$("#consti").val().trim()
		var county=$("#counti").find(":selected").attr("id")
		var gov=$("#constiLeader").val().trim()
		if(consti.length!==0&&gov.length!==0){
			$.post("registerRegions.php",{region:"constituencies",id:id,name:consti,leader:gov,county:county},data=>{
				Cookies.set("update",data)
				location.reload(true)
			})
		}
	})

	$("#addWard").click(()=>{
		var id=$("#wardID").val()
		var consti=$("#ward").val().trim()
		var county=$("#consty").find(":selected").attr("id")
		var gov=$("#wardLeader").val().trim()
		if(consti.length!==0&&gov.length!==0){
			$.post("registerRegions.php",{region:"wards",id:id,name:consti,leader:gov,county:county},data=>{
				Cookies.set("update",data)
				location.reload(true)
			})
		}
	})

	$(".toc>a").click(event=>{
		event.preventDefault()
		var destination="#"+$(event.currentTarget).text()+"Table";
		$("body,html").animate({scrollTop:$(destination).offset().top},'slow')
	})

	$(window).scroll(()=>{
		if($(window).scrollTop()<screen.height){
			$("div.navigatorUp").css({display:"none"})
			$("div.navigatorDown").css({display:"block"})
		}else if($(window).scrollTop()>=($(document).height()-2.5*screen.height)){
			$("div.navigatorUp").css({display:"block"})
			$("div.navigatorDown").css({display:"none"})
		}else{
			$("div.navigatorUp").css({display:"block"})
			$("div.navigatorDown").css({display:"block"})
		}
	})
	$("div.navigatorUp>a").click(event=>{
		event.preventDefault()
		$("body,html").animate({scrollTop:0},'slow')
	})
	$("div.navigatorDown>a").click(event=>{
		event.preventDefault()
		$("body,html").animate({scrollTop:$(document).height()},'slow')
	})
})