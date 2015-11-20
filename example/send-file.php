<?php
require __DIR__.'/../vendor/autoload.php';

use efureev\CustomCurl;

$curl = new CustomCurl('https://icrs.nbki.ru/products/B2BRequestServlet');

$common = $curl
	->setCurl('/opt/cprocsp/bin/curl')
	->setHeaders(array(
		'Content-Type' =>'text/xml',
	))
	->sendFile(__DIR__.'/nbci.nbci');


echo $common->getCmd();

echo $common
	->request()
	->getResponse();