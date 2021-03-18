<?php
function mostfaved() {
	
global $wpdb;
global $post;

$mf = file_get_contents($_SERVER['DOCUMENT_ROOT']."/generated/most_faved.json");
$un = json_decode($mf, true);	
	
$miejsce = 'lookby';

$categories = ['Moda','Elektronika','Dom Ogród Biuro','Zdrowie i Uroda','Kultura','Sport i rekreacja','Dla dzieci','Biżuteria i Zegarki'];
	
foreach ($categories as $cat) {
	
if (!empty($un[$miejsce][$cat])) 
	{
?>

<div id="mostfaved">
	<div class="tytulsekcjif">
		<div class="mf_cat_title">
			<?php echo $cat;?>
		</div>
		<div class="ml">
			Najpopularniejsze w kategorii
		</div>	
	</div>
	<div class="blog-layout-grid">			

<?php 
	}
	foreach ($un[$miejsce][$cat] as $dana) {
?>
		
<div class="product" id="post-<?php echo $dana[id];?>">			
	<div class="outer-div">
		<img class="wp-post-image" src="<?php echo $dana[img];?>"/>
		<div class="inner-div-<?php echo $dana[id];?>">
			<div class="ml-likes">
				<div class="ml"><?php echo $dana[price];?> PLN</div>							
			</div>
			<span class="icon-heart-broken" id="heart-<?php echo $dana[id];?>"></span>
		</div>
	</div>
	
<div class="corp-content-wrapper">
		<div class="lc">
			<div class="lc">
				<div id="l-<?php echo $dana[id];?>" class="ml-l"><?php echo $dana[likes]; ?></div>
				&nbsp<div class="ml">polubień</div>
			</div>			
			<div class="ml-r"><?php echo $dana[store]; ?></div>
		</div>
										
		<div style="text-align: center">
			<a class="tytul-<?php echo $dana[id]; ?>"><?php echo $dana[name]; ?></a>
			<div class="ml"><?php echo $dana[brand]; ?></div>
		</div>
	
		<!-- <div class="lc"><div class="klikacz-<?php echo $dana[id]; ?>"></div></div> -->
	</div>
</div>		

<?php } ;?>		
		
</div>
</div>	

<?php
}	
?>


<?php
die();
}	

add_action( 'wp_ajax_mostfaved', 'mostfaved' );
add_action( 'wp_ajax_nopriv_mostfaved', 'mostfaved' );	
?>