<div class="tytulsekcjif"><div class="mf_cat_title">Kategorie</div></div>
<div class="menucontainer">
	<?php 
				foreach ($cat as $key=>$row) {
					$c++;
					echo '<div class="miasto-container"><div class="menu-title-big"><a>'.str_replace($a,$b,$key).'</a></div><div class="m-container-'.$c.'">';
									foreach ($row as $key=>$value) {
										echo '<div class="menu-value"><a class="asub">'.$value.'</a></div>';
									}
					echo '</div></div>';
				}	
	?>
</div>

<div class="tytulsekcjif"><div class="mf_cat_title">Sklepy</div></div>
<div class="menucontainer">
	<?php
				foreach ($i as $key=>$row) {
					$c ++;
					echo '<div class="miasto-container"><div class="menu-title-big">'.str_replace($a,$b,$key).'</a></div><div class="m-container-'.$c.'">';
						foreach ($row as $key=>$value) {
							echo '<div class="menu-value"><a class="astore">'.$value.'</a></div>';
						}
					echo '</div></div>';
				}	
	?>
</div>

<div class="tytulsekcjif"><div class="mf_cat_title">Marki</div></div>
<div class="menucontainer">
<?php 
				foreach ($m as $key=>$row) {
					$c ++;
					echo '<div class="miasto-container"><div class="menu-title-big"><a>'.str_replace($a,$b,$key).'</a></div><div class="m-container-'.$c.'">';
						foreach ($row as $key=>$value) {
							echo '<div class="menu-value"><a class="abrand">'.$value.'</a></div>';
						}
					echo '</div></div>';
				}	
				?>
</div>

<div class="tytulsekcjif"><div class="mf_cat_title">Galerie</div></div>
<div class="menucontainer">
		<?php 
				foreach ($four as $keyc => $row) {
				$c ++;
				echo '<div class="miasto-container"><div class="menu-title-big"><a class="acity">'.$keyc.'</a></div><div class="m-container-'.$c.'">';
					foreach ($row as $key => $value) {
					echo '<div class="menu-value"><a class="agal" city="'.$keyc.'">'.$value.'</a></div>';
				}
				echo '</div></div>';
				}
				?>
</div>
