<?php

function bb_call() {
$db = $_POST['ch'];	
$sklep_id = $_POST['sklep_id'];
$katp = $_POST['kat'];
$sklep = $_POST['name'];
$start = $_POST['start'];
$stop = $start+500;	
$max = $_POST['max'];
	
	$filename = $_SERVER['DOCUMENT_ROOT'].'/datafeeds/buybox/'.$sklep.'.json';	
	require_once($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php"); 
	$file = $_SERVER['DOCUMENT_ROOT'].'/datafeeds/tradedoubler/'.$sklep.'.json';
	$jsonStream =  \JsonMachine\JsonMachine::fromFile($file, "/products");

include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/lookby/api/api_helper.php';		

$id=0;
foreach ($jsonStream as $i => $data) {  
		if (($i >= $start) && ($i <= $stop)) {
			
			$id++;
			$kk = plik($katp);
			$title = '';
			$kat = '';
			$brand = '';
			$img_big = '';
			$pln = '';
			$desc = '';
			$urli = '';
			
			$m = round(microtime(true) * 1000);
			$tabela['flagi'][$m][$title][0] = 'Wchodzę do LOOPa z produktem '.$title; 
			include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/lookby/api/loop.php';
				
		}
}  

$tabela['start'] = $start;
$tabela['max'] = $max;
$tabela['nazwa'] = $sklep;
$tabela['sklep_id'] = $sklep_id;
$tabela['kat'] = $katp;
	
wp_send_json_success($tabela);
	
wp_die();
}

add_action( 'wp_ajax_bb_call', 'bb_call' );
add_action( 'wp_ajax_nopriv_bb_call', 'bb_call' );

?>