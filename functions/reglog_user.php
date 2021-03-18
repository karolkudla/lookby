<?php 

function cookie_check() {
	
	global $wpdb;
	if (isset($_COOKIE['tokenidas'])) {
		$cooks = $_COOKIE['tokenidas'];
		$arr = array();
		$arr = explode(',', $cooks);
				
		$expiry = "SELECT email,expiration,token FROM users WHERE id = '$arr[0]'";
		$sql = $wpdb->get_results($wpdb->prepare($expiry,$expiry));
		$json = json_decode(json_encode($sql,true), true);
	
		date_default_timezone_set('Europe/Warsaw');
		$date = date('m/d/Y h:i:s a', time());
		if ($date < $json[0][expiration]) {
			
			$tokens = $json[0][token];
			$un = unserialize($tokens);
			$newtoken = bin2hex(openssl_random_pseudo_bytes(25));
			if (($key = array_search($arr[1], $un)) !== false) {
    			$un[$key] = $newtoken;
			}
			$ser = serialize($un);

			$expiration = date('m/d/Y',strtotime('+30 days',strtotime($date))) . PHP_EOL;
			$new = "UPDATE users SET data_last='$date', token='$ser', expiration='$expiration' WHERE id='$arr[0]'";
			$new_it = $wpdb->query($wpdb->prepare($new,$new));
			
			$iditok = $arr[0].",".$newtoken;
			setcookie("tokenidas", $iditok, time() + (86400 * 30), "/");
			session_start();
			
			$_SESSION["leonidas"] = $json[0][email];
			$_SESSION["tokenidas"] = $newtoken;
			
			
		}
	}
	$city = $_COOKIE['lasvegas'];
	$login = $_SESSION['leonidas'];
	$a = array();
	$a[] = $city;
	$a[] = $login;
	
	wp_send_json_success($a);
	
wp_die();
}

add_action( 'wp_ajax_cookie_check', 'cookie_check' );
add_action( 'wp_ajax_nopriv_cookie_check', 'cookie_check' );

function reg_user() {

$device = $_SERVER["HTTP_USER_AGENT"];	
	
global $wpdb;
$regemail = $_POST['re'];
$regpass = $_POST['rp'];
$regcity = $_POST['rc'];

	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LeCuZUUAAAAAKIfsRTE7nnQ9dfesXUNPmJH7rtD';
    $recaptcha_response = $_POST['rec'];

    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
	
if (isset($regemail) && isset($regpass)) {

date_default_timezone_set('Europe/Warsaw');
$date = date('m/d/Y h:i:s a', time());
$info = array();

if (strpos($regemail,'@') !== FALSE) {
	
	$check_email_indb = "SELECT email FROM users WHERE email LIKE '$regemail'";
	$check_it = $wpdb->get_col($wpdb->prepare($check_email_indb,$check_email_indb));
	
		if ($regemail == implode($check_it)) {$info = 'duplicate';} else {
			$r = $recaptcha->score;
			if ($r >= 0) {
        		$hashPassword = password_hash($regpass,PASSWORD_BCRYPT);
				$token = bin2hex(openssl_random_pseudo_bytes(25));
				$tok_array[] = $token;
				$tok_json = serialize($tok_array);
				
	$new = "INSERT INTO users (email,pass,city,token,data_rej) VALUES ('$regemail','$hashPassword','$regcity','$tok_json','$date')";
	$new_it = $wpdb->query($wpdb->prepare($new,$new));
				
				$uid = "SELECT id FROM users WHERE email = '$regemail'";
				$guid = $wpdb->get_col($uid);
				$iguid = implode($guid);
				
				$iditok = $iguid.",".$token;
				setcookie("tokenidas", $iditok, time() + (86400 * 30), "/");
				setcookie("lasvegas", $regcity, time() + (86400 * 30), "/");
				$expiry = "UPDATE users SET expiration='$expiration' WHERE email='$regemail'";
				$expiry_add = $wpdb->query($wpdb->prepare($expiry,$expiry));
				
				session_start();
				$_SESSION["leonidas"] = $regemail;
				$_SESSION["tokenidas"] = $token;
				
				$info = array();
				$info[] = 'success';
				$info[] = $regemail;
				$info[] = $r;
    		} else {
				$info = array();
        		$info[] = 'badcap';
				$info[] = $r;
    		}
			
		}

} else {$info = 'bademail';}
	
wp_send_json_success($info);

}
	
wp_die();
}

add_action( 'wp_ajax_reg_user', 'reg_user' );
add_action( 'wp_ajax_nopriv_reg_user', 'reg_user' );

function log_user() {

$device = $_SERVER["HTTP_USER_AGENT"];	
$devices = array();
$devices[] = $device;
$dev = serialize($devices);
	
global $wpdb;

$logemail = $_POST['le'];
$logpass = $_POST['lp'];
	
if (isset($logemail) && isset($logpass)) {

date_default_timezone_set('Europe/Warsaw');
$date = date('m/d/Y h:i:s a', time());
$expiration = date('m/d/Y',strtotime('+30 days',strtotime($date))) . PHP_EOL;
$info = array();

if (strpos($logemail,'@') !== FALSE) {
	
	$check_email_indb = "SELECT id,email,pass,city,token FROM users WHERE email LIKE '$logemail'";	
	$check_it = $wpdb->get_results($wpdb->prepare($check_email_indb,$check_email_indb));
	$json = json_decode(json_encode($check_it,true), true);
	
	if ($json[0][email]) {
		
		if (password_verify($logpass,$json[0]['pass'])) {
			$token = bin2hex(openssl_random_pseudo_bytes(25));

				$tok_array = array();
				$uns = unserialize($json[0][token]);
				foreach ($uns as $u) {
					$tok_array[] = $u;
				}
				$tok_array[] = $token;
				$tok_json = serialize($tok_array);
			
			$new = "UPDATE users SET data_last='$date', token='$tok_json' WHERE email='$logemail'";
			$new_it = $wpdb->query($wpdb->prepare($new,$new));
			
			$city = $json[0][city];

				$iditok = $json[0][id].",".$token;
				setcookie("tokenidas", $iditok, time() + (86400 * 30), "/");
				setcookie("lasvegas", $city, time() + (86400 * 30), "/");
				$expiry = "UPDATE users SET expiration='$expiration' WHERE email='$logemail'";
				$expiry_add = $wpdb->query($wpdb->prepare($expiry,$expiry));
			
			session_start();
			$_SESSION["leonidas"] = $logemail;
			$_SESSION["tokenidas"] = $token;

					$info = array();
					$info[] = 'success';
					$info[] = $logemail;
			
		} else {$info = 'badpass';}
		
	} else {$info = 'noemail';}
	
} else {$info = 'bademail';}
	
wp_send_json_success($info);

}
	
wp_die();
}

add_action( 'wp_ajax_log_user', 'log_user' );
add_action( 'wp_ajax_nopriv_log_user', 'log_user' );
?>