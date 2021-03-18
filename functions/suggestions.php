<?php
function suggestions() {	

		$city = $_POST['c'];
		$gallery = $_POST['g'];
		$st = $_POST['q'];
		$st = str_replace(" ","%",$st);
	
	if ($gallery) {
		$g = str_replace(" ","_","$gallery");
		$galeria = $city.'_'.$g;
	}
	
	if ($city && empty($gallery)) {
		$root = $_SERVER['DOCUMENT_ROOT'];
		require $root.'/kolumny.php';
		$un = unserialize($columns);
		foreach ($un as $m => $q) {
			if (strpos($m,$city) !== FALSE) {$notnull = $q;}
		}
	}
	
	unset($statement);
	$suggestions = "SELECT produkty.id, name, store, brand, img, price, likes FROM produkty ";
	if ($city)  {$statement[] = "INNER JOIN avail ON produkty.id = avail.id";}
	if ($st)  {$statement[] = "WHERE MATCH name AGAINST ('*$st*' IN BOOLEAN MODE)";}	
	if ($city && empty($gallery))  {$statement[] = "AND ($notnull)";}
	if ($gallery) {$statement[] = "AND $galeria IS NOT NULL";}
	if (!empty($statement)) {
			$suggestions .= implode(' ', $statement). " LIMIT 10";
		} ;	
	
		global $wpdb;
		$wynik = $wpdb->get_results($suggestions);		
		wp_send_json_success($wynik);
	die();
}	

add_action( 'wp_ajax_suggestions',        'suggestions' );
add_action( 'wp_ajax_nopriv_suggestions', 'suggestions' );	
?>