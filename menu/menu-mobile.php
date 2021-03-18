<div id="button-menu-mobile" class="icon-menu"></div>
<div id="modal-menu-mobile">

<?php
$menu_file = file_get_contents($_SERVER['DOCUMENT_ROOT']."/generated/menu.json");		
$menu = json_decode($menu_file, true);	

function sort_sub($a,$b)
	{
		$res= count($b)-count($a);
		return $res;
	}
?>

<div id="menu_logo">		
<div id="logo"><img src="https://<?php echo $_SERVER['HTTP_HOST']?>/img/black.svg"></div>
<div id="slogan">Jedno miejsce.<br>Wszystkie galerie.</div>	
</div>

<div id="mobile-hello" class="menu-value" style="text-align: center;"></div>		
<div id="mobile-city"></div>	
	
<div class="accordion">Moda damska</div>
	<div class="panel">
		<div class="modalmenucontainer">	
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
	</div>	
	
<div class="accordion">Moda męska</div>
	<div class="panel">
		<div class="modalmenucontainer">	
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
	</div>	
	
<div class="accordion">Elektronika</div>
	<div class="panel">
		<div class="modalmenucontainer">	
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
	</div>	
	
<div class="accordion">Zdrowie i Uroda</div>
	<div class="panel">
		<div class="modalmenucontainer">	
			<?php
					if (!empty($menu['zio'])) {
					uasort($menu['zio'],'sort_sub');
					foreach ($menu['zio'] as $keyzior2=>$zior2) { $c++;
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
	</div>	
	
<div class="accordion">Biżuteria i Zegarki</div>
	<div class="panel">
		<div class="modalmenucontainer">	
		<?php
					if (!empty($menu['biz'])) {
					uasort($menu['biz'],'sort_sub');
					foreach ($menu['biz'] as $keybizr2=>$bizr2) { $c++;
						echo '<div class="m-container-'.$c.'">';
						echo '<div class="menu-value"><a>'.$keybizr2.'</a></div>';
							ksort($bizr2);
							foreach ($bizr2 as $keybizr3=>$bizr3) {
								echo '<div class="menu-value-down">
								<a class="asub" menu="biz" r2="'.$keybizr2.'">'.$keybizr3.'</a></div>';
							}
						echo '</div>';
					}
					}
				?>
		</div>
	</div>	
	
<div class="accordion">Sport i rekreacja</div>
	<div class="panel">
		<div class="modalmenucontainer">	
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
	</div>	
	
<div class="accordion">Dla dzieci</div>
	<div class="panel">
		<div class="modalmenucontainer">	
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
</div>	

<div class="accordion">Dom i Ogród</div>
	<div class="panel">
		<div class="modalmenucontainer">	
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
</div>		
	
</div>






	


	
