<?php
function filter_sub() {
global $wpdb;

	$ppp = 50;
	$page = $_GET['page'];
		if (empty($page)) {$page = 1;}	
	$offset = intval($page)*$ppp - $ppp;		
	$st = $_GET['q'];
	$device = $_GET['dev'];
	/* $city = $_GET['c']; 
	$gallery = $_GET['g']; */
	$min = $_GET['min'];
	$max = $_GET['max'];
	$sort = $_GET['sort'];
	/* $attr = $_GET['attr']; */
	$menu = $_GET['menu'];
	$plec = $_GET['plec'];
	$r2 = $_GET['r2'];
	$sub = $_GET['sub']; /* r3 */
	$podkat = $_GET['podkat'];
	$store = $_GET['store'];
	$brand = $_GET['brand'];

	$impstore = ucfirst(implode(", ",$store));
	$impbrand = ucfirst(implode(", ",$brand));
	
	if (count($brand) > 1) {
	$bstring = '(';
		foreach ($brand as $b) {
			$barray[] = "brand LIKE '$b'";
		}
	$bstring .= implode(" OR ",$barray);
	$bstring .= ')';
	} else {$b = implode("",$brand); $bstring = "brand LIKE '$b'";}
	
/* ************************************************************************************************************** */
	
	if (count($store) > 1) {
	$sstring = '(';
		foreach ($store as $s) {
			$sarray[] = "store LIKE '$s'";
		}
	$sstring .= implode(" OR ",$sarray);
	$sstring .= ')';
	} else {$s = implode("",$store); $sstring = "store LIKE '$s'";}
	
/* ************************************************************************************************************** */
	
	if (count($podkat) > 1) {
	$pstring = '(';
		foreach ($podkat as $p) {
			$parray[] = "r4 LIKE '$p'";
		}
	$pstring .= implode(" OR ",$parray);
	$pstring .= ')';
	} else {$p = implode("",$podkat); $pstring = "r4 LIKE '$p'";}
	
	$substring = "r3 LIKE '$sub'";
	if ($plec) {
		$part .= " AND sex LIKE '$plec'";
	}
	$substring = $substring . $part;
	 
/* ************************************************************************************************************** */
/*
	$urldecode = urldecode($attr);
	$json = stripslashes($urldecode);	
	$attr = json_decode($json, true);
	
	$pro = array();
	if (count($attr) > 0) {
		foreach ($attr as $a) {
			$pro[] = '%'.$a.'%';
		}
		$attr = implode(",",$pro);
	}
*/
/* ****************************************** LICZENIE PRODUKTÓW ************************************************ */
	/*
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
	*/
	$cou = "
		SELECT COUNT(produkty.id) AS ilosc FROM produkty
	";	
	
	unset($statement);
	if ($city)  {$statement[] = "INNER JOIN avail ON produkty.id = avail.id ";}
	if ($sub) {$statement[] = "WHERE $substring";}
	if ($store) {$statement[] = "AND $sstring";}
	if ($brand) {$statement[] = "AND $bstring";}
	if ($podkat) {$statement[] = "AND $pstring";}
	if ($attr) {$statement[] = "AND atr LIKE '$attr'";}
	if (!empty($min) && !empty($max)) {$statement[] = "AND price BETWEEN $min AND $max";}
	if ($city && empty($gallery))  {$statement[] = "AND ($notnull)";}
	if ($gallery)  {$statement[] = "AND $galeria IS NOT NULL";}

	if (!empty($statement)) {
			$cou .= implode(' ', $statement);
		} ;
	
	$c = $wpdb->get_col($cou);
	$count = $c[0];

/* ****************************************** WYŚWIETLANIE PRODUKTÓW ******************************************* */	
		
	$search = "
		SELECT produkty.id,name,price,store,brand,img,likes
		FROM produkty
	";	
	unset($statement);
	/* if ($city)  {$statement[] = "INNER JOIN avail ON produkty.id = avail.id ";} */
	if ($sub) {$statement[] = "WHERE $substring";}
	if ($store) {$statement[] = "AND $sstring";}
	if ($brand) {$statement[] = "AND $bstring";}
	if ($podkat) {$statement[] = "AND $pstring";}
	/* if ($attr) {$statement[] = "AND atr LIKE '$attr'";} */
	if (!empty($min) && !empty($max)) {$statement[] = "AND price BETWEEN $min AND $max";}
	/* if ($city && empty($gallery))  {$statement[] = "AND ($notnull)";}
	if ($gallery)  {$statement[] = "AND $galeria IS NOT NULL";} */
	if ($sort) {$statement[] = " ORDER BY price $sort";}
	if ($ppp) {$statement[] = " LIMIT $ppp";}
	if ($page) {$statement[] = " OFFSET $offset";}

	if (!empty($statement)) {
			$search .= implode(' ', $statement);
		} ;

	$do = $wpdb->get_results($wpdb->prepare($search,$search));
	$dec = json_decode(json_encode($do,true), true);

/* ***************************************** WYŚWIETLANIE FILTRÓW ******************************************** */	
	
	$filtry = "
	SELECT id,store,brand FROM produkty
	WHERE $substring";
	$do_filtry = $wpdb->get_results($wpdb->prepare($filtry,$filtry));
	$dec_filtry = json_decode(json_encode($do_filtry,true), true);
	$safiltry = count($dec_filtry);

/* ***************************************** WYŚWIETLANIE ATRYBUTÓW ******************************************** */	
	
/*	foreach ($dec_filtry as $row) {
		$ids[] = $row[id];
	}
	$id = implode(',',$ids);
	
	if ($sub) {
		$atrybuty = "SELECT atr,sub FROM produkty WHERE $substring AND id IN ($id)";
		$do_atrybuty = $wpdb->get_results($wpdb->prepare($atrybuty,$atrybuty));
		$dec_atrybuty = json_decode(json_encode($do_atrybuty,true), true);
	}


	$a = array();
	foreach ($dec_atrybuty as $string) {
		$exp = explode('&',$string[atr]);
		$exp = array_filter($exp);
		$a[$string[sub]] = $exp;
	}

	$b = array();
	foreach ($a as $cat => $row) {
		foreach ($row as $r) {
			$expa = explode(':',$r);
			$b[$cat][$expa[0]][] = $expa[1];
		}
	}
		
	$c = array();
	foreach ($b as $cat => $nazwy_atrybotow) {
		foreach ($nazwy_atrybotow as $nazwa => $w) {
				$c[$cat][$nazwa] .= implode(',',$w).','; 				
		}		
	}
		
	$d = array();
	foreach ($c as $cat => $atrybuty) {
		foreach ($atrybuty as $name => $values) {
			$rtrim = rtrim($values,',');
			$exp = explode(',',$rtrim);	
			$u = array_unique($exp);
			$d[$cat][$name] = $u;
		}
	}
*/	
/* *********************************************** JAKIE MAMY SKLEPY ********************************************** */
	$store = array();
	foreach ($dec_filtry as $row) {
		$store[] = $row[store];
	}
	$store = array_unique($store);
	
/* *********************************************** JAKIE MAMY MARKI *********************************************** */
	function array_iunique( $array ) {
    return array_intersect_key(
        $array,
        array_unique( array_map( "strtolower", $array ) )
    );
	}
	
	$brand = array();
	foreach ($dec_filtry as $row) {
		
		if(1 !== preg_match('~[0-9]~', $row[brand])){
 			$brand[] = $row[brand];
		}
		
	}
	$brand = array_iunique($brand);

?>

<div>
<div id="v_menu" menu="<?php echo $menu;?>"></div>	
<div id="v_plec" plec="<?php echo $plec;?>"></div>	
<div id="v_r2" r2="<?php echo $r2;?>"></div>	
</div>

<?php if ($safiltry > 0) { if ($device == 'desktop') { ?>

<div id="filtry_wrapper">

<?php } else { ?>	
	
<div id="filtry_okno">		
	<div id="filtry_tytul">
		<div>
			<h4>Filtrowanie zaawansowane</h4></div><span id="close_filters" class="icon-checkmark"></span>
		</div>	
	
<?php } ?>
	
<div id="clean_panel">
<button class="ac_sub"><span class="icon-cross"></span></button>	
</div>
	
	<div id="cbs_wrapper">
			<div>		
			<div class="filtr-title">Marki</div>		
			<?php
				$r = 0; 
				$i = 0;
				$r ++;
				echo '<div class="filtry-row-'.$r.'">';
				foreach($brand as $b) {
					$i ++;
					echo
					'<div class="filtr" id="brand_check">
						<input type="checkbox" 
					   		class="form-checkbox sub" 
					   		nt="marki" 
					   		value="'.$b.'" 
					   		id="'.$i.'">'.ucfirst($b).'</div>'
						;}
						echo '</div>';
		 		?>			
		</div>
		<div>		
			<div class="filtr-title">Sklepy</div>		
			<?php
				$r ++;
				echo '<div class="filtry-row-'.$r.'">';
				foreach($store as $s) {	
					$i ++;
					echo
					'<div class="filtr" id="store_check">
						<input type="checkbox" 
					   		class="form-checkbox sub" 
					   		nt="sklepy" 
					   		value="'.$s.'" 
					   		id="'.$i.'">'.ucfirst($s).'</div>'
						;}
						echo '</div>';
		 		?>			
		</div>
		<?php
			$file = file_get_contents($_SERVER['DOCUMENT_ROOT']."/generated/menu.json");			
			$jfile = json_decode($file, true);
			if (count($jfile[$menu][$r2][$sub]) > 1) {
		?>
					<div>
						<div class="filtr-title">Podkategorie</div>
						<?php 											  
							$r++;
							echo '<div class="filtry-row-'.$r.'">';
							foreach ($jfile[$menu][$r2][$sub] as $r4 => $e) {
								$i++;	
								if ($r4 !== '') {
								echo 
									'<div class="filtr" id="podkat_check">
										<input type="checkbox"
											class="form-checkbox sub"
											nt="podkategoria"
											value="'.$r4.'"
											id="'.$i.'">'.$r4.'</div>';
								}
							}
							echo '</div>';
						?>
					</div>
		<?php
			}
		?>
		<div>
			<div class="filtr-title">Cena</div>
				<div class="filtry-row-">
					<div class="filtr">
						<input type="radio" class="form-checkbox" id="asc_sub">Rosnąco
					</div>
					<div class="filtr">
						<input type="radio" class="form-checkbox" id="desc_sub">Malejąco	
					</div>
					<div class="filtr" style="display: flex;">
						<p class="maleliterki">Od </p><input id="min_sub" autocomplete="off" style="width:50px;">
						<p class="maleliterki">Do </p><input id="max_sub" autocomplete="off" style="width:50px;">
					</div>		
					<div id="sort" sort=""></div>
				</div>
		</div>
	</div>
	</div>
<!-- <div id="atrybuty_wrapper">
	<?php
		foreach( $d as $cat => $atr ) {
			echo '<div><div class="cat_title_atr">'.ucfirst($cat).'</div>';
			echo '<div class="atr_container">';
			foreach ($atr as $n => $a) {
				$r ++;
				echo '<div>';
				echo '<div class="filtr-title">'.ucfirst($n).'</div>';
				echo '<div class="filtry-row-'.$r.'">';
					foreach ($a as $keyi => $value) { 
						$i++;
						echo '					
							<div class="filtr" id="attr">
							<input type="checkbox" class="form-checkbox sub"
							cat="'.$cat.'" at="'.$n.'" value="'.$value.'" id="'.$i.'">'.ucfirst($value).'
							</div>
						';
					} echo '</div></div>'; 
			}
			echo '</div></div>';
		}
	?>
	</div>
	
</div>-->

<?php } /* CZY FILTRY ISTNIEJĄ */ ?> 	
	
<div id="search_info">
	<div id="sub_store_brand_info">
	<?php

if ($sub) {echo '<div id="nameval">Kategoria:</div><div id="sub" sub="'.$sub.'">'.$sub.'</div>';}		
if ($device == 'desktop') {
if ($impstore) {echo '<div id="nameval">Sklep:</div><div id="store" store="'.$impstore.'">'.$impstore.'</div>';}
if ($impbrand) {echo '<div id="nameval">Marka:</div><div id="brand" brand="'.$impbrand.'">'.$impbrand.'</div>';}
	}
		
	if ($count == 1) {$ending = 'produkt';}
	if ($count == 2 || $count == 3 || $count == 4) {$ending = 'produkty';}
	if ($count > 4 || $count == 0) {$ending = 'produktów';}
	?>
	</div>	
	<?php echo '<div id="filter_line"><div id="ip">'.$count.'</div>&nbsp'.$ending.'<div id="filtry_on"></div><div id="button_wrapper"></div></div>';?>
</div>

<div class="blog-layout-grid">

	<?php if ($count > 0) {
	foreach ($dec as $key => $row) {	
	?>
		
<div class="product" id="post-<?php echo $row[id]; ?>">
				
<div class="outer-div">
		<img class="wp-post-image" src="<?php echo $row[img]; ?>"/>					
		<div class="inner-div-<?php echo $row[id]; ?>">
		<div class="ml-likes">
				<div class="ml"><?php echo $row[price];?> PLN</div>							
			</div>
			<span class="icon-heart-broken" id="heart-<?php echo $row[id];?>"></span>
		</div>
	</div>
	
<div class="corp-content-wrapper">
		<div class="lc">
			<div class="lc">
				<div id="l-<?php echo $row[id];?>" class="ml-l"><?php echo $row[likes]; ?></div>
				&nbsp<div class="ml">polubień</div>
			</div>			
			<div class="ml-r"><?php echo $row[store]; ?></div>
		</div>
										
		<div style="text-align: center">
			<a class="tytul-<?php echo $row[id]; ?>"><?php echo $row[name]; ?></a>
			<div class="ml"><?php echo $row[brand]; ?></div>
		</div>
	
		<!--<div class="lc"><div class="klikacz-<?php echo $row[id]; ?>"></div></div>-->
	</div>
			
</div>
	
	<?php } ?>
	
</div>

<div id="pagination">
	<?php
	$total_page = $count/$ppp;
	if ($page > 1) {echo '<p id="sib_sub">1</p>';}
	if ($page > 1) {echo '<p id="prev_sub">Poprzednia </p>';}
	if (($page - 3) > 1) {echo '<p id="sib_sub">'.($page-3).'</p>';}
	if (($page - 2) > 1) {echo '<p id="sib_sub">'.($page-2).'</p>';}
	if (($page - 1) > 1) {echo '<p id="sib_sub">'.($page-1).'</p>';}
	echo '<p id="here"><b>'.$page.'</b></p>';
	if (($page + 1) < ceil($total_page)) {echo '<p id="sib_sub">'.($page+1).'</p>';}
	if (($page + 2) < ceil($total_page)) {echo '<p id="sib_sub">'.($page+2).'</p>';}
	if (($page + 3) < ceil($total_page)) {echo '<p id="sib_sub">'.($page+3).'</p>';}
	if ($page < (ceil($total_page))) {echo '<p id="next_sub"> Następna</p>';}
	if ($page < (ceil($total_page))) {echo '<p id="sib_sub">'.ceil($total_page).'</p>';}	
	?>
</div>
	


	
	
<?php } else {echo '<div id="brak">Brak produktów spełniających Twoje kryteria.</div>';} ?>	
	
<?php	
wp_die();
}

add_action( 'wp_ajax_filter_sub', 'filter_sub' );
add_action( 'wp_ajax_nopriv_filter_sub', 'filter_sub' );
?>