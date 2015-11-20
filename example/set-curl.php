<?php
require __DIR__.'/../vendor/autoload.php';

use efureev\CustomCurl;

$curl = new CustomCurl();

$resp = $curl
		->setCurl('/opt/cprocsp/bin/curl')
		->request('https://icrs.nbki.ru/products/B2BRequestServlet')
		->getResponse();

echo $resp;