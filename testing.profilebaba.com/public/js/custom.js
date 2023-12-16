$(document).ready(function() {
  var owl = $('.owl-carousel1');
  owl.owlCarousel({				
	nav: true,
	autoplay:true,
	autoplayTimeout:2000,
	autoplayHoverPause:true,
	loop: true,
	responsive: {
	  0: {
		items: 1
	  },
	  600: {
		items: 1
	  },
	  1000: {
		items: 1
	  }
	}
	
	
	
  })
  
  
  

  var owl2 = $('.owl-carousel2');
			  owl2.owlCarousel({				
				nav: true,
				autoplay:true,
				autoplayTimeout:2000,
				autoplayHoverPause:true,
				loop: true,
				responsive: {
				  0: {
					items: 1
				  },
				  600: {
					items: 3
				  },
				  1000: {
					items: 4
				  }
				}
			  })
	 var owl3 = $('.owl-carousel3');
			  owl3.owlCarousel({				
				nav: true,
				autoplay:true,
				autoplayTimeout:5000,
				autoplayHoverPause:true,
				loop: true,
				responsive: {
				  0: {
					items: 1
				  },
				  600: {
					items: 1
				  },
				  1000: {
					items: 1
				  }
				}
			  })
	var owl4 = $('.owl-carousel4');
			  owl4.owlCarousel({				
				nav: true,
				autoplay:true,
				autoplayTimeout:2000,
				autoplayHoverPause:true,
				loop: true,
				responsive: {
				  0: {
					items: 1
				  },
				  600: {
					items: 1
				  },
				  1000: {
					items: 1
				  }
				}
			  })
			   "use strict";

			$('.menu > ul > li:has( > ul)').addClass('menu-dropdown-icon');		


			$('.menu > ul > li > ul:not(:has(ul))').addClass('normal-sub');		

			$(".menu > ul").before("<a href=\"#\" class=\"menu-mobile\">MENU</a>");
			

			$(".menu > ul > li").hover(function (e) {
				if ($(window).width() > 943) {
					$(this).children("ul").stop(true, false).slideToggle(350);
					e.preventDefault();
				}
			});			

			$(".menu > ul > li").click(function () {
				if ($(window).width() <= 943) {
					$(this).children("ul").slideToggle(350);
				}
			});		

			$(".menu-mobile").click(function (e) {
				$(".menu > ul").toggleClass('show-on-mobile');
				e.preventDefault();
			});
			

})

$(document).ready(function() {
  $(".delete").hide();
  //when the Add Field button is clicked
  $("#add").click(function(e) {
    $(".delete").fadeIn("1500");
    //Append a new row of code to the "#items" div
    $("#items").append(
      '<div class="next-referral col-4"><input id="fileinput" name="fileinput" type="file" placeholder="Enter name of referral" class="form-control input-md"></div>'
    );
  });
  $("body").on("click", ".delete", function(e) {
    $(".next-referral").last().remove();
  });
});


$(".cross-btn").click(function(){
	$(".add-videos").fadeOut();
});
		
		
		
$('.log-btn').click(function(){
	$('.login-form-sec').fadeIn();
	$('body').addClass('open');
});

$('.close-btn').click(function(){
	$('.login-form-sec').fadeOut();
	$('body').removeClass('open');
});


$('.signup-btn').click(function(){
	$('.signup-form-sec').fadeIn()
});

$('.close-btn').click(function(){
	$('.signup-form-sec').fadeOut()
});