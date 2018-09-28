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
	function makeid(integer) {
	  var text = "";
	  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	  for (var i = 0; i < integer; i++)
	    text += possible.charAt(Math.floor(Math.random() * possible.length));

	  return text;
	}
	
	$("#passForm").submit(event=>{
		event.preventDefault()
		$("#changePassword").trigger("click")
	})
	$("#changePassword").click(()=>{
		var email=$("#getEmail").val()
		if(email.length<3){
			return;
		}
		var passcode=makeid(Math.floor(Math.random()*20)+10)
		$("#getEmail").val("")
		$("#log").addClass("alert").addClass("alert-info").html("Sending email...")
		$.post("emailSend.php",{type:"password",user:email,passCode:passcode},data=>{
			$("#log").addClass("alert").addClass("alert-info").html(data)
		})

	})



	$("#show").click({button: "#show", input: "#passWord"},showPassword)
	$("#showSecret").click({button: "#showSecret", input: "#secret"},showPassword)
	$("#showSecretRe").click({button: "#showSecretRe", input: "#secretRe"},showPassword)

	$("div#signUp>form").submit(event=>{
		var user=$("#user").val().trim()
		var email=$("#email").val()
		var phone=$("#phone").val()
		var pass=$("#secret").val()
		var passRe=$("#secretRe").val()
		var image=$("#photo").val()
		var county=$("#counties").find(":selected").attr("id")
		var acc=$("input[name=type]:checked").val()
		$("#userError,#emailError,#phoneError,#secretError,#secretReError").removeClass("alert").removeClass("alert-danger").html("")
		

		if(user.length<3){
			$("div#userError").addClass("alert").addClass("alert-danger").html("<strong>Error: </strong>Username must be atleast 3 characters.")
			return false;
		}
		if(!isNaN(user.charAt(0))){
			$("div#userError").addClass("alert").addClass("alert-danger").html("<strong>Error: </strong>Username cannot start with a number.")
			return false;
		}
		$("div#userError").removeClass("alert").removeClass("alert-danger").html("")

		if(pass.length<8){
			$("div#secretError").addClass("alert").addClass("alert-danger").html("<strong>Error: </strong>Passwords should be 8 characters long.")
			return false;
		}
		for(var i=0;i<pass.length;i++){
			if(isNaN(pass.charAt(i))){
				if(i===pass.length-1){
					$("div#secretError").addClass("alert").addClass("alert-danger").html("<strong>Error: </strong>Passwords should be have atleast 1 number.")
					return false;
				}
			}else
				break;
		}
		for(var i=0;i<pass.length;i++){
			if(isNaN(pass.charAt(i))){
				break
			}else{
				if(i===pass.length-1){
					$("div#secretError").addClass("alert").addClass("alert-danger").html("<strong>Error: </strong>Passwords should have atleast 1 letter.")
					return false;
				}
			}
		}
		$("div#secretError").removeClass("alert").removeClass("alert-danger").html("")

		if(passRe.localeCompare(pass)!==0){
			$("div#secretReError").addClass("alert").addClass("alert-danger").html("<strong>Error: </strong>Passwords should match.")
			return false;
		}
		$("div#secretReError").removeClass("alert").removeClass("alert-danger").html("")

		if(email.trim().indexOf("@")<1||(email.trim().indexOf("@")+2)>email.trim().lastIndexOf(".")||(email.trim().lastIndexOf(".")+2)>=email.trim().length){
			$("div#emailError").addClass("alert").addClass("alert-danger").html("<strong>Error: </strong>Email is not a valid email.")
			return false;
		}
		$("div#emailError").removeClass("alert").removeClass("alert-danger").html("")

		if(phone.trim().charAt(0)!=7){
			$("div#phoneError").addClass("alert").addClass("alert-danger").html("<strong>Error: </strong>Number must start with 7.")
			return false;
		}
		if(phone.trim().length!=9){
			$("div#phoneError").addClass("alert").addClass("alert-danger").html("<strong>Error: </strong>Number must be exactly 9 characters long.")
			return false;
		}
		if(isNaN(phone)){
			$("div#phoneError").addClass("alert").addClass("alert-danger").html("<strong>Error: </strong>Number must be a number.")
			return false;
		}
		$("div#phoneError").removeClass("alert").removeClass("alert-danger").html("")
	})


	$("#user").keyup(()=>{
		var user=$("#user").val().trim()
		if(user.length===0){
			$("span#1").removeClass("fa-times").removeClass("fa-check")
			return;
		}
		if(user.length<3||!isNaN(user.charAt(0))){
			$("span#1").removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return;
		}
		$.post("checkUser.php",{user:user},data=>{
			if(data.localeCompare("true")===0){
				$("span#1").removeClass("fa-check").addClass("fa-times").css("color","indianred")
			}else if(data.localeCompare("false")===0){
				$("span#1").removeClass("fa-times").addClass("fa-check").css("color","limegreen")
			}else{
				alert(data)
			}
		})
		$("span#1").removeClass("fa-times").addClass("fa-check").css("color","limegreen")
	})

	$("#email").keyup(()=>{
		var email=$("#email").val().trim()
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
		var phone=$("#phone").val().trim()
		if(phone.length===0){
			$("span#3").removeClass("fa-times").removeClass("fa-check")
			return;
		}
		if(phone.charAt(0)!=7||phone.length!=9||isNaN(phone)){
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