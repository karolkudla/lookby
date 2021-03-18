/* POKAŻ GALERIE WEWNĄTRZ OKIENKA NA STRONIE MIAST I GALERII */

function wnetrze_okienka(id) {

var miasto = $("#miasto").attr("city");	
var IDs = [];
IDs.push(id);
	
jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "lista",
					 c: miasto,
					 id: IDs
					 
						},

                 success: function(response) {					 

	var tablica = response.data;

	if (typeof tablica !== 'undefined') { 				
		$.each(tablica, function(key, value) {				
			$.each(value, function(k, val) {
				if (val.length > 0) {$(".lista-gal-"+key).append('<p class="wartosc_atr">Galeria '+val+'</p>');}
			});   			
		});		
	} else {$(".lista-gal-"+id).append('<center>W Twoim mieście brak tego produktu.<br>Przejdź do strony sklepu i zamów go online.</center>')}
	return false;
					   
}})}	
	


