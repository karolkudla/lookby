$("#header").on("click", ".sbutton", function() {
		var st = $(".form-control").val();	
		search(st);
});

$('.form-control').keydown(function(event){
	var st = $('.form-control').val();
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13' && st.length > 2){
 		search(st);
}});

function search(st) {
	
	$('#mostfaved-wrapper').hide();
	$('#footer').hide();
	$('.footerb').hide();
			
	var miasto = $("#miasto").attr('city');
	var galeria = $("#galeria").attr('galeria');
	
	var stan = {
		st: st,
		action: "search"
	};
	
if (history.state) {
	var haction = history.state.action;	
}

if (haction != stan.action) {	
	console.log("DODAŁEM DO HISTORII SEARCH")	
	history.pushState(stan, "", "?q="+st);
} else {
	console.log("NIC NIE ROBIE BO SA TAKIE SAME")	
}		
		
	jQuery.ajax({
                 type : "GET",
                 url : global.ajax,
                 data : {
					 
					 action: "search",
					 q: st,
					 c: miasto,
					 g: galeria,
					 
					 dev: check_device(),
					 
						},
                 success: function(response) {
					 
					 
					 
     				$(".autocomplete-suggestions, .autocomplete-suggestions-mobile").hide();	
					$('#ajax').html(response);
					 $(window).scrollTop( 0 )
					$('.footerb').show();
					document.activeElement.blur();
		var  ip = parseInt($('#ip').text())				 					
		if (check_device() == 'mobile' && ip > 0) {
		$('#button_wrapper').html('<button id="show_mobile_filters"><span class="icon-equalizer"></span></button>')			
		$('#button-menu-mobile').show();
	    $('.col5').show();
		$('#header').removeClass('nowyheader');
	 	$('#mmobile').removeClass('nowymargin');
		} 
					 
		$('body').removeClass('overflow')

					/* napisy(); */
					filters_count()
					$('#footer').show();
					faver_check_likes_onload();
					
		 			return false;
					   
                    }
});   
};