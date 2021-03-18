$('#klikacz-polubienia').click(function() {

if (history.state) {
	var haction = history.state.action;	
	}

	var stan = {
		action: "likes"
	}
	
	if (haction != stan.action) {	
		console.log("DODAŁEM DO HISTORII WEJŚCIE DO LAJKÓW")	
		history.pushState(stan, "", "/polubienia/");
	} else {
		console.log("NIC NIE ROBIE BO SA TAKIE SAME")	
	}			
	
jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "user_acc"
															 
						},
success: function(response) { 

	if (response.data == 'unlogged') {
		log_window();
	} else {
		$('#ajax').html(response);			
		/* var moje = $("#my_city").attr("value"); */
		/* $('#naglowek').html('<a id="miasto" city="'+moje+'">'+moje+'</div>') */
		/* napisy(); */
		faver_check_likes_onload();
		price();
		$('html').scrollTop(0)
	}
					
return false;					   
}})})

$('body').on('click','.icon-heart-broken', function(e) {
	var id = $(this).attr("id");
	var replace = id.replace(/\D/g,'');    
	click_like(replace)
})

$('body').on('click','.icon-heart', function(e) {
	var id = $(this).attr("id");
	var replace = id.replace(/\D/g,'');    
	click_unlike(replace)
})

function faver_check_likes_onload() {
	
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "faveronlogin",
					 
						},
                 success: function(response) {
		
				var likes = response.data;
				
				if (typeof likes !== 'undefined') {
									
					$.each(likes, function(key, value) {	
						$('#heart-'+value+'').attr("class","icon-heart");	
					})
				}
					
		 		return false;
					   
                    }
})}

function click_like(id) {
	
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "favlike",
					 id: id
					 
						},
                 success: function(response) {
				
				if (response.data == "logged") {
				$("#heart-"+id+"").attr("class","icon-heart");
				var total = $("#l-"+id+"").html();
				var increment = parseInt(total) + 1;
				$("#l-"+id+"").html(increment);
				
				} else {
					log_window();
				}

		 		return false;
					   
                    }
})
	
}

function click_unlike(id) {
	
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "favunlike",
					 id: id
					 
						},
                 success: function(response) {
				
				if (response.data == "logged") {
				$("#heart-"+id+"").attr("class","icon-heart-broken");
				var total = $("#l-"+id+"").html();
				var decrement = parseInt(total) - 1;
				$("#l-"+id+"").html(decrement);

				} else {
					log_window();
				}

		 		return false;
					   
                    }
})
	
}