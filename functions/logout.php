<?php
function logout_onclose() {

	/* JEŻELI JEST CIASTKO Z TOKENEM TO NIC NIE RÓB */
	/* JEŻELI NIE MA CIASTKA, WEŹ TOKEN Z SESJI I WYKASUJ GO Z BAZY */
	/* ALE RÓB TO TYLKO NA WYJŚCIU, A NIE PODCZAS RELOADU */
	
}

add_action( 'wp_ajax_logout_onclose', 'logout_onclose' );
add_action( 'wp_ajax_nopriv_logout_onclose', 'logout_onclose' );

function logout() {
	
	global $wpdb;
	session_start();
	
	$logemail = $_SESSION["leonidas"];
	$logtoken = $_SESSION["tokenidas"];
	
	$get_tokens = "SELECT token FROM users WHERE email = '$logemail'";
	$get = $wpdb->get_col($wpdb->prepare($get_tokens,$get_tokens));
	$imp = implode($get);	
	$un = unserialize($imp);
	
	if (($key = array_search($logtoken, $un)) !== false) {
    unset($un[$key]);
	}
	
	$new_tokens = array();
	foreach ($un as $u) {
		$new_tokens[] = $u;
	}
	
	$ser = serialize($new_tokens);
	
	$del_token = "UPDATE users SET token='$ser' WHERE email='$logemail'";	
	$del_it = $wpdb->query($wpdb->prepare($del_token,$del_token));
		
	if (isset($_COOKIE['tokenidas'])) {
    unset($_COOKIE['tokenidas']);
    setcookie('tokenidas', '', time() - 3600, '/'); // empty value and old timestamp
	}

	session_unset(); 
	session_destroy(); 
	
	die();
}	

add_action( 'wp_ajax_logout', 'logout' );
add_action( 'wp_ajax_nopriv_logout', 'logout' );
?>