	function showPassword(button,input){
		var type=$(input).attr("type")
		if(type.localeCompare("password")===0){
			$(input).attr("type","text")
			$(button).addClass("bg-info")
		}else{
			$(input).attr("type","password")
			$(button).removeClass("bg-info")
		}
		$(input).focus()
	}

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

	function checkUser(input,span){
		var user=$(input).val().trim()
		if(user.length===0){
			$(span).removeClass("fa-times").removeClass("fa-check")
			return false;
		}
		if(user.length<3||!isNaN(user.charAt(0))||user.toLowerCase().localeCompare('mwananchi')===0||(/[^a-z 0-9-_.]/i).test(user)){
			$(span).removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return false;
		}
		$(span).removeClass("fa-times").addClass("fa-check").css("color","limegreen")
		return true;
	}

	function checkEmail(input,span){
		var email=$(input).val().trim()
		var posAt=email.indexOf("@")
		var posDot=email.lastIndexOf(".")
		if(email.length===0){
			$(span).removeClass("fa-times").removeClass("fa-check")
			return false;
		}
		if(posAt<1||(posAt+2)>posDot||(posDot+2)>=email.length){
			$(span).removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return false;
		}
		$(span).removeClass("fa-times").addClass("fa-check").css("color","limegreen")
		return true;
	}

	function checkPhone(input,span){
		var phone=$(input).val().trim()
		if(phone.length===0){
			$(span).removeClass("fa-times").removeClass("fa-check")
			return false;
		}
		if(isNaN(phone)){
			$(span).removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return false;
		}
		$(span).removeClass("fa-times").addClass("fa-check").css("color","limegreen")
		return true;
	}

	function checkAvailable(input,span,url){
		var returnValue=true,name=$(input).attr('name')
		var user=(name.localeCompare('phone')===0) ? '+'+$(input).val().trim():$(input).val().trim();
		if(name.localeCompare('user')===0){
			returnValue=checkUser(input,span)
		}else if(name.localeCompare('email')===0){
			returnValue=checkEmail(input,span)
		}else if(name.localeCompare('phone')===0){
			returnValue=checkPhone(input,span)
		}
		if(returnValue){
			$.post(url,{user:user},data=>{
				if(data.localeCompare("1")===0){
					$(span).removeClass("fa-check").addClass("fa-times").css("color","indianred")
				}else if(data.localeCompare("0")===0){
					$(span).removeClass("fa-times").addClass("fa-check").css("color","limegreen")
				}
			})
		}
	}

	function checkPass(input,span,input2,span2){
		checkRepeat(input,input2,span2)
		var secret=$(input).val()
		if(secret.length===0){
			$(span).removeClass("fa-times").removeClass("fa-check")
			return;
		}
		if(secret.length<8){
			$(span).removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return;
		}
		for(var i=0;i<secret.length;i++){
			if(isNaN(secret.charAt(i))){
				if(i===secret.length-1){
					$(span).removeClass("fa-check").addClass("fa-times").css("color","indianred")
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
					$(span).removeClass("fa-check").addClass("fa-times").css("color","indianred")
					return
				}
			}
		}
		$(span).removeClass("fa-times").addClass("fa-check").css("color","limegreen")
	}

	function checkRepeat(input1,input2,span){
		var secretRe=$(input2).val()
		var secret=$(input1).val()
		if(secretRe.length===0){
			$(span).removeClass("fa-times").removeClass("fa-check")
			return;
		}
		if(secretRe.localeCompare(secret)!==0){
			$(span).removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return
		}
		$(span).removeClass("fa-times").addClass("fa-check").css("color","limegreen")
	}

	function check_photo(event,label){
		var photo=$(event.currentTarget).val()
		if(photo.length===0){
			$(label).html("Profile Photo <span class='text-secondary'>(Optional): </span>")
			return;
		}
		var ext=photo.substr(photo.lastIndexOf(".")+1)
		if(ext.toLowerCase().localeCompare("png")!==0 && ext.toLowerCase().localeCompare("jpg")!==0 && ext.toLowerCase().localeCompare("jpeg")!==0 && ext.toLowerCase().localeCompare("gif")!==0){
			alert("Please select valid image file i.e gif,png or jpeg.")
			$(event.currentTarget).val("")
			$(label).html("Profile Photo <span class='text-secondary'>(Optional): </span>")
			return;
		}
		var value=(photo.indexOf("\\")>-1) ? photo.substr(photo.lastIndexOf("\\")+1) : photo.substr(photo.lastIndexOf("/")+1)
		$("#labelPhoto").html(value)
	}

	function diff_date(diff){
		diff=parseInt(diff)
		if(diff<120){
			diff="Just now"; 
		}else if(diff<3600){
			diff=Math.floor(diff/60)+" mins";
		}else if(diff<86400){
			diff=Math.floor(diff/3600)
			diff=(diff!==1)? diff+" hrs":"1 hr"
		}else if(diff<604800){
			diff=Math.floor(diff/86400)
			diff=(diff!==1)? diff+" dys":"1 dy"
		}else{
			var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
			date=Math.floor(new Date().getTime()/1000)
			date=new Date((date-diff)*1000)
			diff=(date.getFullYear()!==new Date().getFullYear()) ? months[date.getMonth()]+" "+date.getDate()+", "+date.getFullYear(): months[date.getMonth()]+" "+date.getDate()
		}
		return diff;
	}

	function post_date(diff){
		var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
		date=new Date((Math.floor(new Date().getTime()/1000)-parseInt(diff))*1000)
		var hours=(date.getHours()>12) ? date.getHours()-12:date.getHours();
		hours=(hours===0) ? 12:hours;
		var am=(date.getHours()>=12) ? "pm":"am"
		var minutes=(date.getMinutes()<10)? '0'+date.getMinutes():date.getMinutes();
		diff=days[date.getDay()]+" \u00b7 "+months[date.getMonth()]+" "+date.getDate()+", "+date.getFullYear()+" \u00b7 "+hours+":"+minutes+" "+am
		return diff;
	}

	function change_page($event,$scope,$sce,loader,url,top){
		if($($event.currentTarget).text()==$scope.current_page||isNaN(parseInt($($event.currentTarget).text()))) return
		$scope.data=[]
		$(loader).css({display:'table-row'})
		var offset=$($event.currentTarget).attr('data-offset')
		$.post(url,{search:$scope.search_field,offset:offset},data=>{
			$scope.$apply(()=>{
				data=JSON.parse(data)
				for(each in data[0]){
					$scope.data.push([data[0][each].contactID,data[0][each].name,data[0][each].email,$sce.trustAsHtml(data[0][each].question),$sce.trustAsHtml(data[0][each].reply),diff_date(data[0][each].time),post_date(data[0][each].time)])
				}
				$scope.current_page=parseInt($($event.currentTarget).text())
				update_page_list($scope)
			})
			$scope.check_page()
			$('body,html').scrollTop($(top).offset().top)
			$(loader).css({display:'none'})
		})
	}

	function update_page_list($scope){
		for(var i=0;i<$scope.pages_array.length;i++){
			if($scope.pages_array[i][0]===$scope.current_page){
				if($scope.pages_array[i+1]===undefined){
					update_pages_next($scope)
					return
				}
				if($scope.pages_array[i-1]===undefined){
					update_pages_previous($scope)
					return
				}
				if(isNaN(parseInt($scope.pages_array[i+1][0]))){
					update_pages_next($scope)
					return
				}
				if(isNaN(parseInt($scope.pages_array[i-1][0]))){
					update_pages_previous($scope)
					return
				}
			}
		}
	}

	function update_pages_next($scope){
		if($scope.current_page===$scope.page_count){
			$scope.pages_array=[]
			for(var i=$scope.page_count;i>0;i--){
				if(i===$scope.page_count-5&&$scope.page_count>7){
					$scope.pages_array.push(['...',10*(i-1),'2-'+i])
					$scope.pages_array.push([1,0,1])
					break
				}
				$scope.pages_array.push([i,10*(i-1),i])
			}
			$scope.pages_array=$scope.pages_array.reverse()
			return
		}
		$scope.pages_array[1]=['...',10*($scope.current_page-3),"2-"+($scope.current_page-2)]
		$scope.pages_array[2]=[$scope.current_page-1,10*($scope.current_page-2),$scope.current_page-1]
		$scope.pages_array[3]=[$scope.current_page,10*($scope.current_page-1),$scope.current_page]
		$scope.pages_array[4]=[$scope.current_page+1,10*($scope.current_page),$scope.current_page+1]
		$scope.pages_array[5]=($scope.current_page+3===$scope.page_count)?[$scope.current_page+2,10*($scope.current_page+1),$scope.current_page+2]:['...',10*($scope.current_page+1),($scope.current_page+2)+"-"+($scope.page_count-1)]
	}

	function update_pages_previous($scope){
		if($scope.current_page===1){
			$scope.pages_array=[]
			for(var i=0;i<$scope.page_count;i++){
				if(i===5&&$scope.page_count>7){
					$scope.pages_array.push(['...',10*i,'6-'+($scope.page_count-1)])
					$scope.pages_array.push([$scope.page_count,10*($scope.page_count-1),$scope.page_count])
					break
				}
				$scope.pages_array.push([i+1,10*i,i+1])
			}
			return
		}
		$scope.pages_array[1]=($scope.current_page-3===1)?[$scope.current_page-2,10*($scope.current_page-3),$scope.current_page-2]:['...',10*($scope.current_page-3),"2-"+($scope.page_count-2)]
		$scope.pages_array[2]=[$scope.current_page-1,10*($scope.current_page-2),$scope.current_page-1]
		$scope.pages_array[3]=[$scope.current_page,10*($scope.current_page-1),$scope.current_page]
		$scope.pages_array[4]=[$scope.current_page+1,10*($scope.current_page),$scope.current_page+1]
		$scope.pages_array[5]=['...',10*($scope.current_page+1),($scope.current_page+2)+"-"+($scope.page_count-1)] 
	}

	function search_angular($scope,$sce,loader,url){
		$scope.data=[]
		$scope.pages_array=[]
		$(loader).css({display:'table-row'})
		$.post(url,{search:$scope.search_field,offset:0},data=>{
			$scope.$apply(()=>{
				data=JSON.parse(data)
				for(each in data[0]){
					$scope.data.push([data[0][each].contactID,data[0][each].name,data[0][each].email,$sce.trustAsHtml(data[0][each].question),$sce.trustAsHtml(data[0][each].reply),diff_date(data[0][each].time),post_date(data[0][each].time)])
				}
				$scope.data_count=data[1]
				$scope.page_count=Math.ceil($scope.data_count/10)
				for(var i=0;i<$scope.page_count;i++){
					if(i===5&&$scope.page_count>7){
						$scope.pages_array.push(['...',10*i,'6-'+($scope.page_count-1)])
						$scope.pages_array.push([$scope.page_count,10*($scope.page_count-1),$scope.page_count])
						break
					}
					$scope.pages_array.push([i+1,10*i,i+1])
				}
				$scope.current_page=1
			})
			$scope.check_page()
			$(loader).css({display:'none'})
		})
	}

	function check_page($scope,pagination,no_data,previous,next){
		if($scope.page_count==0){
			$(pagination).css({display:'none'})
			$(no_data).css({display:'table-row'})
			return
		}else{
			$(pagination).css({display:'table-row'})
			$(no_data).css({display:'none'})
		}
		if($scope.current_page==1){
			$(previous).parent().addClass('disabled')
			if($scope.current_page!==$scope.page_count){
				$(next).parent().removeClass('disabled')
			}
		}
		if($scope.current_page==$scope.page_count){
			$(next).parent().addClass('disabled')
			if($scope.current_page!==1){
				$(previous).parent().removeClass('disabled')
			}
		}
		if($scope.current_page>1&&$scope.current_page<$scope.page_count){
			$(previous).parent().removeClass('disabled')
			$(next).parent().removeClass('disabled')
		}
	}

	function prev_next($event,$scope,$sce,loader,url,top){
		if(($($event.currentTarget).attr('title').localeCompare('Previous')===0 && $scope.current_page===1)||($($event.currentTarget).attr('title').localeCompare('Next')===0 && $scope.current_page===$scope.page_count)) return
		$scope.data=[]
		$(loader).css({display:'table-row'})
		var offset=($($event.currentTarget).attr('title').localeCompare('Previous')===0) ? 10*($scope.current_page-2):10*($scope.current_page)
		$.post(url,{search:$scope.search_field,offset:offset},data=>{
			$scope.$apply(()=>{
				data=JSON.parse(data)
				for(each in data[0]){
					$scope.data.push([data[0][each].contactID,data[0][each].name,data[0][each].email,$sce.trustAsHtml(data[0][each].question),$sce.trustAsHtml(data[0][each].reply),diff_date(data[0][each].time),post_date(data[0][each].time)])
				}
				$scope.current_page=($($event.currentTarget).attr('title').localeCompare('Previous')===0) ? $scope.current_page-1:$scope.current_page+1
				update_page_list($scope)
			})
			$scope.check_page()
			$('body,html').scrollTop($(top).offset().top)
			$(loader).css({display:'none'})
		})
	}

	function scrollAnimate(event) {
		if (event.currentTarget.hash !== "") {
  			event.preventDefault();
  			var hash = event.currentTarget.hash;
  			$('html, body').animate({scrollTop: $(hash).offset().top}, function(){window.location.hash = hash;});
  		}
	}

	function fade(){
		if(screen.width>992){
			if($(window).width()>992){
				var div=$("#main").height()
				var top=$("body,html").scrollTop()
				var percentage=1-(parseFloat(top)/parseFloat(div))
				if(percentage>0.1){
					$("#intro,#loginForm").fadeTo(0,percentage)
				}
			}else{
				$("#intro,#loginForm").fadeTo(0,1)
			}
		}
	}

$(document).ready(()=>{
	$("input,textarea").focus(event=>{
		if($(window).width()<=992){
			$("body,html").scrollTop($(event.currentTarget).offset().top-75)
		}
	})
})