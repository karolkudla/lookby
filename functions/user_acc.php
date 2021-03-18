<?php

function user_acc() {
	
	global $wpdb;
	session_start();
		
	if ($_SESSION["leonidas"]) {
	$logemail = $_SESSION["leonidas"];
	$logtoken = $_SESSION["tokenidas"];

	$check_token = "SELECT email,token,liked,city FROM users WHERE email LIKE '$logemail'";	
	$check_it = $wpdb->get_results($wpdb->prepare($check_token,$check_token));
		
	$user_data = json_decode(json_encode($check_it,true), true);
	$tok_to_decode = $user_data[0][token];
	$un = unserialize($tok_to_decode);

	foreach ($un as $tokens) {
		if (strpos($tokens,$logtoken) !== FALSE) {$login = 'yes';}
	}	
	
	if ($login == 'yes') {
		
	$liked = $user_data[0][liked];
	$liked_sql = "SELECT id,name,price,store,brand,img,likes FROM produkty WHERE id IN ($liked)";
	$liked_get = $wpdb->get_results($wpdb->prepare($liked_sql,$liked_sql));
	$liked_data = json_decode(json_encode($liked_get,true), true);
	
	$city = $user_data[0][city];
	
?>

<div id="user_wrapper">
	<div id="user_panel">
		<div class="panel_inner">
			<div id="powitanie">Witaj, <?php echo $user_data[0][email]; ?></div>
		</div>
		<!--<div class="panel_inner">
			<div class="ml">Moje miasto:</div>
		<div>
			<select id="city-selector-us">
			<option id="my_city" value="<?php echo $user_data[0][city];?>" disabled selected><?php echo $user_data[0][city];?></option>
			<?php
			$root = $_SERVER['DOCUMENT_ROOT'];
			require $root.'/city-selector.php';
			?>
			</select>
		</div>
		</div>-->
		<div class="panel_inner">
			<div class="ml">
				Suma:	
			</div>
			<div id="total">
				0
			</div>			
		</div>		
		<div class="panel_inner">	
			<div><button id="clear"><span class="icon-cross"></span></button></div>
			<div class="ml" style="text-align: center;">Wyczyść</div>
		</div>
		<div class="panel_inner">
			<div><button id="logout"><span class="icon-switch"></span></button></div>
			<div class="ml">Wyloguj</div>
		</div>
	</div>	
</div>

<div id="mostfaved">
	
	<div class="tytulsekcjif">
		<div class="mf_cat_title">
			Moja lista
		</div>
	</div>
	
<div class="blog-layout-grid">

<?php if ($liked !== '') {
	foreach ($liked_data as $key => $row) {	
?>
		
<div class="product" id="post-<?php echo $row[id]; ?>">
				
<div class="outer-div">
		<img class="wp-post-image" src="<?php echo $row[img]; ?>"/>					
		<div class="inner-div-<?php echo $row[id]; ?>">
		<div class="ml-likes">
				<div class="ml price"><?php echo $row[price];?> PLN</div>							
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
	
		<div class="lc"><div class="klikacz-<?php echo $row[id]; ?>"></div></div>
	</div>
			
</div>
	
	<?php 	}} else {echo '<div id="zero_like">Jest tu jeszcze pusto, wszystko przed Tobą!</div>';}?>
	
</div>
	</div>
	
<?php }
	
	else {wp_send_json_success('tokennotmatch');}
		
	} else {wp_send_json_success('unlogged');}
	
	die();
}	

add_action( 'wp_ajax_user_acc', 'user_acc' );
add_action( 'wp_ajax_nopriv_user_acc', 'user_acc' );

function change_city() {

global $wpdb;
session_start();
$new_city = $_POST['newcity'];
$email = $_SESSION['leonidas'];
	
	$sql = "UPDATE users SET city='$new_city' WHERE email = '$email'";
	$go = $wpdb->query($wpdb->prepare($sql,$sql));
	setcookie("lasvegas",$new_city, time() + (86400 * 30), "/");
	
die();	
}

add_action( 'wp_ajax_change_city', 'change_city' );
add_action( 'wp_ajax_nopriv_change_city', 'change_city' );

function clear() {
	
global $wpdb;
session_start();
$email = $_SESSION['leonidas'];

	$del = "UPDATE users SET liked = '' WHERE email = '$email'";
	$do = $wpdb->query($wpdb->prepare($del,$del));
	$_SESSION['likes'] = '';
	
die();		
	
}

add_action( 'wp_ajax_clear', 'clear' );
add_action( 'wp_ajax_nopriv_clear', 'clear' );

?>