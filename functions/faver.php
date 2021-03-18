<?php

function faveronlogin() {

session_start();
global $wpdb;

if ($_SESSION['leonidas']) {

	if (isset($_SESSION['likes'])) {
		
		$sess_likes = $_SESSION['likes'];
		$exps = explode(",",$sess_likes);
		wp_send_json_success($exps);
		
	} else {
		
		$login = $_SESSION['leonidas'];
		$get = "SELECT liked FROM users WHERE email = '$login'";
		$do_get = $wpdb->get_col($wpdb->prepare($get,$get));
		$imp = implode($do_get);
		$expdb = explode(",",$imp);
				
			if ($imp !== '') {
				$_SESSION['likes'] = $imp;
				wp_send_json_success($expdb);	
			}
		}
}
	
wp_die();
}

add_action( 'wp_ajax_faveronlogin', 'faveronlogin' );
add_action( 'wp_ajax_nopriv_faveronlogin', 'faveronlogin' );

function favlike() {

session_start();
global $wpdb;
$id = $_POST['id'];
	
if ($_SESSION['leonidas']) {

	$login = $_SESSION['leonidas'];
	
	$dl_like = "SELECT liked FROM users WHERE email = '$login'";
	$dll = $wpdb->get_col($wpdb->prepare($dl_like,$dl_like));
	$impdll = implode($dll);
	
	if ($impdll !== '') {
		$expdll = explode(",",$impdll);
		$expdll[] = $id;
		$i = implode(",",$expdll);
	} else {
		$expdll = array();
		$expdll[] = $id;
		$i = implode($expdll);
	}

	$ul_like = "UPDATE users SET liked = '$i' WHERE email = '$login'";
	$ul_like_p = "UPDATE produkty SET likes = likes + 1 WHERE id = '$id'";
	
	$ull = $wpdb->query($wpdb->prepare($ul_like,$ul_like));
	$ull_p = $wpdb->query($wpdb->prepare($ul_like_p,$ul_like_p));
	
	if ($_SESSION['likes'] !== '') {
		$exps = explode(",",$_SESSION['likes']);
		$exps[] = $id;
		$imps = implode(",",$exps);

	} else {
		$exps = array();
		$exps[] = $id;
		$imps = implode($exps);
	}
	
	$_SESSION['likes'] = $imps;
	
	wp_send_json_success("logged");
}
	
wp_die();
}

add_action( 'wp_ajax_favlike', 'favlike' );
add_action( 'wp_ajax_nopriv_favlike', 'favlike' );

function favunlike() {

session_start();
global $wpdb;
$id = $_POST['id'];
	
if ($_SESSION['leonidas']) {

	$login = $_SESSION['leonidas'];
	
	$dl_like = "SELECT liked FROM users WHERE email = '$login'";
	$dll = $wpdb->get_col($wpdb->prepare($dl_like,$dl_like));
	$impdll = implode($dll);
	
	if ($impdll !== '') {
		$expdll = explode(",",$impdll);
		$key = array_search($id, $expdll);
		 unset($expdll[$key]);
		$i = implode(",",$expdll);
	} 

	$ul_like = "UPDATE users SET liked = '$i' WHERE email = '$login'";
	$ul_like_p = "UPDATE produkty SET likes = likes - 1 WHERE id = '$id'";
	
	$ull = $wpdb->query($wpdb->prepare($ul_like,$ul_like));
	$ull_p = $wpdb->query($wpdb->prepare($ul_like_p,$ul_like_p));
	
	if (isset($_SESSION['likes'])) {
		$exps = explode(",",$_SESSION['likes']);
		$keys = array_search($id, $exps);
		 unset($exps[$keys]);
		
		$imps = implode(",",$exps);
	} 
	
	$_SESSION['likes'] = $imps;

	wp_send_json_success("logged");
}
	
wp_die();
}

add_action( 'wp_ajax_favunlike', 'favunlike' );
add_action( 'wp_ajax_nopriv_favunlike', 'favunlike' );

?>