<?php 
function banner($city,$galeria) {

$city = $_GET['c'];
$galeria = $_GET['g'];

$b[lookby] = '';
$b[Kielce] = '';
$b["Alfa Centrum"] = '';
 
if ($city && $galeria == 'nul') {
echo $b[$city];
}
	
if ($galeria && $city == 'nul') {
echo $b[$galeria];
}
	
if (empty($galeria) && empty($city)) {
echo $b[lookby];
}
	
wp_die();
}

add_action( 'wp_ajax_banner', 'banner' );
add_action( 'wp_ajax_nopriv_banner', 'banner' );
?>