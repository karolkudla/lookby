function user_acc() { /* WYWOŁYWANA PO ZALOGOWANIU I REJESTRACJI (A NIE PO KLIKNIĘCIU NA KLIKACZ POLUBIENIA) */
	console.log("NO HEJKA, ZALOGOWALIŚMY SIĘ")
		
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "user_acc",
					 
						},
                 success: function(response) {
					
					 
					 
					var info = response.data;
					if (info == 'unlogged') {
						console.log("W sesji nie ma loginu.")
					}
					if (info == 'tokennotmatch') {console.log("Tokeny nie pasują do siebie!")}

					$('#ajax').html(response);	
					 var moje = $("#my_city").attr("value");
					/* $('#naglowek').html('<a id="miasto" city="'+moje+'">'+moje+'</div>') */
					 /* napisy(); */
					 faver_check_likes_onload();
					 price();	
					 $('#mobile-city').html('<div class="acity">'+moje+'</div>')
					 $('html').scrollTop(0)
					return false;					   
                    }
})}

$('body').on("change","#city-selector-us", function() {	
	var city = $(this).val();
	change_city(city);	
})

function change_city(new_city) {
jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "change_city",
					 newcity: new_city
					 
						},
                 success: function(response) {
					
					$('#naglowek').html('<a id="miasto" city="'+new_city+'">'+new_city+'</div>')
					user_acc();
					return false;					   
                    }
})

}


$('body').on("click","#clear", function() {
clear();
})

function clear() {
	
jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "clear",
					 
						},
                 success: function(response) {
					user_acc();
					price();
					return false;					   
                    }
})	
	
}

function price() {
	var total = [];
	$('.price').each( function() {
		var price = parseFloat($(this).text());
		total.push(price);
	})
	
	var tot = 0;
	for (var i = 0; i < total.length; i++) {
    tot += (total[i]*100) << 0;
	}
	var float = tot/100;
	
	$('#total').html(float+" PLN")
}

$(window).on('beforeunload', function(){
jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "logout_onclose",
					 
						},
                 success: function(response) {
					

					return false;
		 	
					   
                    }
})		
});

$( window ).unload(function() {

});

$('body').on('click', '#logout', function() {

	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "logout",
					 
						},
                 success: function(response) {
					
					 location.reload();				
					return false;
		 	
					   
                    }
})	
	
})