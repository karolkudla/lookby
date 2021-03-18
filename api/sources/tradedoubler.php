<?php

function td_call() {
$db = $_POST['ch'];	
$sklep_id = $_POST['sklep_id'];
$katp = $_POST['kat'];
$sklep = $_POST['name'];
$start = $_POST['start'];
$stop = $start+500;	
$max = $_POST['max'];
	
$filename = $_SERVER['DOCUMENT_ROOT'].'/datafeeds/tradedoubler/'.$sklep.'.json';

if (file_exists($filename)) {
  
} else {
	$path = "http://api.tradedoubler.com/1.0/productsUnlimited.json;fid=".$sklep_id."?token=11F661FAC20F39E41693D95428AA0374E1C7FE80";
	copy($path, $_SERVER['DOCUMENT_ROOT'].'/datafeeds/tradedoubler/'.$sklep.'.json');	
}	
	
require_once($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php"); 
$file = $_SERVER['DOCUMENT_ROOT'].'/datafeeds/tradedoubler/'.$sklep.'.json';

$jsonStream =  \JsonMachine\JsonMachine::fromFile($file, "/products");

include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/lookby/api/api_helper.php';		

$id=0;
foreach ($jsonStream as $i => $data) {  
		if (($i >= $start) && ($i <= $stop)) {
			
			$id++;
			$kk = plik($katp);
			$title = $data[name];
			$kat = $data[categories][0][name];
			
				if ($sklep == 'Sferis') {
					foreach ($data[fields] as  $f) {
						if (mb_stripos($f[name],'Producent') !== FALSE) {
							$brand = $f[value];
						}
					}					
				} else {
					$brand = $data[brand];
				}
			
			$img_big = $data[productImage][url];
			$pln = $data[offers][0][priceHistory][0][price][value];
			$desc = $data[description];
			$urli = $data[offers][0][productUrl];
			
			$m = round(microtime(true) * 1000);
			$tabela['flagi'][$m][$title][0] = 'Wchodzę do LOOPa z produktem '.$title; 
			include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/lookby/api/loop.php';
			
			
			if ($title == '') {
				$tabela['puste'][] = 'PUSTY TITEL: '.$title;
			}
			get_all($kat);
				
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

add_action( 'wp_ajax_td_call', 'td_call' );
add_action( 'wp_ajax_nopriv_td_call', 'td_call' );

?>