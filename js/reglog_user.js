function cookie_check() {
	
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "cookie_check",

						},
                 success: function(response) {

				var miasto = response.data[0];
				if (miasto !== null) {
				$('#wyszukiwarka').prop("placeholder","Szukaj w mieście "+miasto+" ...")
				$('#naglowek').html('<div id="miasto" city="'+miasto+'">'+miasto+'');
				$('#mobile-city').html('<div class="acity">'+miasto+'</div>')				
				}
				var email = response.data[1];
				if (email) {$('#mobile-hello').html('Witaj, '+email)}
				if (email && check_device() == 'desktop') {$('#logged-info').html(email)}
		 		return false;
					   
                    }

})
	
}

$('body').on('click', '#register_getter', function() {

	var regemail = $('#register-email').val()
	var regpass = $('#register-password').val()
	var regcity = $('#city-selector-reg').val()
	var recaptcha = $('#recaptchaResponse').attr("value");

	if ($('#accept_reg').is(':checked')) {
	if ( regemail.length > 7 && regpass.length > 5 ) {
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "reg_user",
					 re: regemail,
					 rp: regpass,
					 rc: regcity,
					 rec: recaptcha
					 
						},
                 success: function(response) {

				var resp = response.data;
				
				if (resp == 'duplicate') {
					$('#register-email').css("background-color", "#f14e4ea6")
					$('#register-email-info').html('<font color="red">Ten email jest już zarejestrowany!</font>')
					}
				if (resp == 'bademail') {
					$('#register-email').css("background-color", "#f14e4ea6")
					$('#register-email-info').html('<font color="red">To nie jest email, złotko!</font>')
					}	
				if (resp[0] == 'badcap') {
					$('#register_getter').html('<span style="color:yellow;">Wyglądasz na bota!</span>');
					console.log(resp[1]);
				}
					
				if (resp[0] == 'success') {
					console.log(resp[2]);
					$('#lform').hide()				
					$('#login_overlay').hide();
					user_acc()
					if (check_device() == 'desktop') {$('#logged-info').html(resp[1])}
					 $('#mobile-city').html('<div class="acity">'+regcity+'</div>')
					$('#mobile-hello').html('Witaj, '+regemail)
				}
				
		 		return false;
					   
                    }
})} else {$('#register-email-info').html('<font color="red">Podaj prawidłowy email i hasło dłuższe niż 5 znaków./font>'); return false;}
	
	} else {$('#ar_lab').css("color","red")}
	
	})

$('body').on('click', '#login_getter', function() {

	var logemail = $('#login-email').val()
	var logpass = $('#login-password').val()
	var remember = $('#remember_me').is(':checked');
		
	if (logemail.length > 7 && logpass.length > 5) {
	jQuery.ajax({
                 type : "POST",
                 url : global.ajax,
                 data : {
					 
					 action: "log_user",
					 le: logemail,
					 lp: logpass,
					 rem: remember
					 
						},
                 success: function(response) {
				
				var resp = response.data;	 
				if (resp == 'bademail') {
					$('#login-email').css("background-color", "#f14e4ea6")
					$('#login-email-info').html('<font color="red">To nie jest email, złotko!</font>')
				}		 
					 
				if (resp == 'noemail') {
					$('#login-email').css("background-color", "#f14e4ea6")
					$('#login-email-info').html('<font color="red">Brak takiego konta!</font>')
				}	 	 
					 
				if (resp == 'badpass') {
					$('#login-password').css("background-color", "#f14e4ea6")
					$('#login-password-info').html('<font color="red">Złe hasło!</font>')
				}	 
					 
				if (resp[0] == 'success') {
					$('#lform').hide()
					$('#login_overlay').hide()
					if (check_device() == 'desktop') {$('#logged-info').html(resp[1])}
					user_acc()				 
					$('#mobile-hello').html('Witaj, '+logemail)
				} 
					return false; 
		 		
                    }
})}	else {
		
		$('#login-email-info').html('<font color="red">Za mało znaków!</font>'); return false;	
	
	}})

