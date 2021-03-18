$( document ).ready(function() {
   counter();
});

$("#del_db").click(function() {
	del_db();
})

$("#mf_make").click(function() {
	mf_make();
})

$('.down').click(function() {		
$(".act[gid=ajpdx1i8ka7rfxa]").html("Moda")
$(".act[gid=f8h2e8rrvcqedcu]").html("Elektronika")
$(".act[gid=vlx4c3gvhtwts2n]").html("Zdrowie i Uroda")
$(".act[gid=jjkzzj0ng68izkr]").html("Sport")
$(".act[gid=0x8x96atm9q5u96]").html("Biżuteria i Zegarki")
$(".act[gid=ecs1axzet1k6dnb]").html("Dla dziecka")
$(".act[gid=4wvgp4277w3f67m]").html("Dom i Ogród")
$(".act[gid=yyi8xrhek8812xs]").html("Księgarnie")
})

$('#menu_make').click(function() {
	menu_make();
})

$('.act').click(function() {
	var gid = $(this).attr("gid");
	var file = $(this).attr("file");
	$(this).html("CZEKAJ ...")
	google(gid,file);
})

$('.awin').click(function() {	
	var sklep_id = this.id;
	var kat = $(this).attr("kat");
	var max = $("#how_many").val();
	var begin = 1;
	var name = $(this).text();		
		$("#znalezione, #nie_znalezione, #yes, #not").html("");
	awin_call(sklep_id,kat,begin,max,name);	
})

$('.conv').click(function() {
	var sklep_id = this.id;
	var page = 1;	
	var kat = $(this).attr("kat");
	var name = $(this).text();
		$("#znalezione, #nie_znalezione, #yes, #not").html("");
	convertiser_call(sklep_id, page, kat, name);	
})

$('.td').click(function() {
	var sklep_id = this.id;
	var kat = $(this).attr("kat");
	var name = $(this).text();
	var start = 1;
	var max = $("#how_many").val();
		$("#znalezione, #nie_znalezione, #yes, #not").html("");
	td_call(sklep_id, kat, name, start, max);	
})

$('.ns').click(function() {
	var sklep_id = this.id;
	var kat = $(this).attr("kat");
	var name = $(this).text();
	var start = 1;
	var max = $("#how_many").val();
		$("#znalezione, #nie_znalezione, #yes, #not").html("");
	ns_call(sklep_id, kat, name, start, max);	
})

/*function test(liczba) {
	console.log(liczba);
	var nowa = liczba-1;
	if (nowa > 0) {
		test(nowa);
	}	
}*/

function convertiser_call(sklep_id,page,kat,name) {

	$("#"+sklep_id).html("Czekaj ...")	
	var ch = $("#chdb").prop('checked');
	var dont = $("#dont").prop('checked');
	
var pc = $("#how_many").val();
if (pc !== '' && pc > 499) {
var how_many = (pc/500)+1;
} else {
var how_many = 2;
}

jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "api_convertiser",
					 api_id: sklep_id,
					 page: page,
					 kat: kat,
					 name: name,
					 ch: ch
										 
						},
