<?php
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

function ja_global_enqueues() {
	$ver = rand();
	wp_enqueue_style(
		'style',
		get_template_directory_uri() . '/style.min.css',
		array(),
		$ver
	);
	
	wp_enqueue_style(
		'style_mobile',
		get_template_directory_uri() . '/style_mobile.css',
		array(),
		$ver
	);
	
	wp_enqueue_script(
		'api',
		get_template_directory_uri() . '/api/api.js',
		array( 'jquery' ),
		$ver,
		true
	);
	
	wp_enqueue_script(
		'full_auto',
		get_template_directory_uri() . '/api/full_auto.js',
		array( 'jquery' ),
		$ver,
		true
	);	
	
	wp_enqueue_script(
		'global',
		get_template_directory_uri() . '/js/suggestions.js',
		array( 'jquery' ),
		$ver,
		true
	);
	
	wp_enqueue_script(
		'faver',
		get_template_directory_uri() . '/js/faver.js',
		array( 'jquery' ),
		$ver,
		true
	);
	
	wp_enqueue_script(
		'log_window',
		get_template_directory_uri() . '/js/log_window.js',
		array( 'jquery' ),
		$ver,
		true
	);
	
	wp_enqueue_script(
		'reglog_user',
		get_template_directory_uri() . '/js/reglog_user.js',
		array( 'jquery' ),
		$ver,
		true
	);
	
	wp_enqueue_script(
		'user_acc',
		get_template_directory_uri() . '/js/user_acc.js',
		array( 'jquery' ),
		$ver,
		true
	);
	
	wp_enqueue_script(
		'search',
		get_template_directory_uri() . '/js/search.js',
		array( 'jquery' ),
		$ver,
		true
	);
	
	wp_enqueue_script(
		'filter',
		get_template_directory_uri() . '/js/filter_search.js',
		array( 'jquery' ),
		$ver,
		true
	);
	
	wp_enqueue_script(
		'city_click',
		get_template_directory_uri() . '/js/city_click.js',
		array( 'jquery' ),
		$ver,
		true
	);
	
	wp_enqueue_script(
		'link_ajax',
		get_template_directory_uri() . '/js/link_ajax.js',
		array( 'jquery' ),
		$ver,
		true
	);
		
	wp_enqueue_script(
		'window_subtitles',
		get_template_directory_uri() . '/js/window_subtitles.js',
		array( 'jquery' ),
		$ver,
		true
	);
	
	wp_enqueue_script(
		'gallery_list',
		get_template_directory_uri() . '/js/gallery_list.js',
		array( 'jquery' ),
		$ver,
		true
	);
	
	wp_enqueue_script(
		'city_input',
		get_template_directory_uri() . '/js/city_input.js',
		array( 'jquery' ),
		$ver,
		true
	);	
			
	wp_enqueue_script(
		'columns_divide',
		get_template_directory_uri() . '/js/columns_divide.js',
		array( 'jquery' ),
		$ver,
		true
	);	
	
	wp_enqueue_script(
		'klikacze',
		get_template_directory_uri() . '/js/clicking.js',
		array( 'jquery' ),
		$ver,
		true
	);	
	
	wp_enqueue_script(
		'banner',
		get_template_directory_uri() . '/js/banner.js',
		array( 'jquery' ),
		$ver,
		true
	);	
	
	wp_enqueue_script(
		'history',
		get_template_directory_uri() . '/js/history.js',
		array( 'jquery' ),
		$ver,
		true
	);	
	
	
				
	wp_localize_script(
		'global',
		'global',
		array(
			'ajax' => admin_url( 'admin-ajax.php' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'ja_global_enqueues' );

require 'functions/search_new.php';
require 'functions/filter_sub.php';
require 'functions/okno.php';
require 'functions/pokaz_miasta.php';
require 'functions/suggestions.php';
require 'functions/most_faved.php';
require 'functions/banner_list.php';
require 'functions/reglog_user.php';
require 'functions/user_acc.php';
require 'functions/logout.php';
require 'functions/faver.php';
require 'functions/log_window.php';

require 'api/sources/convertiser.php';
require 'api/sources/awin.php';
require 'api/sources/tradedoubler.php';
require 'api/sources/netsales.php';
require 'api/sources/buybox.php';
require 'api/sources/tradetracker.php';

require 'api/google.php';
require 'api/menu.php';
require 'api/most_faved.php';

function my_deregister_scripts(){
 wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

show_admin_bar(false);

remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
remove_action( 'admin_print_styles', 'print_emoji_styles' );