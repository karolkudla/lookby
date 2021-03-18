$( document ).ready(function() {
	/*$('#naglowek').html('<a id="choose">Wybierz miasto lub galerię, aby przeglądać oferty z Twojej okolicy.</a>')*/
	menu_count();
	mostfaved();
	banner();	
	/* setTimeout(function(){
  		napisy();
	}, 800); */
	/*cookie_check();*/
});

/*$('body').on('click', '#show_mobile_filters', function() {
	$('body').css("overflow","hidden");
})

$('body').on('click', '#close_filters', function() {
	$('body').css("overflow","auto");
})*/

$('body').on('mousedown touchstart', '#reg-eye', function() {
	$('#register-password').prop("type","text");
	$('#reg-eye').css("color","lightblue");
})
$('body').on('mouseup touchend', '#reg-eye', function() {
	$('#register-password').prop("type","password");
	$('#reg-eye').css("color","black");
})
$('body').on('mousedown touchstart', '#log-eye', function() {
	$('#login-password').prop("type","text");
	$('#log-eye').css("color","lightblue");
})
$('body').on('mouseup touchend', '#log-eye', function() {
	$('#login-password').prop("type","password");
	$('#log-eye').css("color","black");
})

$('#loading').hide()
    .ajaxStart(function() {
        $('#loading').data('timeout', window.setTimeout(function(){ $("#loading").show()}, 1000));
    })
    .ajaxStop(function() {
       window.clearTimeout($("#loading").hide().data('timeout'));
    })

$('#l, #logo').click(function() {

	$(window).scrollTop(0);
	$('.form-control').val('');
	$('#show_mobile_filters').hide();
/* $('#naglowek').html('<a id="choose">Wybierz miasto lub galerię, aby przeglądać oferty z Twojej okolicy.</a>') */
	$('#wyszukiwarka').attr("placeholder","Szukaj w galeriach ...")
	mostfaved();
	banner();	
	/* setTimeout(function(){
  		napisy();
	}, 800); */

})

$('body').on('click', '#close_register', function() {
	$('#lform').hide()
	$('#login_overlay').hide()
})

$('body').on('click','#login_getter, #register_getter', function(e) {
   e.stopPropagation();
	return false;
});

$('body').on('click', '#show_mobile_filters', function() {
	$('#filtry_okno').show();
	$('body').addClass('overflow-f')
})

$('body').on('click', '#close_filters', function() {
	$('#filtry_okno').hide();
	$('body').removeClass('overflow-f')
})

$('#searchsubmit').hover(function() {
	var len = $('.form-control').val().length;
		
				if (len >= 3) {$('#searchsubmit').addClass('sbutton').removeClass('zobaczymy')}
					else {$('#searchsubmit').removeClass('sbutton').addClass('zobaczymy')}
				 		return false;
				 
				 })



$('body').on('click','#okienko', function(e) {
    e.stopPropagation(); 
    return false;                                
});

$('#okienko').on('click','[class^="city-input"]', function(e) {
    e.stopPropagation();
    return false;        
                        
});

$(".dropdown-toggle").mouseover(function(){
  $(this).next(".dropdown").toggle();
  var nextEl = $(this).next(".dropdown");
  $('.dropdown').not(nextEl).hide();
});

$(document).mouseover(function(e) {
  var target = e.target;
  if (
	  !$(target).is(".dropdown-toggle") && 
	  !$(target).is(".menu_top") && 
	  !$(target).parents().is(".dropdown")
  ) {
    $(".dropdown").fadeOut(500);
  }
});

$(".asub").click(function() {
	$(".dropdown").hide();
})
 
if(check_device() == 'mobile') {
   $('.form-control').click(function()
		{
		 $('#button-menu-mobile').hide();
	 	 $('.col5').hide();
		 $('#header').addClass('nowyheader');
	 	 $('#mmobile').addClass('nowymargin');
		});
	
	$(document).click(function(e) {
  		var target = e.target;
  		if (!$(target).is(".form-control")) {
    		$("#button-menu-mobile").show();
			$(".col5").show();
			$("#header").removeClass('nowyheader');
			$("#mmobile").removeClass('nowymargin');
  		}
	});
}

$("#button-menu-mobile").click(function(){
		$("#modal-menu-mobile").animate({width: 'toggle'}, "fast");
		$("#modal-menu-mobile").css("overflow","auto");
		$('body').addClass('overflow')
});

$('body').click(function(e) {
  var target = e.target;
  if (!$(target).is("#button-menu-mobile")) {
    $("#modal-menu-mobile").fadeOut(200)
	$('body').removeClass('overflow');
  }
});

$("#close_okienko").click(function(){
		$('#modal-menu-mobile').hide();
		$('body').removeClass('overflow');
});

$('#modal-menu-mobile').on('click','.accordion', function(e) {
    e.stopPropagation();
    return false;        
                        
});

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}