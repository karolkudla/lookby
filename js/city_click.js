$('body').on('click','.acity', function() {
	
var acity = $(this).text();
	var agal = '';
	console.log(acity);
	$('#naglowek').html('<a id="miasto" city="'+acity+'">'+acity+'</a>')
		$('.form-control').val("");
		$('#wyszukiwarka').attr("placeholder","Szukaj w mieście "+acity+" ...")
	banner(acity,"nul");
	mostfaved(acity,"nul");
	setTimeout(function(){
  		napisy();
	}, 600);	
	
})


$('.agal').click(function() {
	var agal = $(this).text();
	var acity = $(this).attr("city");
	$('#naglowek').html('<a id="miasto" city="'+acity+'">'+acity+'</a><a id="galeria" galeria="'+agal+'">Galeria '+agal+'</a>')
		$('.form-control').val("");
		$('#wyszukiwarka').attr("placeholder","Szukaj w galerii "+agal+" ...")
	banner("nul",agal);
	
	var prepare = acity+'_'+agal.replace(" ", "_");
	mostfaved("nul",prepare);
	
	setTimeout(function(){
  		napisy();
	}, 600);	
	
})

function mostfaved(acity,agal) {

var stan = {
		action: "mostfaved"
	};

if (history.state) {
	var haction = history.state.action;	
}

if (haction != stan.action) {	
	console.log("DODAŁEM DO HISTORII MOSTFAVED")
	history.pushState(stan, "", "/");		
} else {
	console.log("NIC NIE ROBIE BO SA TAKIE SAME")	
}
	
jQuery.ajax({
                 type : "GET",
                 url : global.ajax,
                 data : {
					 
					 action: "mostfaved",
					 c: acity,
					 gal: agal
					 
						},
success: function(response) {
	
$('#ajax').html(response);
faver_check_likes_onload();
return false;					   
}})}