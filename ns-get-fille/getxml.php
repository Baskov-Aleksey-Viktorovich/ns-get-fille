<?php
include_once 'db.php';

$database = new Database();
$obj = $database->get_token();

//products
$data = $database->get_products($obj->{'access_token'});
$dom = new DOMDocument;
$dom->loadXML($data);
//Save XML as a file
$dom->save(__DIR__.'/products.xml');


//images
$dataimages = $database->get_images($obj->{'access_token'});
$domimages = new DOMDocument;
$domimages->loadXML($dataimages);
//Save XML as a file
$domimages->save(__DIR__.'/images.xml');

?>