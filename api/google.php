<?php
function google() {

$gid = $_POST['gid'];
$file = $_POST['file'];
	
$path = "https://dl.getdropbox.com/s/".$gid."/".$file;	
copy($path, $_SERVER['DOCUMENT_ROOT'].'/datafeeds/keys/'.$file);
	
echo "Sukces";
	
wp_die();
}

add_action( 'wp_ajax_google', 'google' );
add_action( 'wp_ajax_nopriv_google', 'google' );

function del_db() {

global $wpdb;
$del = 'TRUNCATE TABLE produkty';
$do = $wpdb->query($del);
	
echo "Sukces";
	
wp_die();
}

add_action( 'wp_ajax_del_db', 'del_db' );
add_action( 'wp_ajax_nopriv_del_db', 'del_db' );

function counter() {
	$counti = "SELECT COUNT(*) FROM produkty";
	global $wpdb;
	$dol = $wpdb->get_var($counti);	
	echo $dol;
	wp_die();
}

add_action( 'wp_ajax_counter', 'counter' );
add_action( 'wp_ajax_nopriv_counter', 'counter' );

?>