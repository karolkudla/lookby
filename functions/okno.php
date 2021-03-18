<?php

function otworz_okno() {
	
$id = $_POST['id'];
$city = $_POST['c'];
		
global $wpdb;
	
$query = "SELECT id,name,store,brand,price,img,url,opis FROM produkty WHERE id = $id";
$get = $wpdb->get_results($wpdb->prepare($query,$query));		
$dec = json_decode(json_encode($get,true), true);

/*
$divide_by_and = explode("&",$dec[0][atr]);

$tablica = array();
foreach ($divide_by_and as $value) {
	$roz = explode(":",$value);
	$tablica[$roz[0]] .= $roz[1].',';
}

$array = array();
foreach ($tablica as $key=>$tab) {
	$super = array_unique(explode(',', $tab));
	$filter = array_filter($super);
	$array[$key] = $filter;
}
*/
?>
<div id="close_okienko" class="icon-cross"></div>	
<div id="wnetrze_okienka">
		
	
		<div id="zdjecie">				
				<img src="<?php echo $dec[0][img]; ?>"/>
		</div>				

		<div id="atrybuty">
			<div id="data">
				<div id="product-brand"><?php echo $dec[0][brand]; ?></div>
				<div id="product-title"><?php echo $dec[0][name]; ?></div>
				<div id="product-store"><?php echo $dec[0][store]; ?></div>
				<div id="product-price"><?php echo $dec[0][price]; ?> PLN</div>	
			</div>	
			<div style="font-size: 12px;">
				<?php 
           			echo nl2br($dec[0][opis]);
			   /*
					$i = 0;
					foreach( $array as $atrybut=>$wartosci) {
						$i++;
						echo '
						<div class="attributes_wrapper">
							<div><p class="nazwa_atr">'.ucfirst($atrybut).'</p></div>
							<div class="atrybut_data_'.$i.'">';
								foreach ($wartosci as $key=>$value) { 
									echo '<p class="wartosc_atr">'.ucfirst($value).'</p>';
								}
						echo '</div></div>';
					} */?>	
			</div>
			<div id="availability">
				Tutaj dowiesz się o dostępności produktu w Twoim mieście
			</div>
			<div id="go_to_shop" style="display: flex; justify-content: center;">
				<input 
			    type="button" id="go_getter"
				onclick="window.open('<?php echo $dec[0][url] ?>', '_blank');"
				value="Kup w sklepie <?php echo $dec[0][store];?>"
			/>	
			</div>
		</div>
	
<?php/* if (empty($city)) { ?>	
		<div id="lista">
			<input 
			    type="button" id="go_getter"
				onclick="window.open('<?php echo $dec[0][url]; ?>', '_blank');"
				value="PRZEJDŹ DO STRONY SKLEPU"
			/>			
			<p class="give_city_info">Podaj miasto, aby wyświetlić galerie z produktem:</p>
			
			<div style="display: flex;">
				<input class="city-input-<?php echo $id;?>" maxlength="8">
				<button class="city_getter_<?php echo $id;?>">OK</button>	
			</div>
			
			<div class="lista-gal-<?php echo $id;?>"></div>
		</div>
<?php } else { ?>
		<div id="lista">
			<input 
			    type="button" id="go_getter"
				onclick="window.open('<?php echo $dec[0][url] ?>', '_blank');"
				value="PRZEJDŹ DO STRONY SKLEPU"
			/>		
			<p class="give_city_info">Lista galerii z produktem:</p>
			<div class="lista-gal-<?php echo $id;?>"></div>
		</div>
<?php } */?>	
	
</div>

<?php 
	die();
}	

add_action( 'wp_ajax_otworz_okno', 'otworz_okno' );
add_action( 'wp_ajax_nopriv_otworz_okno', 'otworz_okno' );
?>