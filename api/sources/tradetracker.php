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
 
 
?>