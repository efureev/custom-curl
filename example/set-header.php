<?php
require __DIR__.'/../vendor/autoload.php';

use efureev\CustomCurl;

$curl = new CustomCurl();

$resp = $curl
	->setCurl('/opt/cprocsp/bin/curl')
	->setHeaders(array(
		'content-type' =>'application/octet-stream;charset="windows-1251"'
	))
	->request('https://icrs.nbki.ru/products/B2BRequestServlet')
	->getResponse();

echo $resp;