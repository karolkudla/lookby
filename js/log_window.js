function log_window() {

	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "log_window",
					 
						},
                 success: function(response) { 
					 
				$('#login_overlay').fadeIn("slow");
				$('#lform').show();	
				$('#lform').html(response);
							
				

		 		return false;
					   
                    }
})
	
}