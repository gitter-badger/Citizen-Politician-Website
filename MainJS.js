$(document).ready(()=>{
	function showPassword(event){
		var type=$(event.data.input).attr("type")
		if(type.localeCompare("password")===0){
			$(event.data.input).attr("type","text")
			$(event.data.button).addClass("bg-info")
		}else{
			$(event.data.input).attr("type","password")
			$(event.data.button).removeClass("bg-info")
		}
	}
	function checkUser(user){
		return false
	}


	$("#show").click({button: "#show", input: "#passWord"},showPassword)
	$("#showSecret").click({button: "#showSecret", input: "#secret"},showPassword)
	$("#showSecretRe").click({button: "#showSecretRe", input: "#secretRe"},showPassword)

	$("div#signUp>form").submit(event=>{
		
	})
	$("div.signIn>form").submit(event=>{
		event.preventDefault()
	})

	$("#user").keyup(()=>{
		var user=$("#user").val().trim()
		if(user.length===0){
			$("span#1").removeClass("fa-times").removeClass("fa-check")
			return;
		}
		if(user.length<3||checkUser(user)===true||!isNaN(user.charAt(0))){
			$("span#1").removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return;
		}
		$("span#1").removeClass("fa-times").addClass("fa-check").css("color","limegreen")
	})

	$("#email").keyup(()=>{
		var email=$("#email").val()
		var posAt=email.indexOf("@")
		var posDot=email.lastIndexOf(".")
		if(email.length===0){
			$("span#2").removeClass("fa-times").removeClass("fa-check")
			return;
		}
		if(posAt<1||(posAt+2)>posDot||(posDot+2)>=email.length){
			$("span#2").removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return;
		}
		$("span#2").removeClass("fa-times").addClass("fa-check").css("color","limegreen")
	})

	$("#phone").keyup(()=>{
		var phone=$("#phone").val()
		if(phone.length===0){
			$("span#3").removeClass("fa-times").removeClass("fa-check")
			return;
		}
		if(phone.charAt(0)!=7||phone.length!=9){
			$("span#3").removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return;
		}
		$("span#3").removeClass("fa-times").addClass("fa-check").css("color","limegreen")
	})

	$("#secret").keyup(()=>{
		$("#secretRe").trigger("keyup")
		var secret=$("#secret").val()
		if(secret.length===0){
			$("span#4").removeClass("fa-times").removeClass("fa-check")
			return;
		}
		if(secret.length<8){
			$("span#4").removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return;
		}
		for(var i=0;i<secret.length;i++){
			if(isNaN(secret.charAt(i))){
				if(i===secret.length-1){
					$("span#4").removeClass("fa-check").addClass("fa-times").css("color","indianred")
					return
				}
			}else
				break;
		}
		for(var i=0;i<secret.length;i++){
			if(isNaN(secret.charAt(i))){
				break
			}else{
				if(i===secret.length-1){
					$("span#4").removeClass("fa-check").addClass("fa-times").css("color","indianred")
					return
				}
			}
		}
		$("span#4").removeClass("fa-times").addClass("fa-check").css("color","limegreen")
	})

	$("#secretRe").keyup(()=>{
		var secretRe=$("#secretRe").val()
		var secret=$("#secret").val()
		if(secretRe.length===0){
			$("span#5").removeClass("fa-times").removeClass("fa-check")
			return;
		}
		if(secretRe.localeCompare(secret)!==0){
			$("span#5").removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return
		}
		$("span#5").removeClass("fa-times").addClass("fa-check").css("color","limegreen")
	})

	$("#photo").change(()=>{
		var photo=$("#photo").val()
		if(photo.length===0){
			$("#labelPhoto").html("Profile Photo <span class='text-secondary'>(Optional): </span>")
			return;
		}
		var ext=photo.substr(photo.lastIndexOf(".")+1)
		if(ext.toLowerCase().localeCompare("png")!==0 && ext.toLowerCase().localeCompare("jpg")!==0 && ext.toLowerCase().localeCompare("jpeg")!==0){
			alert("Please select a png or jpeg file.")
			$("#photo").val("")
			$("#labelPhoto").html("Profile Photo <span class='text-secondary'>(Optional): </span>")
			return;
		}
		var value=(photo.indexOf("\\")>-1) ? photo.substr(photo.lastIndexOf("\\")+1) : photo.substr(photo.lastIndexOf("/")+1)
		$("#labelPhoto").html(value)
	})
})