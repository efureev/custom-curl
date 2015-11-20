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
$resp = $common
	->complete(
		// clear digital sign
		function($cCurl) {
			/** @var CustomCurl $cCurl */
			$response = $cCurl->getResponse();
			$startPos = strpos($response, '<?xml version="1.0" encoding="windows-1251"?>');
			$endPos = strpos($response, "</product>" . chr(160) . chr(130)); //{ ‚}
			$l = strlen($response);
			$strLen = $l - $startPos - ($l - ($endPos + strlen("</product>")));
			$response = substr($response, $startPos, $strLen);
			$response = iconv('windows-1251', 'utf-8', $response);
			$cCurl->setResponse($response);

	})
	->request()
	->getResponse();


echo $resp;