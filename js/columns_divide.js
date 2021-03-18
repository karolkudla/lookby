function filters_count() {

if ($(window).width() >= 768) {
$('[class^="filtry-row-"]').each(function() {
	var klasa = this.className;
	replace = klasa.replace(/\D/g,'');    
	var id = replace;
	var count = $('.filtry-row-'+id+'').children().length;
	var col = Math.ceil(count/8)
	$('.filtry-row-'+id+'').attr("style","column-count:"+col)
})}

else 
	$('[class^="filtry-row-"]').attr("style","column-count: 2")
}

function atributes_count() {
	$('[class^="atrybut_data"]').each(function() {
	var klasa = this.className;
	replace = klasa.replace(/\D/g,'');  
	var id = replace;
	var count = $('.atrybut_data_'+id+'').children().length;
	var col = Math.ceil(count/10)
	$('.atrybut_data_'+id+'').attr("style","column-count:"+col)
})}	

function menu_count() {
	$('[class^="m-container-"]').each(function() {
	var klasa = this.className;
	replace = klasa.replace(/\D/g,'');  
	var id = replace;
	var count = $('.m-container-'+id+'').children().length;
		if ($(window).width() > 768) {
	var col = Math.ceil(count/10)
	/* console.log('.m-container-'+id+'='+count+'/'+'10='+col); */
	$('.m-container-'+id+'').attr("style","column-count:"+col)
		} else {
	col = 2
	$('.m-container-'+id+'').attr("style","column-count:"+col)		
		}
})}

/*function valcontainer_count() {
	$('[class^="valcontainer-"]').each(function() {
	var klasa = this.className;
	replace = klasa.replace(/\D/g,'');  
	var id = replace;
	var count = $('.valcontainer-'+id+'').children().length;
		if ($(window).width() > 768) {
	var col = Math.ceil(count/5)
	$('.valcontainer-'+id+'').attr("style","column-count:"+col)
		} else {
	col = 2
	$('.valcontainer-'+id+'').attr("style","column-count:"+col)		
		}
})}*/


$( window ).resize(function() {
filters_count()
atributes_count()
menu_count()
/*valcontainer_count()*/
})



	