success: function(response) {

var r = response.data;
var produkty = r.produkty;
var brak = r.brak;
var maxi = r.maxi;

console.log(r.puste);	
	
if (dont == false) {
var flagi = r.flagi;
console.log(flagi);	


if (produkty) {
$.each(produkty, function( index, value ) {
  $("#znalezione").append('<tr><td class="nr"></td><td><a href="'+value.img+'">IMG</a></td><td>'+value.nazwa+'</td><td>'+value.szukam+'</td><td>'+value.nowa_kat+'</td><td>'+value.stara+'</td></tr>');
});
}
	
if (brak) {	
$.each(brak, function( index, value ) {
  $("#nie_znalezione").append('<tr><td class="bnr"></td><td><a href="'+value.img+'">IMG</a></td><td>'+value.nazwa+'</td><td>'+value.stara+'</td></tr>');
});
}

}
	
var not = $('.bnr').length;
var yes = $('.nr').length;	
	
if (r.page !== null) {
	var all = parseInt(r.page)*500-500;
} else {
	var all = not+yes;
}

	$("#yes").html(yes+'/'+all);
	$("#not").html(not+'/'+all);		
	$("#actual_page").html(all);	


if (how_many > Math.ceil(maxi/500)){
	how_many = null;
}

if (r.page !== how_many) {
	convertiser_call(r.id,r.page,r.kat,name,ch);
}
	
$('#znalezione tr').each(function(i) {
        $(this).children('.nr').text(i);
    });

if (('#nie_znalezione tr').length !== undefined) {
	$('#nie_znalezione tr').each(function(i) {
        $(this).children('.bnr').text(i);
    });
}	
	
$("#"+sklep_id).html(name);	

if (ch == true) {
	counter();
}
	
return false;					   
}
})	

}

function awin_call(sklep_id,kat,begin,max,name) {

	$("#"+sklep_id).html("Czekaj ...");
	var ch = $("#chdb").prop('checked');
	var dont = $("#dont").prop('checked');
	
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "awin_call",
					 sklep_id: sklep_id,
					 kat: kat,
					 b: begin,
					 max: max,
					 name: name,
					 ch: ch
	 
						},
success: function(response) {

var r = response.data;
var produkty = r.produkty;
var brak = r.brak;
var begin = r.begin;
var max = r.max;
var store = r.store;
var kat = r.kat;
var puste = r.puste;
console.log(puste);
	
if (dont == false) {	
var flagi = r.flagi;
console.log(flagi);	
	
if (produkty) {
$.each(produkty, function( index, value ) {
  $("#znalezione").append('<tr><td class="nr"></td><td><a href="'+value.img+'">IMG</a></td><td>'+value.nazwa+'</td><td>'+value.szukam+'</td><td>'+value.nowa_kat+'</td><td>'+value.stara+'</td></tr>');
});
}
	
if (brak) {	
$.each(brak, function( index, value ) {
  $("#nie_znalezione").append('<tr><td class="bnr"></td><td><a href="'+value.img+'">IMG</a></td><td>'+value.nazwa+'</td><td>'+value.stara+'</td></tr>');
});
}
	
$('#znalezione tr').each(function(i) {
        $(this).children('.nr').text(i);
    });

if (('#nie_znalezione tr').length !== undefined) {
	$('#nie_znalezione tr').each(function(i) {
        $(this).children('.bnr').text(i);
    });
}	
}
var not = $('.bnr').length;
var yes = $('.nr').length;	
var b = parseInt(begin)-1;
	
	
	$("#actual_page").html(b);	
	$("#yes").html(yes+'/'+b);
	$("#not").html(not+'/'+b);
	
if (max > begin) {
	awin_call(store,kat,begin,max,name,ch);
}
	
$("#"+sklep_id).html(name);	

if (ch == true) {
	counter();
}	
	
return false;					   
}
})
	
}


function td_call(sklep_id,kat,name,start,max) {

	$("#"+sklep_id).html("Czekaj ...");
	var ch = $("#chdb").prop('checked');
	var dont = $("#dont").prop('checked');
	
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "td_call",
					 sklep_id: sklep_id,
					 kat: kat,
					 name: name,
					 start: start,
					 max: max,
					 ch: ch
	 
						},
