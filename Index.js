$(document).ready(()=>{
	$("div,button").not("div.container-fluid,div#one,div.holder,div.alert").hide();
	var prepare=anime({targets: '.alert',scale:0.125})
	setTimeout(index,2000)
	anime.timeline({loop: false}).add({targets: '.header .line', opacity: [0.5,1], scaleX: [0, 1], easing: "easeInOutExpo", duration: 1700,delay:2700}).add({targets: '.header .line',duration: 900,easing: "easeOutExpo",translateY: function(e, i, l) {var offset = -0.625 + 0.625*2*i; return offset + "em";}}).add({targets: '.header .ampersand', opacity: [0,1], scaleY: [0.5, 1], easing: "easeOutExpo", duration: 700, offset: '-=600'}).add({targets: '.header .letters-left', opacity: [0,1], translateX: ["0.5em", 0], easing: "easeOutExpo", duration: 1000, offset: '-=300'}).add({targets: '.header .letters-right', opacity: [0,1], translateX: ["-0.5em", 0], easing: "easeOutExpo", duration: 1000, offset: '-=600'});

	function index(){
		$("body").css({transitionDuration:"5s"}).addClass("bg-info")
		var decimal_places = 1;
		var decimal_factor = 10;
		$("#two").fadeIn(2000,()=>{
			$("#three").show()
			var specificPropertyParameters = anime({targets: '.alert',translateX: {value: 600, duration: 1700}, rotate: {value: 360, duration: 700,delay:1000, easing: 'easeInOutSine'}, scale: {value: 1, duration: 1100, delay: 1000, easing: 'easeInOutQuart'}, delay: 250}).finished.then(()=>{
				$("button").show()
				var button=anime({targets: 'button',opacity: 1, left: '50%' ,width: {value: 130,delay:300,duration: 500},duration: 200})
			});
			var owners=anime({targets: '#three',left:"50%",duration:1500}).finished.then(()=>{
				$("#four").fadeIn(1300,()=>{
					$('#version').animateNumber({number: 1 * decimal_factor,easing: 'easeInQuad',numberStep: function(now, tween) {
		       			var floored_number = Math.floor(now) / decimal_factor;
		       			var target = $(tween.elem);
				        target.text(floored_number.toFixed(decimal_places));
		    		}
		    		},2000);
		    		$('#year').prop('number',2015).animateNumber({number: 2018,easing: 'easeInQuad'},2500,()=>{
		    			$("#year").html("2018 <i style='font-size: 16px'>https://mwananchi.herokuapp.com</i>").css({color:"gray"})
		    			$("#version").css({color:"gray"})
		    		});
				})
			})
		});
	}
})