<?php
/* Foreach dla kategorii 1do1 */

foreach ($kk[2] as $key => $keyval) {
	
	$r1 = $kk[1][$key][0];
	$r2 = $kk[1][$key][1];
	$r3 = $kk[1][$key][2];
	$r4 = $kk[1][$key][3];
	$r5 = $kk[1][$key][4];
	$tabela['flagi'][$m][$title][1] = 'Wchodzę do 1do1 z produktem '.$title.'';
	foreach ($keyval as $key => $val) {
		
		if (!empty($val)) {
			
		$sm = round(microtime(true) * 10000000);
		$tabela['flagi'][$m][$title][2][$sm] = 'Szukam '.$val; 
			
		if (mb_stripos($kat,$val) !== false) {
			
			$tabela[produkty][$id]['img'] = $img_big;
			$tabela[produkty][$id]['nazwa'] = $title;					
			$tabela[produkty][$id]['szukam'][] = $val;
			$tabela[produkty][$id]['nowa_kat'] = 
			sex($kat,$brand)."/".$r1."/".$r2."/".$r3."/".$r4."/".$r5;
			$tabela[produkty][$id]['stara'] = $kat;
			$flaga = 'stop';
			$dupa = $id;

			$sm = round(microtime(true) * 10000000);
			$tabela['flagi'][$m][$title][2][$sm] = 'Znalazłem '.$val.' w '.$kat.' i nadałem nową kat: '.
				sex($kat,$title,$brand)."/".$r1."/".$r2."/".$r3."/".$r4."/".$r5;
			
			if ($db == 'true') {
				add_to_db($katp,$title,$sklep,$brand,$pln,$desc,sex($kat,$title,$brand),$r1,$r2,$r3,$r4,$r5,$img_big,$urli);
			}
			
			break 2;			
		} else {
			$flaga = 'continue';
			$sm = round(microtime(true) * 10000000);
			$tabela['flagi'][$m][$title][2][$sm] = 'Nie znalazłem '.$val.' w '.$kat.''; 
		}
	}
}
}

$tabela['flagi'][$m][$title][3] = 'Sprawdzam czy wejdę do Kluczy z produktem '.$title.'';

