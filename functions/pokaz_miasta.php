<?php
function lista() {
global $wpdb;	
	
$post_id = $_POST['id'];
$post_c = $_POST['c'];

	function pleng($word) {
		$a = ['ą','ę','ł','ń','ć','ż','ź','ś','ć','ó','Ą','Ę','Ł','Ń','Ć','Ż','Ź','Ś','Ć','Ó'];
		$b = ['a','e','l','n','c','z','z','s','c','o','a','e','l','n','c','z','z','s','c','o'];
		$new = strtolower(str_replace($a,$b,$word));
		return $new;
	}
	
	$c = pleng($post_c);
	
		$root = $_SERVER['DOCUMENT_ROOT'];
		require $root.'/kolumny.php'; /* LISTĘ GALERII W KAŻDYM MIEŚCIE, CZYLI LISTĘ NAZW KOLUMN */
		$cols = unserialize($kol);
	
	foreach ($post_id as $id) {
		foreach ($cols[$c] as $row => $g) {
			$sql = "SELECT id FROM $g WHERE id = $id";
			$get = $wpdb->get_col($sql);
			if (implode($get) == $id) {$arr[$id][] = str_replace("_"," ",ltrim(strstr($g,'_'),"_"));}
		}		
	}
	
wp_send_json_success($arr);
	
wp_die();
}

add_action( 'wp_ajax_lista', 'lista' );
add_action( 'wp_ajax_nopriv_lista', 'lista' );
?>