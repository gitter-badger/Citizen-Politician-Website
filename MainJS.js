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

	$("div#signUp>form").submit(()=>{

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
})