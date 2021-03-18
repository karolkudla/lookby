<?php /* Template Name: API */ 
get_header();
if ( is_user_logged_in() ) {
?>
	<div style="width: 100%; display: flex; justify-content: center; margin-top: 20px;">
		<button class="act mod" gid="ajpdx1i8ka7rfxa" file="moda.csv">Moda</button>
		<button class="act ziu" gid="vlx4c3gvhtwts2n" file="ziu.csv">Zdrowie i Uroda</button>
		<button class="act ele" gid="f8h2e8rrvcqedcu" file="ele.csv">Elektronika</button>		
		<button class="act biz" gid="0x8x96atm9q5u96" file="biz.csv">Biżuteria i Zegarki</button>
		<button class="act spo" gid="jjkzzj0ng68izkr" file="sport.csv">Sport</button>
		<button class="act dz" gid="ecs1axzet1k6dnb" file="dz.csv">Dla dziecka</button>
		<button class="act dio" gid="4wvgp4277w3f67m" file="dio.csv">Dom i Ogród</button>
		<button class="act ksi" gid="yyi8xrhek8812xs" file="ksi.csv">Księgarnie</button>
	</div>

	<div style="width: 100%; display: flex; justify-content: center;">
		<button class="conv down ziu" id="54" kat="ziu">Douglas</button>	
		<button class="ns down ziu" id="mac" kat="ziu">MACCosmetics</button>
		<button class="ns down ziu" id="sp" kat="ziu">SuperPharm</button>
		<button class="td down ele" id="22622" kat="ele">MediaMarkt</button>
		<button class="td down ele" id="22405" kat="ele">Sferis</button>
		<button class="awin down ele" id="21081" kat="ele">VOBIS</button>
		<button class="awin down biz" id="20345" kat="biz">W.Kruk</button>
		<button class="awin down biz" id="29261" kat="biz">Time Trend</button>
		<button class="conv down spo" id="108" kat="sport">Decathlon</button>
		<button class="awin down dz" id="20691" kat="dz">5 10 15</button>
		<button class="awin down dio" id="20901" kat="dio">VOX</button>		
	</div>
	<div style="width: 100%; display: flex; justify-content: center;">
		<button class="awin down mod" id="23319" kat="moda">Mosquito</button>
		<button class="awin down mod" id="22949" kat="moda">Badura</button>
		<button class="awin down mod" id="25921" kat="moda">Orsay</button>
		<!--<button class="awin down mod" id="26311" kat="moda">Primamoda</button>-->
		<button class="awin down mod" id="30085" kat="moda">Wittchen</button>
		<button class="awin down mod" id="22341" kat="moda">Guess</button>
		<button class="awin down mod" id="31517" kat="moda">NIKE</button>
		<button class="awin down mod" id="29041" kat="moda">PEEKCLOPPENBURG</button>
		<button class="conv down mod" id="16" kat="moda">Answear</button>
		<button class="conv down mod" id="L21Dj4znm0" kat="moda">Giacomo Conti</button>
		<button class="conv down mod" id="akrD8bGnNx" kat="moda">Bialcon</button>			
	</div>

<div style="width: 100%; display: flex; justify-content: center; align-items: center;">
	<div style="display: flex; align-items: center;">
		<div style="padding: 0 20px 0 0;"><input type="checkbox" id="dont">Nie wyświetlaj tabelki</div>
		<input id="how_many" style="
									width: 80px;
									height: 40px;
    								border-radius: 20px;
    								border: 1px solid lightgray;
    								padding: 0 10px 0 10px;">
		<div style="padding: 20px;">Ilość sprawdzonych produktów:</div>
		<div style="padding: 20px;" id="actual_page"></div>
		<div style="padding: 0 20px 0 0;"><input type="checkbox" id="chdb">Wrzucaj do DB</div>
		<div style="padding: 0 20px 0 0;"><button id="del_db">Usuń całą DB</button></div>
		<div style="padding: 0 20px 0 0;" id="counter"></div>
		<div style="padding: 0 20px 0 0;"><button id="menu_make">Generuj menu</button></div>
		<div style="padding: 0 20px 0 0;"><button id="mf_make">Generuj Most Faved</button></div>
		<div style="padding: 0 20px 0 0;"><button id="fa">FA</button></div>
	</div>
</div>

<div style="width: 100%; display: flex; justify-content: center;">
	<div style="border-right: 1px solid lightgray; padding-right: 5px;">
		<div style="display: flex; justify-content: center;">
			ZNALEZIONE&nbsp<span id="yes"></span>
		</div>
		<table id="znalezione" style="width: 100%; font-size: 10px;">
			<tr>
				<td>Nr</td>
				<td>IMG</td>
				<td>Nazwa</td>
				<td>Znalazłem</td>
				<td>Lookby Kat</td>
				<td>Stara Kat</td>
			</tr>
		</table>
	</div>	
	<div style="padding-left: 5px;">
		<div style="display: flex; justify-content: center;">
			NIE ZNALEZIONE&nbsp<span id="not"></span>
		</div>
		<table id="nie_znalezione" style="width: 100%; font-size: 10px;">
			<tr>
				<td>Nr</td>
				<td>IMG</td>
				<td>Nazwa</td>
				<td>Stara Kat</td>
			</tr>
		</table>
	</div>
</div>

<div id="testy" style="margin: 20px;">
<?php
	$client = new SoapClient('http://ws.tradetracker.com/soap/affiliate?wsdl', array('compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP));
$client->authenticate(204373, 'e0824c28f0f2e94d9247e7d542915eb8331ef913', false, 'pl_PL', false);
 
$affiliateSiteID = 352081;
 
$options = array(
    'campaignCategoryID' => 1508342
);
 
foreach ($client->getFeedProducts($affiliateSiteID, $options) as $product) {
    echo '<h1><a href="' . $product->productURL . '">' . $product->name . '</a></h1>';
    echo '<p>' . $product->description . '</p>';
    echo '<p>' . $product->price . '</p>';
}
	
	highlight_string("<?php\n\$data =\n" . var_export($client, true) . ";\n?>");
	;?>
</div>


<div style="display: none">
	<?php	
}
		get_footer();
	
	?>
</div>


