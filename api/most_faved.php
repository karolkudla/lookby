<?php 

function mf_make() {

global $wpdb;
$categories = [
	'Moda',
	'Elektronika',
	'Dom Ogród Biuro',
	'Zdrowie i Uroda',
	'Kultura',
	'Sport i rekreacja',
	'Dla dzieci',
	'Biżuteria i Zegarki'
];
	
foreach ($categories as $cat) {
	$q = "SELECT id,name,store,brand,price,img,likes FROM produkty WHERE r1 = '$cat' ORDER BY likes DESC LIMIT 5";
	$db = $wpdb->get_results($q);
	$dec = json_decode(json_encode($db), true);
	$most_faved['lookby'][$cat] = $dec;
}

$file = fopen($_SERVER['DOCUMENT_ROOT']."/generated/most_faved.json", "w");
$encode = json_encode($most_faved,JSON_UNESCAPED_UNICODE);
fwrite($file, $encode);	
fclose($file);
		
echo 'Sukces';	

wp_die();
}

add_action( 'wp_ajax_mf_make', 'mf_make' );
add_action( 'wp_ajax_nopriv_mf_make', 'mf_make' );

?>