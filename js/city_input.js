/* DZIAŁANIE INPUTA WEWNĄTRZ OKIENKA */

$('body').on('keydown', '[class^="city-input-"]', function(event) {
var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
 		var theClass = this.className;
		myString = theClass.replace(/\D/g,'');    
		var id = myString;
		var IDs = [];
		IDs.push(id);	
		var miasto = $('.city-input-' + myString).val();
		napisy_input(miasto,IDs,id)
	}
})
	
$('body').on('click', '[class^="city_getter_"]', function(e) {
	var theClass = this.className;
	myString = theClass.replace(/\D/g,'');    
	var id = myString;
	var IDs = [];
	IDs.push(id);	
	var miasto = $('.city-input-' + myString).val();
	napisy_input(miasto,IDs,id)
})


function napisy_input(miasto,IDs,id) {

	if (miasto.length > 2) {
jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "lista",
					 c: miasto,
					 id: IDs
					 
						},
success: function(response) {
	$(".lista-gal-"+id).empty();
	var tablica = response.data;
	if (tablica == undefined) {$(".lista-gal-"+id).append('<center>W mieście <b>'+miasto+'</b> brak tego produktu</center>')}
		if (tablica !== undefined) {
		$.each(tablica, function(key, value) {
			$.each(value, function(k, val) {				
			if (val.length > 0) {$(".lista-gal-"+key).append('<p class="wartosc_atr">Galeria '+val+'</p>');}
			
			;}
	)})}
	
	return false;					   
                }
}); }  
};
