<div id="mdesktop" style="margin-top: -7px;">

<?php	

/* menu zaimportowane w mobile */	
	
$store_file = file_get_contents($_SERVER['DOCUMENT_ROOT']."/generated/stores.json");		
$stores = json_decode($store_file, true);

?>

<div class="menu_top">
	<p class="dropdown-toggle">Moda kobieca</p>
		<div class="dropdown">
			<div class="menucontainer">								
				<?php	
					if (!empty($menu['Moda kobieca'])) {
					uasort($menu['Moda kobieca'],'sort_sub');
					foreach ($menu['Moda kobieca'] as $keykr2=>$kr2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a>'.$keykr2.'</a></div>';
							ksort($kr2);
							foreach ($kr2 as $keykr3=>$kr3) {
								echo '<div class="menu-value-down">
										<a class="asub" menu="Moda kobieca" r2="'.$keykr2.'" plec="kobieta">'.$keykr3.'</a>
									  </div>';
							}
						echo '</div>';
					}
					}
				?>					
			</div>	
			<div class="menucontainer">
				<div style="display: flex;">
					<?php if ($stores['Moda kobieca']) { ?>
					<div class="menu-value">Sklepy:</div>
					<?php 
						foreach ($stores['Moda kobieca'] as $store) {
							echo '<a class="tooltip" style="margin: 0 5px 0 5px;">'.$store.'
							<span class="tooltiptext">Najpierw wybierz kategorię, potem ustaw filtr na sklep</span>
							</a>';
						}
					}
					?>
				</div>				
			</div>
		</div>
</div>
	
<div class="menu_top">
	<p class="dropdown-toggle">Moda męska</p>
		<div class="dropdown">
			<div class="menucontainer">
				<?php
					if (!empty($menu['Moda meska'])) {
					uasort($menu['Moda meska'],'sort_sub');
					foreach ($menu['Moda meska'] as $keymr2=>$mr2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a>'.$keymr2.'</a></div>';
							ksort($mr2);
							foreach ($mr2 as $keymr3=>$mr3) {
								echo '<div class="menu-value-down">
									<a class="asub" menu="Moda meska" r2="'.$keymr2.'" plec="mężczyzna">'.$keymr3.'</a>
								</div>';
							}
						echo '</div>';
					}
					}
				?>
			</div>
			<div class="menucontainer">
				<div style="display: flex;">
					<?php if ($stores['Moda meska']) { ?>
					<div class="menu-value">Sklepy:</div>
					<?php 
						foreach ($stores['Moda meska'] as $store) {
							echo '<a class="tooltip" style="margin: 0 5px 0 5px;">'.$store.'
							<span class="tooltiptext">Najpierw wybierz kategorię, potem ustaw filtr na sklep</span>
							</a>';
						}
					}
					?>
				</div>				
			</div>
		</div>	
</div>

<div class="menu_top">
	<p class="dropdown-toggle">Elektronika</p>
		<div class="dropdown">
			<div class="menucontainer">
				<?php
					if (!empty($menu['Elektronika'])) {
					uasort($menu['Elektronika'],'sort_sub');
					foreach ($menu['Elektronika'] as $keyer2=>$er2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a>'.$keyer2.'</a></div>';
							ksort($er2);
							foreach ($er2 as $keyer3=>$er3) {
								echo '<div class="menu-value-down">
								<a class="asub" menu="Elektronika" r2="'.$keyer2.'">'.$keyer3.'</a></div>';
							}
						echo '</div>';
					}
					}
				?>
			</div>
			<div class="menucontainer">
				<div style="display: flex;">
					<?php if ($stores['Elektronika']) { ?>
					<div class="menu-value">Sklepy:</div>
										
					<?php 
						foreach ($stores['Elektronika'] as $store) {
							echo '<a class="tooltip" style="margin: 0 5px 0 5px;">'.$store.'
							<span class="tooltiptext">Najpierw wybierz kategorię, potem ustaw filtr na sklep</span>
							</a>';
						}
					}
					?>
				</div>				
			</div>
		</div>	
</div>	
	
