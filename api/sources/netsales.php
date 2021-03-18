<?php

function ns_call() {
$db = $_POST['ch'];	
$sklep_id = $_POST['sklep_id'];
$katp = $_POST['kat'];
$sklep = $_POST['name'];
$start = $_POST['start'];
$stop = $start+500;	
$max = $_POST['max'];
	
$filename = $_SERVER['DOCUMENT_ROOT'].'/datafeeds/netsales/'.$sklep.'.json';

if (file_exists($filename)) {
  
} else {
	if ($sklep_id == 'sp') {
	
	$path = "https://export.system.netsalesmedia.pl/7a1da685-f92b-4988-b8a3-7a1151db69bc/api/productdataexport_1731?pid=469475&format=json&columns=Brand_text,CategoryName_text,CategoryPathAsString_text,custom1_text,DiscountedPrice_text,MID_text,PID_text,ProductDescription_text,ProductID_text,ProductImageMediumURL_text,ProductName_text,ProductPriceCurrency_text,ProductPrice_text,ProductSKU_text,ProductURL_text,StockAvailability_text,WasPrice_text";
	}
	
	if ($sklep_id == 'mac') {
		
	$path = "https://export.system.netsalesmedia.pl/7a1da685-f92b-4988-b8a3-7a1151db69bc/api/productdataexport_1739?pid=469475&format=json&columns=description_text,g:id_text,g:image_link_text,g:price_text,g:size_text,link_text,title_text";
		
	}	
	copy($path, $_SERVER['DOCUMENT_ROOT'].'/datafeeds/netsales/'.$sklep.'.json');	
}	
	

require_once($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php"); 
$file = $_SERVER['DOCUMENT_ROOT'].'/datafeeds/netsales/'.$sklep.'.json';

$jsonStream =  \JsonMachine\JsonMachine::fromFile($file, "/result_set");

include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/lookby/api/api_helper.php';		

$id=0;
foreach ($jsonStream as $i => $data) {  
	
		if ($sklep_id == 'mac') {		
			$title = $data[title_text];
			$kat = '';
			$brand = '';
			$img_big = $data['g:image_link_text'];
			$pln = '';
			$desc = $data[description_text];
			$urli = $data[link_text];		
		}
	
		if ($sklep_id == 'sp') {
			$title = $data[ProductName_text];
			$kat = $data[CategoryPathAsString_text];
			$brand = '';
			$img_big = $data[ProductImageMediumURL_text];
			$pln = $data[ProductPrice_text];
			$desc = $data[ProductDescription_text];
			$urli = $data[ProductURL_text];				
		}
	
		if (($i >= $start) && ($i <= $stop)) {
			
			$id++;
			$kk = plik($katp);
				
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

add_action( 'wp_ajax_ns_call', 'ns_call' );
add_action( 'wp_ajax_nopriv_ns_call', 'ns_call' );

?>