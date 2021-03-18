function banner(miasto,galeria) {

jQuery.ajax({
                 type : "GET",
                 url : global.ajax,
                 data : {
					 
					 action: "banner",
					 c: miasto,
					 g: galeria,
					 
						},
success: function(response) {
	$("#banner").attr("src",response)
	return false;					   
                }
});   		
}