success: function(response) {
		
var r = response.data;
var produkty = r.produkty;
var brak = r.brak;
var start = r.start;
var max = r.max;
var sklep_id = r.sklep_id;
var kat = r.kat;
console.log(r.puste);	
	
if (dont == false) {	
var flagi = r.flagi;
console.log(flagi);
		
if (produkty) {
$.each(produkty, function( index, value ) {
  $("#znalezione").append('<tr><td class="nr"></td><td><a href="'+value.img+'">IMG</a></td><td>'+value.nazwa+'</td><td>'+value.szukam+'</td><td>'+value.nowa_kat+'</td><td>'+value.stara+'</td></tr>');
});
}
	
if (brak) {	
$.each(brak, function( index, value ) {
  $("#nie_znalezione").append('<tr><td class="bnr"></td><td><a href="'+value.img+'">IMG</a></td><td>'+value.nazwa+'</td><td>'+value.stara+'</td></tr>');
});
}
	
$('#znalezione tr').each(function(i) {
        $(this).children('.nr').text(i);
    });

if (('#nie_znalezione tr').length !== undefined) {
	$('#nie_znalezione tr').each(function(i) {
        $(this).children('.bnr').text(i);
    });
}	
}
var not = $('.bnr').length;
var yes = $('.nr').length;	
var start = parseInt(start)+500;
	
	$("#actual_page").html(start);	
	$("#yes").html(yes+'/'+start);
	$("#not").html(not+'/'+start);	

$("#"+sklep_id).html(name);


if (max > start) {		
	td_call(sklep_id,kat,name,start,max,name,ch)
}
	
$("#"+sklep_id).html(name);

if (ch == true) {
	counter();
}	
	
return false;					   
}
})}

function ns_call(sklep_id,kat,name,start,max) {

	$("#"+sklep_id).html("Czekaj ...");
	var ch = $("#chdb").prop('checked');
	var dont = $("#dont").prop('checked');
	
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "ns_call",
					 sklep_id: sklep_id,
					 kat: kat,
					 name: name,
					 start: start,
					 max: max,
					 ch: ch
	 
						},
success: function(response) {

var r = response.data;
var produkty = r.produkty;
var brak = r.brak;
var start = r.start;
var max = r.max;
var sklep_id = r.sklep_id;
var kat = r.kat;
console.log(r.puste);	
if (dont == false) {	
var flagi = r.flagi;
console.log(flagi);
	
if (produkty) {
$.each(produkty, function( index, value ) {
  $("#znalezione").append('<tr><td class="nr"></td><td><a href="'+value.img+'">IMG</a></td><td>'+value.nazwa+'</td><td>'+value.szukam+'</td><td>'+value.nowa_kat+'</td><td>'+value.stara+'</td></tr>');
});
}
	
if (brak) {	
$.each(brak, function( index, value ) {
  $("#nie_znalezione").append('<tr><td class="bnr"></td><td><a href="'+value.img+'">IMG</a></td><td>'+value.nazwa+'</td><td>'+value.stara+'</td></tr>');
});
}
	
$('#znalezione tr').each(function(i) {
        $(this).children('.nr').text(i);
    });

if (('#nie_znalezione tr').length !== undefined) {
	$('#nie_znalezione tr').each(function(i) {
        $(this).children('.bnr').text(i);
    });
}	
}
var not = $('.bnr').length;
var yes = $('.nr').length;	
var start = parseInt(start)+500;
	
	$("#actual_page").html(start);	
	$("#yes").html(yes+'/'+start);
	$("#not").html(not+'/'+start);	
	
if (max > start) {		
	ns_call(sklep_id,kat,name,start,max,name,ch)
}
	
$("#"+sklep_id).html(name);

if (ch == true) {
	counter();
}	
	
return false;					   
}
})	
}

function google(gid,file) {
	
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "google",
					 gid : gid,
					 file : file
	 
						},
success: function(response) {
	
$(".act[gid="+gid+"]").html(response)
	
return false;					   
}})}

function del_db() {

	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "del_db"
	 
						},
success: function(response) {
	
$("#del_db").html(response)

counter();
	
return false;					   
}})}

function counter() {
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "counter"
	 
						},
success: function(response) {
	
$("#counter").html(response)
	
return false;					   
}})}

function menu_make() {
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "menu_make"
	 
						},
	success: function(response) {
	
	$("#menu_make").html(response)
	
	return false;					   
}})	
}

function mf_make() {
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "mf_make"
	 
						},
	success: function(response) {
	
	$("#mf_make").html(response);
	
	return false;					   
}})	
}
	