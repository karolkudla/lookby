<?php

function api_convertiser() {	
	
global $wpdb;
$db = $_POST['ch'];	
$api_id = implode(array($_POST['api_id']));
$page = implode(array($_POST['page']));
$katp = implode(array($_POST['kat']));
$sklep = $_POST['name'];

$url = 'https://api.convertiser.com//publisher/products/v2/?key=6ece142bf40911e606cc3eff9ca8e0d7cbb88d40';

$data = '{
    "filters": [
        {"offer_id": {"lookup": "exact", "value": "'.$api_id.'"}}
    ],
    "page": '.$page.',
    "page_size": 500
}';

$response = wp_remote_post( $url, array(
    'body'    => $data,
    'headers' => array(
        'Authorization' => 'Token Fbxgl258dLZ82ee0pum2dTRHCwGV8Z',
		'content-type' => 'application/json',
    ),
) );	

$dec = json_decode($response[body],true);	
$c = $dec['pagination']['next_page'];
$max =  $dec['count'];

include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/lookby/api/api_helper.php';	
	
foreach ($dec[data] as $d) {
	
	$kk = plik($katp);
	$id = $d[id];
	$kat = $d[product_type];
	$title = $d[title];
	$store = $d[offer];
	$brand = $d[brand];
	$pln1 =  ltrim($d[sale_price],"PLN");
	$pln2 = ltrim($d[price],"PLN");
	$pln = $pln1.$pln2;
	$desc = $d[description];
	$img_small = $d[images][thumb_180];
	$img_big = $d[image_link];
	$urli = $d[link];
		
	$m = round(microtime(true) * 1000);
	$tabela['flagi'][$m][$title][0] = 'Wchodzę do LOOPa z produktem '.$title; 
	include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/lookby/api/loop.php';
	
	get_all($kat);
	
} /* koniec pętli produktów */
		
$tabela[page] = $c;
$tabela[id] = $api_id;	
$tabela[maxi] = $max;
$tabela[kat] = $katp;
wp_send_json_success($tabela);
	
wp_die();
}

add_action( 'wp_ajax_api_convertiser', 'api_convertiser' );
add_action( 'wp_ajax_nopriv_api_convertiser', 'api_convertiser' );
?>