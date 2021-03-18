<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php"); 
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

function awin_call() {

$db = $_POST['ch'];	
$begin = $_POST['b'];	
$max = $_POST['max'];	
$katp = $_POST['kat'];
$store = $_POST['sklep_id'];
$sklep = $_POST['name'];

if ($sklep == "PEEKCLOPPENBURG") {
	$lang = 'en';
} else {
	$lang = 'pl';
}
	
$columns = 'product_name,merchant_category,merchant_product_category_path,brand_name,aw_image_url,search_price,description,aw_deep_link';
	
$filename = $_SERVER['DOCUMENT_ROOT'].'/datafeeds/awin/'.$store.'.csv';

if (file_exists($filename)) {
} else {
	
copy("https://productdata.awin.com/datafeed/download/apikey/6d7abad02c0fc9825f68ffcef219deeb/language/".$lang."/fid/".$store."/columns/".$columns."/format/csv/delimiter/%3B/compression/zip/", $_SERVER['DOCUMENT_ROOT'].'/datafeeds/awin/'.$store.'.csv.zip');
	
$zip = new ZipArchive;
if ($zip->open($_SERVER['DOCUMENT_ROOT'].'/datafeeds/awin/'.$store.'.csv.zip') === TRUE) {
    $zip->extractTo($_SERVER['DOCUMENT_ROOT'].'/datafeeds/awin/');   
	/*$filename = $zip->getNameIndex(0);*/
	$zip->close();
	unlink($_SERVER['DOCUMENT_ROOT'].'/datafeeds/awin/'.$store.'.csv.zip');
} else {
    $tabela['blad'] = "Blad";
};
	
rename($_SERVER['DOCUMENT_ROOT'].'/datafeeds/awin/datafeed_617903.csv',$_SERVER['DOCUMENT_ROOT'].'/datafeeds/awin/'.$store.'.csv');	
	
}


$reader = ReaderEntityFactory::createReaderFromFile($filename);
	$reader->setFieldDelimiter(';');
	$reader->setFieldEnclosure('"');
$reader->open($filename);

$line = 0;
foreach ($reader->getSheetIterator() as $sheet) {
    foreach ($sheet->getRowIterator() as $rowNumber => $row) {
		if ($rowNumber > $begin) {
        	$cells = $row->getCells();
				$tabela[$line][] = $cells[0]->getValue();
				$tabela[$line][] = $cells[1]->getValue();
				$tabela[$line][] = $cells[2]->getValue();
				$tabela[$line][] = $cells[3]->getValue();
				$tabela[$line][] = $cells[4]->getValue();
				$tabela[$line][] = $cells[5]->getValue();
				$tabela[$line][] = $cells[6]->getValue();
				$tabela[$line][] = $cells[7]->getValue();			
			$line++;
			if ($line == 500) {break 2;};
		}
    }
}

$reader->close();

include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/lookby/api/api_helper.php';		
	
$id = 0;	
foreach ($tabela as $linia) {
	
		$id++;
		$kk = plik($katp);
		$title = $linia[0];
		$kat = 	$linia[1]." ".$linia[2];
		$brand = $linia[3];
		$img_big = str_replace("200","1200",$linia[4]);
		$img_big = str_replace("&t=letterbox","",$img_big);
		$pln =  $linia[5];
		$desc = $linia[6];
		$urli = $linia[7];
	
		$m = round(microtime(true) * 1000);
		$tabela['flagi'][$m][$title][0] = 'Wchodzę do LOOPa z produktem '.$title; 
		include $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/lookby/api/loop.php';
	
		if ($title == '') {
		$tabela['puste'][] = 'PUSTY TITEL: '.$title;
		}
		get_all($kat);
	
}

$tabela['begin'] = $begin+500;
$tabela['max'] = $max;
$tabela['store'] = $store;
$tabela['kat'] = $katp;
	
wp_send_json_success($tabela);
	
wp_die();
}

add_action( 'wp_ajax_awin_call', 'awin_call' );
add_action( 'wp_ajax_nopriv_awin_call', 'awin_call' );

?>