$('body').on('click', '.asub, .astore, .abrand, .acity, .agal', function() {
	$(window).scrollTop( 0 ) /* TUTAJ NALEŻY NADAĆ DO WYSOKOŚCI FILTRÓW A NIE NA TOP 0 */	
})

$('body').on('click', '#next_sub', function() {
	
	var asub = $('#sub').attr("sub");
	var menu = $('#v_menu').attr("menu");
	var r2 = $('#v_r2').attr("r2");
	var plec = $('#v_plec').attr("plec");
	var page = $("#here").text();
	var next = parseInt(page) + 1;
	
	filter_sub(asub,menu,r2,plec,next)
	
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

$('body').on('click', '#prev_sub', function() {

	var asub = $('#sub').attr("sub");
	var menu = $('#v_menu').attr("menu");
	var r2 = $('#v_r2').attr("r2");
	var plec = $('#v_plec').attr("plec");
	var page = $("#here").text();
	var prev = parseInt(page) - 1;
	
	filter_sub(asub,menu,r2,plec,prev)

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

$('body').on('click', '#sib_sub', function(e) {

	var asub = $('#sub').attr("sub");
	var menu = $('#v_menu').attr("menu");
	var r2 = $('#v_r2').attr("r2");
	var plec = $('#v_plec').attr("plec");
	var page = $("#here").text();
	
	filter_sub(asub,menu,r2,plec,page)

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

$('body').on('click', '#asc_sub', function() {
	
	var asub = $('#sub').attr("sub");
	var menu = $('#v_menu').attr("menu");
	var r2 = $('#v_r2').attr("r2");
	var plec = $('#v_plec').attr("plec");
	
	$('#sort').attr("sort","ASC")
	$('#desc_sub').prop('checked',false)
	$('#asc_sub').prop('checked', true)
	
	filter_sub(asub,menu,r2,plec);
});

$('body').on('click', '#desc_sub', function() {

	var asub = $('#sub').attr("sub");
	var menu = $('#v_menu').attr("menu");
	var r2 = $('#v_r2').attr("r2");
	var plec = $('#v_plec').attr("plec");
	
	$('#sort').attr("sort","DESC")
	$('#asc_sub').prop('checked', false); 
	$('#desc_sub').prop('checked',true);
	
	filter_sub(asub,menu,r2,plec);
});

$('body').on('input', '#min_sub, #max_sub', function() {

	var asub = $('#sub').attr("sub");
	var menu = $('#v_menu').attr("menu");
	var r2 = $('#v_r2').attr("r2");
	var plec = $('#v_plec').attr("plec");
	var pmin = parseInt($('#min_sub').val());
	var pmax = parseInt($('#max_sub').val());
		
	if (pmax >= pmin) {
		setTimeout(function(){
  			filter_sub(asub,menu,r2,plec);
	}, 600);			
	}
})

$('.asub').click(function() {
	
	$('input:checked').prop("checked",false)
	$('#sort').attr("sort","")
	$( "#asc_sub" ).prop( "checked", true );
	$('.form-control').val('')
	
		var asub = $(this).text()
		var menu = $(this).attr("menu");
		var r2 = $(this).attr("r2");
		var plec = $(this).attr("plec");
	
	filter_sub(asub, menu, r2, plec);
});

$('body').on('click', '.sub', function(e) {

	var asub = $('#sub').attr("sub");
	var menu = $('#v_menu').attr("menu");
	var r2 = $('#v_r2').attr("r2");
	var plec = $('#v_plec').attr("plec");
		
	filter_sub(asub,menu,r2,plec);
})

$('body').on('click','.ac_sub', function() {
	
	var asub = $('#sub').attr("sub");
	var menu = $('#v_menu').attr("menu");
	var r2 = $('#v_r2').attr("r2");
	var plec = $('#v_plec').attr("plec");
	
	$('input:checked').removeAttr('checked');
	$('#max_sub').val(''); 
	$('#min_sub').val('');
	$('#sort').attr("sort","")

	filter_sub(asub, menu, r2, plec);
});


function filter_sub(asub, menu, r2, plec, page) {
	
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
	
	/*
	var miasto = $("#miasto").attr("city");
	var galeria = $("#galeria").attr('galeria');
	*/
		
	if ($('#filtry_okno').css('display') == 'block') {
		var open = 'opened';
		var scroll = $('#filtry_okno').scrollTop();
	}
		
	var check_min = $('#min_sub').is(":focus");
	var check_max = $('#max_sub').is(":focus");
	
	var sort = $('#sort').attr("sort");	
	var min = $('#min_sub').val();
	var max = $('#max_sub').val();
	var pmin = parseInt($('#min_sub').val());
	var pmax = parseInt($('#max_sub').val());	
	
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
    selected.push('#'+$(this).attr('id'));
	});
	var sel = selected.join(",");
			
	$('#mostfaved-wrapper').hide();
	
	var stan = {
		asub: asub,
		menu: menu,
		r2: r2,
		plec: plec,
		stores: stores,
		brands: brands,
		podkat: podkat,
		page: page,
		action: "sub"
	};
	
	var rep1 = r2.replace(/ /g,"-");
	var rep2 = asub.replace(/ /g,"-");

if (history.state) {
	var haction = history.state.action;	
}

if (haction != stan.action) {	
	console.log("DODAŁEM DO HISTORII FILTER SUB")
	history.pushState(stan, "", "/"+rep1+"/"+rep2+"/");
} else {
	console.log("NIC NIE ROBIE BO SA TAKIE SAME")	
}	
	
	jQuery.ajax({
                 type : "GET",
                 url : global.ajax,
                 data : {
					 
					 action: "filter_sub",
					 
					 dev: check_device(),
					 
					 sub: asub,					 
					 min: min,
					 max: max,
					 sort: sort,					 
					 page: page,					 
					 store: stores,
					 brand: brands,
					 podkat: podkat,					 
					 menu: menu,
					 r2: r2,
					 plec: plec
					 
					 /*
					 c: miasto,
					 g: galeria,
					 attr: myJSON,
					 */
					 
						},
                 success: function(response) {
					 
$(".autocomplete-suggestions").hide();	
$('#ajax').html(response);					 
									 
$(sel).prop('checked', true); /* OSOBNO ZAZNACZAMY SUB, STORE, BRAND - PO ID*/
										 
var  ip = parseInt($('#ip').text())	

	if (check_device() == 'mobile' && ip > 0) {
		$('#button_wrapper').html('<button id="show_mobile_filters"><span class="icon-equalizer"></span></button>')	
	if ($('input:checked').length > 0) {
		$('#filtry_on').html('FILTRY<br>AKTYWNE')
	} else {
		$('#filtry_on').html('')
	}	
}				 
					 
if (pmin > 0 && pmax > 0) {$('#max_sub').val(max); $('#min_sub').val(min)};
if (sort !== null) {$('#sort').attr("sort",sort);}
if (sort == 'ASC') { $('#desc_sub').prop('checked',false); $('#asc_sub').prop('checked', true)}
if (sort == 'DESC') {$('#asc_sub').prop('checked', false); $('#desc_sub').prop('checked',true)} 
					 
							 
if (open == 'opened') {
	$('#filtry_okno').show();
	$('#filtry_okno').scrollTop(scroll);
}	

if (check_min == true) {$('#min_search').focus()}
if (check_max == true) {$('#max_search').focus()}

filters_count();
faver_check_likes_onload();					 
					 
return false;
					 
/*
$.each(attrs, function(key, value) { 
	$.each(value, function(k, val) {
		$('input[value="'+val+'"]:checkbox').prop('checked', true);
	})
})					 
*/						 
					   
                    }
});   
};
