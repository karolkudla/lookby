$('body').on("click", '.autocomplete-suggestion',function(e){
		var id = $(this).attr("produkt");	
		$('#okienko').show();			
		okno(id);
		$('#okienko_overlay').fadeIn(100);
		$('body').addClass("overflow-f");
});

if ($(window).width() > 768) {

$('html').on("input", '.form-control',function(e){
	
	var wyraz = $('.form-control').val();
	
	if (wyraz.length > 2) {
	
	var miasto = $("#miasto").attr('city');
	var galeria = $("#galeria").attr('galeria');
		
		
jQuery.ajax({	 
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "suggestions",
					 q: wyraz,
					 c: miasto,
					 g: galeria
					 
						},
				
                success: function(response) {

	$('.autocomplete-suggestions').show();
	$(".autocomplete-suggestions").empty();				 
				 
var obj = response.data		
$.each(obj, function(key, value) {
$(".autocomplete-suggestions").append(
'<div class="autocomplete-suggestion" produkt="'+value.id+'" term="'
+value.name+
'"><div class="suggestion-img"><img src="'
+value.img+
'"></div><div style="padding: 15px; width: 85%;">'
+ value.name +
'<div style="display: flex; align-items: center;"><div class="ml">'
+ value.store +
', '
+ value.brand +
'</div><div class="suggestion-price">'
+ value.price +
' zł</div></div></div>'
);});
					
	$(".autocomplete-suggestion").on("hover", function(){
	$(this).toggleClass("selected");})				
	var suggwidth = $('.col1').width()+$('.col2').width()+$('.col3').width()+$('.col4').width()+$('.col5').width()+$('.col6').width()
	$('.autocomplete-suggestions').width(suggwidth);

					
return false;
					   
               }
})} else {$('.autocomplete-suggestions').hide();	}
});}

$('body').click(function(e) {
  	var target = e.target;
  	if (!$(target).is('.autocomplete-suggestions')) {
    $('.autocomplete-suggestions').hide();
  	}});

/* *************************************************** MOBIL **************************************************** */

if ($(window).width() < 768) {
$('html').on("input", '.form-control',function(e){

	var wyraz = $('.form-control').val();
	
	if (wyraz.length > 2) {
	
	var miasto = $("#miasto").attr('city');
	var galeria = $("#galeria").attr('galeria');
		
		
jQuery.ajax({	 
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "suggestions",
					 q: wyraz,
					 c: miasto,
					 g: galeria
					 
						},
				
                success: function(response) {

	$('.autocomplete-suggestions-mobile').show();
	$(".autocomplete-suggestions-mobile").empty();				 
				 
var obj = response.data		
$.each(obj, function(key, value) {
$(".autocomplete-suggestions-mobile").append(
'<div class="autocomplete-suggestion" produkt="'+value.id+'" term="'
+value.name+
'"><div class="suggestion-img"><img src="'
+value.img+
'"></div><div style="padding: 15px;">'
+ value.name +
'<div style="display: flex; align-items: center;"><div class="ml">'
+ value.store +
', '
+ value.brand +
'</div><div class="suggestion-price">'
+ value.price +
' zł</div></div></div>'
);});
					
	$(".autocomplete-suggestion").on("hover", function(){
	$(this).toggleClass("selected");})
	
	var suggwidth = $('.col3').width()+$('.col4').width()
	$('.autocomplete-suggestions-mobile').width(suggwidth);

$('body').addClass("overflow")
					
return false;
					   
               }
})} else {$('.autocomplete-suggestions-mobile').hide();	}
});

$('body').click(function(e) {
  	var target = e.target;
  	if (!$(target).is('.autocomplete-suggestions-mobile')) {
    $('.autocomplete-suggestions-mobile').hide();
  	}});
}