<div class="menu_top">
	<p class="dropdown-toggle">Biżuteria i Zegarki</p>
		<div class="dropdown">
			<div class="menucontainer">
				<?php
					if (!empty($menu['biz'])) {
					uasort($menu['biz'],'sort_sub');
					foreach ($menu['biz'] as $keybizr2=>$bizr2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a>'.$keybizr2.'</a></div>';
							ksort($bizr2);
							foreach ($bizr2 as $keybizr3=>$bizr3) {
								echo '<div class="menu-value-down">
								<a class="asub" menu="biz" r2="'.$keybizr2.'" plec="Kobieta">'.$keybizr3.'</a></div>';
							}
						echo '</div>';
					}
					}
				?>
				<?php
					if (!empty($menu['biz_kobieta_zegarki'])) {
					uasort($menu['biz_kobieta_zegarki'],'sort_sub');
					foreach ($menu['biz_kobieta_zegarki'] as $keybizr2=>$bizr2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a>Zegarki damskie</a></div>';
							ksort($bizr2);
							foreach ($bizr2 as $keybizr3=>$bizr3) {
								echo '<div class="menu-value-down">
								<a class="asub" menu="biz" r2="'.$keybizr2.'" plec="Kobieta">'.$keybizr3.'</a></div>';
							}
						echo '</div>';
					}
					}
				?>
				<?php
					if (!empty($menu['biz_mezczyzna_zegarki'])) {
					uasort($menu['biz_mezczyzna_zegarki'],'sort_sub');
					foreach ($menu['biz_mezczyzna_zegarki'] as $keybizr2=>$bizr2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a>Zegarki męskie</a></div>';
							ksort($bizr2);
							foreach ($bizr2 as $keybizr3=>$bizr3) {
								echo '<div class="menu-value-down">
								<a class="asub" menu="biz" r2="'.$keybizr2.'" plec="Mężczyzna">'.$keybizr3.'</a></div>';
							}
						echo '</div>';
					}
					}
				?>
			</div>
			<div class="menucontainer">
				<div style="display: flex;">
					<?php if ($stores['biz']) { ?>
					<div class="menu-value">Sklepy:</div>
					<?php 
						foreach ($stores['biz'] as $store) {
						echo '<a class="tooltip" style="margin: 0 5px 0 5px;">'.$store.'
							<span class="tooltiptext">Najpierw wybierz kategorię, potem ustaw filtr na sklep</span>
							</a>';
						}
					}
					?>
				</div>				
			</div>
		</div>	
</div>	

<div class="menu_top">
	<p class="dropdown-toggle">Zdrowie i Uroda</p>
		<div class="dropdown">
			<div class="menucontainer">
				<?php
					if (!empty($menu['zio'])) {
					uasort($menu['zio'],'sort_sub');
					foreach ($menu['zio'] as $keyzior2=>$zior2) { $c++;
						if ($keyzior2 == 'Perfumy') {break;}
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a >'.$keyzior2.'</a></div>';
							ksort($zior2);
							foreach ($zior2 as $keyzior3=>$zior3) {
								echo '<div class="menu-value-down">
								<a class="asub" menu="ziu" r2="'.$keyzior2.'">'.$keyzior3.'</a></div>';
							}
						echo '</div>';
					}
					}
				?>
				<?php
					if (!empty($menu['zio_perfumy'])) {
					uasort($menu['zio_perfumy'],'sort_sub');
					foreach ($menu['zio_perfumy'] as $keyzior2=>$zior2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a >'.$keyzior2.'</a></div>';
							ksort($zior2);
							foreach ($zior2 as $keyzior3=>$zior3) {
								echo '<div class="menu-value-down">
								<a class="asub" menu="ziu" r2="'.$keyzior2.'">'.$keyzior3.'</a></div>';
							}
						echo '</div>';
					}
					}
				?>			
			</div>			
			<div class="menucontainer">
				<div style="display: flex;">
					<?php if ($stores['zio']) { ?>
					<div class="menu-value">Sklepy:</div>
					<?php 
						foreach ($stores['zio'] as $store) {
							echo '<a class="tooltip" style="margin: 0 5px 0 5px;">'.$store.'
							<span class="tooltiptext">Najpierw wybierz kategorię, potem ustaw filtr na sklep</span>
							</a>';
						}
					}
					?>
				</div>				
			</div>
		</div>	
</div>
	
