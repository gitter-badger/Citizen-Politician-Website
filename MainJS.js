$(document).ready(()=>{
	$("#show").click(event=>{
		var type=$("#passWord").attr("type")
		if(type.localeCompare("password")===0){
			$("#passWord").attr("type","text")
			$(event.currentTarget).addClass("bg-info")
		}else{
			$("#passWord").attr("type","password")
			$(event.currentTarget).removeClass("bg-info")
		}
	})
})