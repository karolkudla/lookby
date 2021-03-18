$('body').on('click', '#next', function() {
	
	var page = $("#here").text();
	var next = parseInt(page) + 1;
	filter(next);
	
	if (check_device() == 'desktop') {
	$('html').animate({	
    scrollTop: $("#search_info").offset().top + (-70)
	}, 100);
	} else {
	$('html').animate({	
    scrollTop: $("#search_info").offset().top + (-50)
	}, 100);	
	}
	
})

$('body').on('click', '#prev', function() {
	var page = $("#here").text();
	var prev = parseInt(page) - 1;
	filter(prev);
	if (check_device() == 'desktop') {
	$('html').animate({	
    scrollTop: $("#search_info").offset().top + (-70)
	}, 100);
	} else {
	$('html').animate({	
    scrollTop: $("#search_info").offset().top + (-50)
	}, 100);	
	}
})

$('body').on('click', '#sib', function() {
	var page = $(this).text();
	filter(page);
	if (check_device() == 'desktop') {
	$('html').animate({	
    scrollTop: $("#search_info").offset().top + (-70)
	}, 100);
	} else {
	$('html').animate({	
    scrollTop: $("#search_info").offset().top + (-50)
	}, 100);	
	}
})

$('body').on('click', '#asc_search', function(e) {
	$('#sort').attr("sort","ASC")
	 $('#desc_search').prop('checked',false); $('#asc_search').prop('checked', true)
	filter();
});

$('body').on('click', '#desc_search', function(e) {
	$('#sort').attr("sort","DESC")
	$('#asc_search').prop('checked', false); $('#desc_search').prop('checked',true)
	filter();
});

$('body').on('input', '#min_search, #max_search', function(e) {
	var pmin = parseInt($('#min_search').val());
	var pmax = parseInt($('#max_search').val());
	if (pmax >= pmin) {
		setTimeout(function(){
  		filter();
	}, 600);			
	}
})

$('body').on('click', '.search', function(){
  		filter();
})

$('body').on('click','.ac_search', function() {
	$('input:checked').removeAttr('checked');
	$('#max_search').val(''); $('#min_search').val('');
	$('#sort').attr("sort","")
	filter();
});


function filter(page) {
	if ($('#filtry_okno').css('display') == 'block') {
	var open = 'opened';
	var scroll = $('#filtry_okno').scrollTop();
	}
	
	var search_term = $('#st').attr("search_term");
	/*
	var miasto = $("#miasto").attr("city");
	var galeria = $("#galeria").attr('galeria');
	*/
	
	var sort = $('#sort').attr("sort");
	
	var min = $('#min_search').val();
	var max = $('#max_search').val();
	var pmin = parseInt($('#min_search').val());
	var pmax = parseInt($('#max_search').val());
	var check_min = $('#min_search').is(":focus");
	var check_max = $('#max_search').is(":focus");
		
	/* var subs = [];
	$('#sub_check input:checked').each(function() {
    subs.push($(this).attr("value"))
	}); */
		
	var stores = []
	$('#store_check input:checked').each(function() {
    stores.push($(this).attr("value"));
	});
	
	var brands = [];
	$('#brand_check input:checked').each(function() {
    brands.push($(this).attr("value"))
	});
	
	var podkat = [];
	$('#podkat_check input:checked').each(function() {
    podkat.push($(this).attr("value"))
	});
	
	var selected = [];
	$('input[nt]:checked').each(function() {
	var value = $(this).attr('id');
    selected.push('#'+value); 
	});
	var sel = selected.join(",");
	
	/*
	var attrs = {}; 
	var valuesy = []; 
	$("input[at]:checked").each(function() {
		var title = $(this).attr("at");
		var attri = [];		
		var value = $(this).attr("value");
		valuesy.push(value);
		$('input[at='+title+']:checked').each(function() {
			var value = $(this).attr("value");
			attri.push(value);
		})		
		attrs[title] = attri
		})
	if (Object.keys(valuesy).length > 0) {var myJSON = JSON.stringify(valuesy)}	
	*/
	
	var stan = {
		st: search_term,
		stores: stores,
		brands: brands,
		podkat: podkat,
		page: page,
		action: "filter_search"
	};
	
if (history.state) {
	var haction = history.state.action;	
}

if (haction != stan.action) {	
	console.log("DODAŁEM DO HISTORII FILTER SEARCH")	
	history.pushState(stan, "", "/?q="+search_term+"/");
} else {
	console.log("NIC NIE ROBIE BO SA TAKIE SAME")	
}	
	
jQuery.ajax({
                 type : "GET",
                 url : global.ajax,
                 data : {
					 
					 action: "search",
					 
					 dev: check_device(),
					 
					 q: search_term,
					 					 
					 min: min,
					 max: max,
					 sort: sort,
					 page: page,
					 
					 store: stores,					 
					 brand: brands,					 
					 podkat: podkat
					 
					 /*
					 sub: subs,
					 c: miasto,
					 g: galeria,
					 attr: myJSON,
					 */
										 
						},
success: function(response) {                     
if (open == 'opened') {
$('#filtry_okno').show();
$('#filtry_okno').scrollTop(scroll);
}				
$('#ajax').html(response);
	
$(sel).prop('checked', true); /* OSOBNO ZAZNACZAMY SUB, STORE, BRAND - PO ID*/

/*
$.each(attrs, function(key, value) { 
	$.each(value, function(k, val) {
		$('input[value="'+val+'"]:checkbox').prop('checked', true);
	})
})
*/

if (check_device() == 'mobile') {
	if ($('input:checked').length > 0) {
		$('#filtry_on').html('FILTRY<br>AKTYWNE')} else {$('#filtry_on').html('')}	
	$('#button_wrapper').html('<button id="show_mobile_filters"><span class="icon-equalizer"></span></button>')
}
	
if (pmin > 0 && pmax > 0) {$('#max_search').val(max); $('#min_search').val(min)};		
if (sort !== null) {$('#sort').attr("sort",sort);}					 
if (sort == 'ASC') { $('#desc_search').prop('checked',false); $('#asc_search').prop('checked', true)}
if (sort == 'DESC') {$('#asc_search').prop('checked', false); $('#desc_search').prop('checked',true)}
							 
/* napisy(); */
filters_count();
faver_check_likes_onload();
	
if (open == 'opened') {
$('#filtry_okno').show();
$('#filtry_okno').scrollTop(scroll);
}		
	
if (check_min == true) {$('#min_search').focus()}
if (check_max == true) {$('#max_search').focus()}
	
return false;
					   
}})}