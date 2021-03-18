<?php 
function log_window() {
?>

<div id="okienko_tytul">
	<div id="menu_logo_register">		
<div id="logo"><img src="https://<?php echo $_SERVER['HTTP_HOST']?>/img/black.svg"></div>
<div id="slogan">Jedno miejsce.<br>Wszystkie galerie.</div>		
</div>
	<div id="close_register" class="icon-cross"></div>
</div>

<div id="lform-wrapper">
	
	<div id="register">
		<div class="lform-word">Zarejestruj się</div>
		<div class="ml">w 5 sekund</div>
		<div class="inner-wrapper">
				<form id="register_form">
				<div class="ml" id="register-email-info">E-mail:</div>
				<div class="pass-container">
				<input class="lform lform-login" id="register-email">
				</div>
				<div class="ml" id="register-password-info">Hasło:</div>
				<div class="pass-container">
					<input class="lform lform-pass" id="register-password" type="password">
					<div id="eye-container"><span class="icon-eye" id="reg-eye"></span></div>
				</div>
				<div class="ml">Twoje miasto:</div>	
					<select id="city-selector-reg">
 					 	<?php 
						$root = $_SERVER['DOCUMENT_ROOT'];
						require $root.'/city-selector.php';
						?>
					</select>
				<div class="lw-ch">
					<input type="checkbox" class="form-checkbox" id="accept_reg">
					<label for="accept_reg" id="ar_lab">Akceptuję regulamin</label>
				</div>
				<button id="register_getter">
					Rejestruj mnie
				</button>
				</form>
		</div>		
	</div>

	<div id="login">
		<div class="lform-word">Zaloguj się</div>
		<div class="ml">w 3 sekundy</div>
		<div class="inner-wrapper">
				<form id="login_form">
				<div class="ml" id="login-email-info">E-mail:</div>
				<div class="pass-container">
				<input class="lform lform-login" id="login-email">
				</div>
				<div class="ml" id="login-password-info">Hasło:</div>
				<div class="pass-container">
					<input class="lform lform-pass" id="login-password" type="password">
					<div id="eye-container"><span class="icon-eye" id="log-eye"></span></div>
				</div>				
				<button id="login_getter">
					Loguj mnie
				</button>
				</form>		
		</div>		
	</div>
	
</div>

<div>
	<div class="lform-slogan">aby móc tworzyć własne listy zakupowe ... </div>
</div>

<?php	
wp_die();
}

add_action( 'wp_ajax_log_window', 'log_window' );
add_action( 'wp_ajax_nopriv_log_window', 'log_window' );
?>