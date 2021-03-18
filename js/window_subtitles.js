$('body').on('click', '[class^="tytul-"], [class^="klikacz"], [class^="inner-div"]', function() {		
	var id_string = this.className;
	var id = id_string.replace(/\D/g,'');	
	okno(id);
})

$('body').on('click','.icon-heart, .icon-heart-broken', function(e) {
   e.stopPropagation();
	return false;
});


function okno(id) {
	
var stan = {
    	id: id,
		action: "okno"
	};

	var tytul = $(".tytul-"+id).text();
	var rep1 = tytul.replace(/ /g, "-");
	var rep2 = rep1.replace(/:/g, "-");
	var rep3 = rep2.replace(/\//g, "-");
	
if (history.state) {
	var haction = history.state.action;	
}

if (haction != stan.action) {	
	console.log("DODAŁEM DO HISTORII OKNO")
	history.pushState(stan, "", rep3+"-"+id);
} else {
	console.log("NIC NIE ROBIE BO SA TAKIE SAME")	
}	
	
	
$('#okienko').show();	
$('#okienko_overlay').fadeIn(100);
$('body').addClass("overflow-f");

var miasto = $("#miasto").attr("city");	

jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "otworz_okno",
					 id: id,
					 c: miasto,
					 					 
						},
                 success: function(response) {
					 
						$("#okienko").html(response)
					 	atributes_count();
					 	if (miasto !== undefined) {
							wnetrze_okienka(id);
					 	}
					 
			     	return false;					   
}})}
	
/* KLIKNIĘCIE NA BODY WYŁĄCZA OKIENKO */

/*$('body').click(function(e) {
  var target = e.target;
  if (!$(target).is("[class^='tytul-'], [class^='klikacz'], [class^='inner-div']")) {
    $('#okienko').hide();
	$('#okienko').empty();
	$('#okienko_overlay').hide();
	$('body').removeClass("overflow-f")
  }
});*/

$('body').on('click', '#close_okienko', function() {

window.history.back();	
/*	$('#okienko').hide();
	$('#okienko').empty();
	$('#okienko_overlay').hide();
	$('body').removeClass("overflow-f");
*/
	
})

/* WYŚWIETL NAPISY POD ZDJĘCIAMI NA STRONIE GŁÓWNEJ, STRONIE MIAST, STRONIE GALERII */
/*
function napisy() {

var miasto = $("#miasto").attr("city")
var galeria = $("#galeria").attr("galeria");

	
if (miasto == undefined && galeria == undefined) {$('[class^="klikacz-"]').html('Pokaż galerie ...')}
if (miasto !== undefined) {
			
	var IDs = [];
	$("article").each(function(){ 	
		var id = this.id;
		var usun = id.replace(/\D/g,'');
		IDs.push(usun);
	});
		
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

	if ((miasto !== undefined) && (typeof tablica !== 'undefined')) {	
		$.each(tablica, function(key, value) {
			if (value.length == 1) {$('.klikacz-'+key).html(value[0]+' ...')};
			if (value.length > 1) {$('.klikacz-'+key).html(value[0]+', '+value[1]+' ...')};
		})
		$("[class^='klikacz-']").each(function() {
			if ($(this).html() == '') {$(this).html('Brak galerii.')}
		})
	}
	return false;
					   
}})}} 
*/
