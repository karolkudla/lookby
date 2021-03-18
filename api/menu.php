<?php
function menu_make() {
	
global $wpdb;
$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE sex = 'Kobieta' AND r1 = 'Moda'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);	
	
		foreach ($dec as $item) {
			$menu['Moda kobieca'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}
	
$squery = "SELECT DISTINCT store FROM produkty WHERE r1 = 'Moda' AND sex = 'Kobieta'";
$sdo = $wpdb->get_col($squery);
					  
		foreach ($sdo as $store) {
			$stores['Moda kobieca'][] = $store;
		}		

$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE sex = 'Mężczyzna' AND r1 = 'Moda'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);		
					  
		foreach ($dec as $item) {
			$menu['Moda meska'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}
	
$squery = "SELECT DISTINCT store FROM produkty WHERE r1 = 'Moda' AND sex = 'Mężczyzna'";
$sdo = $wpdb->get_col($squery);
					  
		foreach ($sdo as $store) {
			$stores['Moda meska'][] = $store;
		}
	
$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE r1 = 'Elektronika'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);		
					  
		foreach ($dec as $item) {
			$menu['Elektronika'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}	

$squery = "SELECT DISTINCT store FROM produkty WHERE r1 = 'Elektronika'";
$sdo = $wpdb->get_col($squery);
					  
		foreach ($sdo as $store) {
			$stores['Elektronika'][] = $store;
		}	
	
$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE r2 = 'Zegarki' AND sex='Kobieta'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);		
					  
		foreach ($dec as $item) {
			$menu['biz_kobieta_zegarki'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}	

$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE r2 = 'Zegarki' AND sex='Mężczyzna'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);		
					  
		foreach ($dec as $item) {
			$menu['biz_mezczyzna_zegarki'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}	

$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE r2 = 'Biżuteria'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);		
					  
		foreach ($dec as $item) {
			$menu['biz'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}		
	
$squery = "SELECT DISTINCT store FROM produkty WHERE r1 = 'Biżuteria i Zegarki'";
$sdo = $wpdb->get_col($squery);
					  
		foreach ($sdo as $store) {
			$stores['biz'][] = $store;
		}	
	
$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE r1 = 'Zdrowie i Uroda'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);		
					  
		foreach ($dec as $item) {
			$menu['zio'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}

$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE r1 = 'Zdrowie i Uroda' AND r2 = 'Perfumy'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);		
					  
		foreach ($dec as $item) {
			$menu['zio_perfumy'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}	
	
$squery = "SELECT DISTINCT store FROM produkty WHERE r1 = 'Zdrowie i Uroda'";
$sdo = $wpdb->get_col($squery);
					  
		foreach ($sdo as $store) {
			$stores['zio'][] = $store;
		}	

$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE r1 = 'Sport i Rekreacja'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);		
					  
		foreach ($dec as $item) {
			$menu['spo'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}	
	
$squery = "SELECT DISTINCT store FROM produkty WHERE r1 = 'Sport i Rekreacja'";
$sdo = $wpdb->get_col($squery);
					  
		foreach ($sdo as $store) {
			$stores['spo'][] = $store;
		}	
	
$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE r1 = 'Dla dzieci'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);		
					  
		foreach ($dec as $item) {
			$menu['ddz'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}
	
$squery = "SELECT DISTINCT store FROM produkty WHERE r1 = 'Dla dzieci'";
$sdo = $wpdb->get_col($squery);
					  
		foreach ($sdo as $store) {
			$stores['ddz'][] = $store;
		}	
	
$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE r1 = 'Dom Ogród Biuro'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);		
					  
		foreach ($dec as $item) {
			$menu['dio'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}
	
$squery = "SELECT DISTINCT store FROM produkty WHERE r1 = 'Dom Ogród Biuro'";
$sdo = $wpdb->get_col($squery);
					  
		foreach ($sdo as $store) {
			$stores['dio'][] = $store;
		}	
	
$query = "SELECT r2,r3,r4,r5 FROM produkty WHERE r1 = 'Księgarnie'";
$do = $wpdb->get_results($query);
$dec = json_decode(json_encode($do), true);		
					  
		foreach ($dec as $item) {
			$menu['kul'][trim($item[r2])][trim($item[r3])][trim($item[r4])][trim($item[r5])] = '';
		}
	
$squery = "SELECT DISTINCT store FROM produkty WHERE r1 = 'Księgarnie'";
$sdo = $wpdb->get_col($squery);
					  
		foreach ($sdo as $store) {
			$stores['kul'][] = $store;
		}	
	
$m_file = fopen($_SERVER['DOCUMENT_ROOT']."/generated//menu.json", "w");
$json_m = json_encode($menu,JSON_UNESCAPED_UNICODE);
fwrite($m_file, $json_m);	
fclose($m_file);

$store_file = fopen($_SERVER['DOCUMENT_ROOT']."/generated/stores.json", "w");
$json_store = json_encode($stores,JSON_UNESCAPED_UNICODE);	
fwrite($store_file, $json_store);
fclose($store_file);

echo 'Sukces';
	
wp_die();
}

add_action( 'wp_ajax_menu_make', 'menu_make' );
add_action( 'wp_ajax_nopriv_menu_make', 'menu_make' );

?>