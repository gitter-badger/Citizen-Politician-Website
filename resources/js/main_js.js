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

	function sign_up_user(event){
		var user=$(event).find("input[name='user']").val().trim()
		var email=$(event).find("input[name='email']").val().trim()
		var phone=$(event).find("input[name='phone']").val().trim()
		var pass=$(event).find("input[name='secret']").val()
		var passRe=$(event).find("input[name='secretRe']").val()
		$("div#sign_up_error").html("")

		//check if data is available
		if(user.length<1||email.length<1||phone.length<1||pass.length<1||passRe.length<1){
			$("div#sign_up_error").html("<div class='alert alert-danger alert-dismissable fade show'><strong>Error: </strong>Please fill out all fields.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
			return false;
		}

		//verify username format
		if(user.length<3){
			$("div#sign_up_error").html("<div class='alert alert-danger alert-dismissable fade show'><strong>Error: </strong>Username must be atleast 3 characters.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
			return false;
		}
		if(!isNaN(user.charAt(0))){
			$("div#sign_up_error").html("<div class='alert alert-danger alert-dismissable fade show'><strong>Error: </strong>Username cannot start with a number.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
			return false;
		}
		if(user.toLowerCase().localeCompare('mwananchi')===0){
			$("div#sign_up_error").html("<div class='alert alert-danger alert-dismissable fade show'><strong>Error: </strong>You cannot use the name 'mwananchi' as a usernname.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
			return false;
		}
		if((/[^a-z 0-9-_.]/i).test(user)){
			$("div#sign_up_error").html("<div class='alert alert-danger alert-dismissable fade show'><strong>Error: </strong>Username has unwanted symbols.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
			return false;
		}

		//verify email format
		if(email.indexOf("@")<1||(email.indexOf("@")+2)>email.lastIndexOf(".")||(email.lastIndexOf(".")+2)>=email.length){
			$("div#sign_up_error").html("<div class='alert alert-danger alert-dismissable fade show'><strong>Error: </strong>Email is of invalid format.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
			return false;
		}

		//verify phone number format
		if(isNaN(phone)){
			$("div#sign_up_error").html("<div class='alert alert-danger alert-dismissable fade show'><strong>Error: </strong>Please use a valid phone number.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
			return false;
		}

		//verify password format
		if(pass.length<8){
			$("div#sign_up_error").html("<div class='alert alert-danger alert-dismissable fade show'><strong>Error: </strong>Passwords should be 8 characters long.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
			return false;
		}
		if(!(/[a-z]/i).test(pass)||!(/[0-9]/i).test(pass)){
			$("div#sign_up_error").html("<div class='alert alert-danger alert-dismissable fade show'><strong>Error: </strong>Passwords should contain atleast 1 character and 1 number.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
			return false;
		}

		//check that passwords match
		if(passRe.localeCompare(pass)!==0){
			$("div#sign_up_error").html("<div class='alert alert-danger alert-dismissable fade show'><strong>Error: </strong>Passwords should match.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
			return false;
		}

		return true;
	}

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
		if(!(/[a-z]/i).test(secret)||!(/[0-9]/).test(secret)){
			$(span).removeClass("fa-check").addClass("fa-times").css("color","indianred")
			return
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

	function check_photo(event,label,error){
		var photo=$(event.currentTarget).val()
		if(photo.length===0){
			$(label).html("Profile Photo <span class='text-secondary'>(Optional): </span>")
			return;
		}
		var ext=photo.substr(photo.lastIndexOf(".")+1)
		if(ext.toLowerCase().localeCompare("png")!==0 && ext.toLowerCase().localeCompare("jpg")!==0 && ext.toLowerCase().localeCompare("jpeg")!==0 && ext.toLowerCase().localeCompare("gif")!==0){
			$(error).html("<div class='alert alert-danger alert-dismissable fade show'>Please use png, jpeg or gif image formats.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
			$(event.currentTarget).val("")
			$(label).html("Profile Photo <span class='text-secondary'>(Optional): </span>")
			return;
		}
		var value=(photo.indexOf("\\")>-1) ? photo.substr(photo.lastIndexOf("\\")+1) : photo.substr(photo.lastIndexOf("/")+1)
		$(label).html(value)
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

	function change_page($event,$scope,$sce,assets,url){
		if($($event.currentTarget).text()==$scope.current_page||isNaN(parseInt($($event.currentTarget).text()))) return
		$scope.data=[]
		$(assets.loader).css({display:'table-row'})
		$(assets.pagination).css({display:'none'})
		$(assets.search_element).closest('form').css({display:'none'})
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
			$(assets.pagination).css({display:'table-row'})
			$scope.check_page()
			$('body,html').scrollTop($(assets.top).offset().top)
			$(assets.loader).css({display:'none'})
			$(assets.search_element).closest('form').css({display:'initial'})
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

	function search_angular($scope,$sce,assets,url){
		$scope.data=[]
		$scope.pages_array=[]
		$(assets.loader).css({display:'table-row'})
		$(assets.pagination).css({display:'none'})
		$(assets.search_element).closest('form').css({display:'none'})
		$(assets.no_data).css({display:'none'})
		if($scope.current_page===-1){
			if(sessionStorage.getItem('data')!==undefined){
				if(new Date().getTime()-sessionStorage.getItem('faq_time')<180000){
					data=JSON.parse(sessionStorage.getItem('faq_data'))
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
					$(assets.pagination).css({display:'table-row'})
					$scope.check_page()
					$(assets.loader).css({display:'none'})
					$(assets.search_element).closest('form').css({display:'initial'})
					$scope.search_field=sessionStorage.getItem('faq_search_string')
					return;
				}
			}
		}
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
				sessionStorage.setItem('faq_data',JSON.stringify(data))
				sessionStorage.setItem('faq_time',new Date().getTime())
				sessionStorage.setItem('faq_search_string',$scope.search_field)
			})
			$(assets.pagination).css({display:'table-row'})
			$scope.check_page()
			$(assets.loader).css({display:'none'})
			$(assets.search_element).closest('form').css({display:'initial'})
		})
	}

	function check_page($scope,assets){
		if($scope.page_count==0){
			$(assets.pagination).css({display:'none'})
			$(assets.no_data).css({display:'table-row'})
			return
		}else{
			$(assets.pagination).css({display:'table-row'})
			$(assets.no_data).css({display:'none'})
		}
		if($scope.current_page==1){
			$(assets.previous).parent().addClass('disabled')
			if($scope.current_page!==$scope.page_count){
				$(assets.next).parent().removeClass('disabled')
			}
		}
		if($scope.current_page==$scope.page_count){
			$(assets.next).parent().addClass('disabled')
			if($scope.current_page!==1){
				$(assets.previous).parent().removeClass('disabled')
			}
		}
		if($scope.current_page>1&&$scope.current_page<$scope.page_count){
			$(assets.previous).parent().removeClass('disabled')
			$(assets.next).parent().removeClass('disabled')
		}
	}

	function prev_next($event,$scope,$sce,assets,url){
		if(($($event.currentTarget).attr('title').localeCompare('Previous')===0 && $scope.current_page===1)||($($event.currentTarget).attr('title').localeCompare('Next')===0 && $scope.current_page===$scope.page_count)) return
		$scope.data=[]
		$(assets.loader).css({display:'table-row'})
		$(assets.pagination).css({display:'none'})
		$(assets.search_element).closest('form').css({display:'none'})
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
			$(assets.pagination).css({display:'table-row'})
			$scope.check_page()
			$('body,html').scrollTop($(assets.top).offset().top)
			$(assets.loader).css({display:'none'})
			$(assets.search_element).closest('form').css({display:'initial'})
		})
	}

	function scrollAnimate(event) {
		if (event.currentTarget.hash !== "") {
  			event.preventDefault();
  			var hash = event.currentTarget.hash;
  			$('html, body').animate({scrollTop: $(hash).offset().top}, function(){window.location.hash = hash;});
  		}
	}

	function dateChooser($scope,$window){
		var allMonths=['January','February','March','April','May','June','July','August','September','October','November','December']
		$scope.days=[]
		$scope.months=[]
		$scope.years=[]
		for(var i=1900;i<=new Date().getFullYear();i++){
			$scope.years.push(i)
		}
		$scope.get_months=function(){
			$scope.months=[]
			if($scope.year==new Date().getFullYear().toString()){
				for(var i=0;i<(new Date().getMonth()+1);i++){
					$scope.months.push([(i+1),allMonths[i]])
				}
				if(parseInt($scope.month)>(new Date().getMonth()+1)){
					$scope.month='1'
				}
			}else{
				for(var i=0;i<12;i++){
					$scope.months.push([(i+1),allMonths[i]])
				}
			}
			$scope.get_days()
		}
		$scope.get_days=function(){
			$scope.days=[]
			if($scope.month==(new Date().getMonth()+1).toString()&&$scope.year==new Date().getFullYear().toString()){
				for(var i=0;i<new Date().getDate();i++){
					$scope.days.push(i+1)
				}
			}else{
				if($scope.month==2){
					if(parseInt($scope.year)%4===0){
						for(var i=0;i<29;i++){
							$scope.days.push(i+1)
						}
					}else{
						for(var i=0;i<28;i++){
							$scope.days.push(i+1)
						}
					}
				}else if(parseInt($scope.month)<=7){
					if(parseInt($scope.month)%2===0){
						for(var i=0;i<30;i++){
							$scope.days.push(i+1)
						}
					}else{
						for(var i=0;i<31;i++){
							$scope.days.push(i+1)
						}
					}
				}else{
					if(parseInt($scope.month)%2===0){
						for(var i=0;i<31;i++){
							$scope.days.push(i+1)
						}
					}else{
						for(var i=0;i<30;i++){
							$scope.days.push(i+1)
						}
					}
				}
			}
			if($scope.day>$scope.days.length){
				$scope.day="1"
			}
		}
		$scope.submit=function($event){
			if($($window).width()<991){
				$('body,html').scrollTop(0)
			}
			var now=new Date().getTime()
			var date=new Date();date.setFullYear(parseInt($scope.year));date.setMonth(parseInt($scope.month)-1);date.setDate(parseInt($scope.day));
			var age=(new Date(now-date.getTime()).getFullYear()-1970)
			$("input[name='age']").attr("value",age)
			var user=sign_up_user($event.currentTarget)
			if(!user){
				$event.preventDefault()
				return
			}
			if(age<16){
				$("div#sign_up_error").html("<div class='alert alert-danger alert-dismissable fade show'><strong>Error: </strong>You do not meet age requirements to create an account on the site.<button class='close' style='line-height:0.83;outline:none;' data-dismiss='alert'><span>&times;</span></button></div>")
				$event.preventDefault()
			}
		}
		$scope.day=new Date().getDate().toString()
		$scope.year=new Date().getFullYear().toString()
		$scope.month=(new Date().getMonth()+1).toString()
	}