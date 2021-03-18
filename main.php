<?php /* Template Name: Lookby */ 
get_header();
?>

<div id="loading"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/img/spin.svg"></div>
<div id="lform"></div>
<div id="login_overlay"></div>
<div id="okienko"></div>
<div id="okienko_overlay"></div>

<div id="header">	
	<div class="col"></div>
	
	<div class="col1">
			<img id="l" src="http://<?php echo $_SERVER['HTTP_HOST'];?>/img/logo.svg">
			<div class="autocomplete-suggestions"></div>
	</div>

	<div class="col2" style="line-height: 1.5">Jedno miejsce.<br>Wszystkie galerie.</div>	
				
<?php include 'menu/menu-mobile.php';?>

<div class="col3">
			<input
			   class="form-control"
			   id="wyszukiwarka"
			   type="search"
			   placeholder="Szukaj w galeriach ..." 
			   autocomplete="off"	   		   			   
		   	/>
			<div class="autocomplete-suggestions-mobile"></div>
</div>		

<div class="col4">
<button id="searchsubmit" class="zobaczymy"><div class="icon-search"></div></button>
</div>
	
<div class="col5">
<div id="klikacz-polubienia">
	<span class="menu-heart" id="header-heart"></span>
	<span id="logged-info"></span>
</div>
</div>
	
<div class="col6"></div>	
<div class="col"></div>		

</div>

<div>
	<main>	

		<img id="banner" src="">
			<?php include 'menu/menu-top.php';?>
		
		<div id="naglowek"></div>

		<div id="ajax"></div>	
		
	</main>
</div>

<?php
get_footer(); 

