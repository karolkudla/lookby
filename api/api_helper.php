<?php
function plik($katp) {	

$file = $_SERVER['DOCUMENT_ROOT']."/datafeeds/keys/".$katp.".csv";
$dl = array_map('str_getcsv', file($file));	

foreach ($dl as $key => $value) {
	$a[] = explode(";",$value[0]);
}

foreach ($a as $key => $arrays) {
	$kk[1][$key][] = $arrays[0];
	$kk[1][$key][] = $arrays[1];
	$kk[1][$key][] = $arrays[2];
	$kk[1][$key][] = $arrays[3];
	$kk[1][$key][] = $arrays[4];
	$kk[1][$key][] = $arrays[5];
}
	
foreach ($a as $key => $arrays) {
	$kk[0][$key][] = $arrays[6];
	$kk[0][$key][] = $arrays[7];
	$kk[0][$key][] = $arrays[8];
}
	
foreach ($a as $key => $arrays) {
	$kk[2][$key][] = $arrays[9];
	$kk[2][$key][] = $arrays[10];
	$kk[2][$key][] = $arrays[11];
	$kk[2][$key][] = $arrays[12];
	$kk[2][$key][] = $arrays[13];
}	
	return $kk;
}
	
	function sex($kat,$title,$brand) { /* dodaj tutaj title */
/* w zależności jakie słowo znajdzie w starej kategorii */		
		if (preg_match('/\b(ona)\b/'."i", $kat)) {
			return 'Kobieta';
		}
		
		if (preg_match('/\b(on)\b/'."i", $kat)) {
			return 'Mężczyzna';
		}
	
		if (mb_stripos($kat,'chłop') !== false) {
			return 'Chłopiec';
		}
	
		if (mb_stripos($kat,'dziew') !== false) {
			return 'Dziewczynka';
		}
		
		if (mb_stripos($kat,'kid') !== false) {
			return 'Dziecko';
		}
	
		if (mb_stripos($kat,'niego') !== false) {
			return 'Mężczyzna';
		}
	
		if (mb_stripos($kat,'mężczy') !== false) {
			return 'Mężczyzna';
		}
		
		if (mb_stripos($kat,'męsk') !== false) {
			return 'Mężczyzna';
		}
		
		if (mb_stripos($kat,'damsk') !== false) {
			return 'Kobieta';
		}
		
		if (mb_stripos($kat,'men') !== false) {
			return 'Mężczyzna';
		}
		
		if (mb_stripos($kat,'unisex') !== false) {
			return 'Unisex';
		}
		
		if (mb_stripos($kat,'dzieci') !== false) {
			return 'Dziecięce';
		}
	
/* w zależności jaki sklep (niektóre sklepy są tylko damskie lub tylko męskie */	
		if (mb_stripos($brand,"Giacomo") !== false) {
			return 'Mężczyzna';
		}
	
		if (mb_stripos($brand,"Bialcon") !== false) {
			return 'Kobieta';
		}		
		
		if (mb_stripos($brand,"Mosquito") !== false) {
			return 'Kobieta';
		}
		
		if (mb_stripos($brand,"Orsay") !== false) {
			return 'Kobieta';
		}
		if (mb_stripos($brand,"Primamoda") !== false) {
			return 'Kobieta';
		}
		if (mb_stripos($brand,"MediaMarkt") !== false) {
			return '';
		}
		if (mb_stripos($brand,"kruk") !== false) {
			return 'Kobieta';
		}
		
/* sprawdzamy tytuł */
		if (mb_stripos($title,"męsk") !== false) {
			return 'Mężczyzna';
		}
		if (mb_stripos($title,"damsk") !== false) {
			return 'Kobieta';
		}
		if (mb_stripos($title,"dziec") !== false) {
			return 'Dziecko';
		}
}	

function add_to_db($katp,$t,$s,$b,$p,$d,$sex,$r1,$r2,$r3,$r4,$r5,$i,$u) {	

/*
$fp = fopen($_SERVER['DOCUMENT_ROOT']."/csv/test.csv", 'a');
$list = array($t,$s,$b,$p,$d,$sex,$r1,$r2,$r3,$r4,$r5,$i,$u);
fputcsv($fp, $list,';');
fclose($fp);
*/	
	$l = rand(1,1000);
	$mysql = "
				INSERT INTO produkty 
				(name,store,brand,price,opis,sex,r1,r2,r3,r4,r5,img,url,likes)
				VALUES 
				('$t','$s','$b','$p','$d','$sex','$r1','$r2','$r3','$r4','$r5','$i','$u','$l')
	";
		
	global $wpdb;
	$upload = $wpdb->query($mysql);
	
}	

function get_all($kat) {

	/*
$list[] = array($kat);

$fp = fopen($_SERVER['DOCUMENT_ROOT']."/kategorie.csv", 'a');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);
	*/
}
?>