if ($flaga == 'continue') {
	$tabela['flagi'][$m][$title][4] = 'Udało się wejść do kluczy przy produkcie '.$title.'';
foreach ($kk[0] as $key => $keyval) { 
		
					$r1 = $kk[1][$key][0];
					$r2 = $kk[1][$key][1];
					$r3 = $kk[1][$key][2];
					$r4 = $kk[1][$key][3];
					$r5 = $kk[1][$key][4];
		
			if (	!empty($keyval[0]) && 
					 empty($keyval[1])  &&
			   		 empty($keyval[2])
			   ) {$keys = '1';
				  $sm = round(microtime(true) * 1000000);
				  $tabela['flagi'][$m][$title][5][$sm] = 'Mam 1 klucz do dyspozycji: '.$keyval[0];
 				 }
		
			if (	!empty($keyval[0]) && 
					!empty($keyval[1]) &&
			   		 empty($keyval[2])
			   ) {$keys = '2';
				  $sm = round(microtime(true) * 1000000);
				  $tabela['flagi'][$m][$title][5][$sm] = 'Mam 2 klucze do dyspozycji: '.$keyval[0].' i '.$keyval[1];
				 }
		
			if (	!empty($keyval[0]) && 
					!empty($keyval[1]) &&
			   		!empty($keyval[2])
			   ) {$keys = '3';
				  $sm = round(microtime(true) * 1000000);
	$tabela['flagi'][$m][$title][5][$sm] = 'Mam 3 klucze do dyspozycji: '.$keyval[0].', '.$keyval[1].' i '.$keyval[2];
				 }
					
		
			if ($keys == '1') {

				if (
					(mb_stripos($title,$keyval[0]) !== false) 		
				) {
				$tabela['flagi'][$m][$title][6] = 'Znalazłem '.$keyval[0].' w '.$title.'';
				
				$tabela[produkty][$id]['img'] = $img_big;
				$tabela[produkty][$id]['nazwa'] = $title;					
				$tabela[produkty][$id]['szukam'][] = $keyval[0];
				$tabela[produkty][$id]['nowa_kat'] = 
				sex($kat,$title,$brand)."/".$r1."/".$r2."/".$r3."/".$r4."/".$r5;
				$tabela[produkty][$id]['stara'] = $kat;
				$dupa = $id; 
				
				if ($db == 'true') {				add_to_db($katp,$title,$sklep,$brand,$pln,$desc,sex($kat,$title,$brand),$r1,$r2,$r3,$r4,$r5,$img_big,$urli);
				}
					
				break;
				}					
			}
		
			if ($keys == '2') {
				$tabela['info'][] = 'Sprawdzam czy '.$title.' będzie pasował do '.$keyval[0].' i '.$keyval[1].'';
				if (
					(mb_stripos($title,$keyval[0]) !== false &&
					mb_stripos($title,$keyval[1]) !== false) 					
				) {
					
				$tabela['flagi'][$m][$title][7] = 'Znalazłem '.$keyval[0].' i '.$keyval[1].' w '.$title.'';
			
				$tabela[produkty][$id]['img'] = $img_big;
				$tabela[produkty][$id]['nazwa'] = $title;					
				$tabela[produkty][$id]['szukam'][] = $keyval[0].'+'.$keyval[1];
				$tabela[produkty][$id]['nowa_kat'] =
				sex($kat,$title,$brand)."/".$r1."/".$r2."/".$r3."/".$r4."/".$r5;
				$tabela[produkty][$id]['stara'] = $kat;
				$dupa = $id; 
				
				if ($db == 'true') {
				add_to_db($katp,$title,$sklep,$brand,$pln,$desc,sex($kat,$title,$brand),$r1,$r2,$r3,$r4,$r5,$img_big,$urli);
				}

				break;
				}					
			}
		
			if ($keys == '3') {

				if (
					(mb_stripos($title,$keyval[0]) !== false &&
					(mb_stripos($title,$keyval[1]) !== false ||
					mb_stripos($title,$keyval[2]) !== false)) 	
				) {
					
$tabela['flagi'][$m][$title][8] = 'Znalazłem '.$keyval[0].' i '.$keyval[1].' lub '.$keyval[2].' w '.$title.'';
			
				$tabela[produkty][$id]['img'] = $img_big;
				$tabela[produkty][$id]['nazwa'] = $title;					
				$tabela[produkty][$id]['szukam'][] = $keyval[0].'+'.$keyval[1].'+'.$keyval[2];
				$tabela[produkty][$id]['nowa_kat'] = 
				sex($kat,$title,$brand)."/".$r1."/".$r2."/".$r3."/".$r4."/".$r5;
				$tabela[produkty][$id]['stara'] = $kat;
				$dupa = $id; 
			
				if ($db == 'true') {
				add_to_db($katp,$title,$sklep,$brand,$pln,$desc,sex($kat,$title,$brand),$r1,$r2,$r3,$r4,$r5,$img_big,$urli);
				}
				
				break;
				}					
			}			
	} 
} else {
	$tabela['flagi'][$m][$title][9] = 'Wejście do kluczy zabronione, bo znalazłem już kategorię w maperze 1do1'; 
}

/* koniec pętli słów kluczowych */
	
	if ($dupa !== $id) {		
		
			$tabela[brak][$id]['img'] = $img_big;
			$tabela[brak][$id]['nazwa'] = $title;					
			$tabela[brak][$id]['stara'] = $kat;	
			$tabela['flagi'][$m][$title][10] = 'Nie znalazłem nic nigdzie'; 
		}

?>