<div class="menu_top">
	<p class="dropdown-toggle">Sport i Rekreacja</p>
		<div class="dropdown">
			<div class="menucontainer">
				<?php
					if (!empty($menu['spo'])) {
					uasort($menu['spo'],'sort_sub');
					foreach ($menu['spo'] as $keyspor2=>$spor2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a >'.$keyspor2.'</a></div>';
							ksort($spor2);
							foreach ($spor2 as $keyspor3=>$spor3) {
								echo '<div class="menu-value-down">
								<a class="asub" menu="spo" r2="'.$keyspor2.'">'.$keyspor3.'</a></div>';
							}
						echo '</div>';
					}
					}
				?>
			</div>
			<div class="menucontainer">
				<div style="display: flex;">
					<?php if ($stores['spo']) { ?>
					<div class="menu-value">Sklepy:</div>
					<?php 
						foreach ($stores['spo'] as $store) {
							echo '<a class="tooltip" style="margin: 0 5px 0 5px;">'.$store.'
							<span class="tooltiptext">Najpierw wybierz kategorię, potem ustaw filtr na sklep</span>
							</a>';
						}
					}
					?>
				</div>				
			</div>
		</div>	
</div>

<!--
<div class="menu_top">
	<p class="dropdown-toggle">Kultura</p>
		<div class="dropdown">
			<div class="menucontainer">
				<?php
					if (!empty($menu['kul'])) {
					uasort($menu['kul'],'sort_sub');
					foreach ($menu['kul'] as $keykulr2=>$kulr2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a >'.$keykulr2.'</a></div>';
							ksort($kulr2);
							foreach ($kulr2 as $keykulr3=>$kulr3) {
								echo '<div class="menu-value-down">
								<a class="asub" menu="kul" r2="'.$keykulr2.'">'.$keykulr3.'</a></div>';
							}
						echo '</div>';
					}
					}
				?>
			</div>
			<div class="menucontainer">
				<?php if ($stores['kul']) { ?>
				<div style="display: flex;">
					<div class="menu-value">Sklepy:</div>
					<?php 						
						foreach ($stores['kul'] as $store) {
							echo '<a class="tooltip" style="margin: 0 5px 0 5px;">'.$store.'
							<span class="tooltiptext">Najpierw wybierz kategorię, potem ustaw filtr na sklep</span>
							</a>';
						}	
					?>
				</div>	
				<?php } ;?>
			</div>
		</div>	
</div>
-->	
<div class="menu_top">
	<p class="dropdown-toggle">Dom i Ogród</p>
		<div class="dropdown">
			<div class="menucontainer">
				<?php
					if (!empty($menu['dio'])) {
					uasort($menu['dio'],'sort_sub');
					foreach ($menu['dio'] as $keydior2=>$dior2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a >'.$keydior2.'</a></div>';
							ksort($dior2);
							foreach ($dior2 as $keydior3=>$dior3) {
								echo '<div class="menu-value-down">
								<a class="asub" menu="dio" r2="'.$keydior2.'">'.$keydior3.'</a></div>';
							}
						echo '</div>';
					}
					}
				?>
			</div>
			<div class="menucontainer">
				<div style="display: flex;">
					<?php if ($stores['dio']) { ?>
					<div class="menu-value">Sklepy:</div>
					<?php 
						foreach ($stores['dio'] as $store) {
							echo '<a class="tooltip" style="margin: 0 5px 0 5px;">'.$store.'
							<span class="tooltiptext">Najpierw wybierz kategorię, potem ustaw filtr na sklep</span>
							</a>';
						}
					}
					?>
				</div>				
			</div>
		</div>	
</div>

<div class="menu_top">
	<p class="dropdown-toggle">Dla Dzieci</p>
		<div class="dropdown">
			<div class="menucontainer">
				<?php
					if (!empty($menu['ddz'])) {
					uasort($menu['ddz'],'sort_sub');
					foreach ($menu['ddz'] as $keyddzr2=>$ddzr2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a >'.$keyddzr2.'</a></div>';
							ksort($ddzr2);
							foreach ($ddzr2 as $keyddzr3=>$ddzr3) {
								echo '<div class="menu-value-down">
								<a class="asub" menu="ddz" r2="'.$keyddzr2.'">'.$keyddzr3.'</a></div>';
							}
						echo '</div>';
					}
					}
				?>
			</div>
			<div class="menucontainer">
				<div style="display: flex;">
					<?php if ($stores['ddz']) { ?>
					<div class="menu-value">Sklepy:</div>
					<?php 
						foreach ($stores['ddz'] as $store) {
							echo '<a class="tooltip" style="margin: 0 5px 0 5px;">'.$store.'
							<span class="tooltiptext">Najpierw wybierz kategorię, potem ustaw filtr na sklep</span>
							</a>';
						}
					}
					?>
				</div>				
			</div>
		</div>	
</div>
	
</div>

