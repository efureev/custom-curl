<?php
require __DIR__.'/../vendor/autoload.php';

use efureev\CustomCurl;

$curl = new CustomCurl('https://api.telegram.org/bot{token}/sendMessage');

$bodyMsg = [
	'chat_id' => '@TestBot',
	'text' => 'Test'
];
$json = json_encode($bodyMsg);

$common = $curl
	->setHeaders([
		'Content-Type' => 'application/json'
	])
	->setBody($json); // or setJson($bodyMsg)

echo $common->getCmd().PHP_EOL;

echo $common
	->post()
	->getResponse();