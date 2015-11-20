<?php
require __DIR__.'/../vendor/autoload.php';

use efureev\CustomCurl;

$curl = new CustomCurl();

//$cmd = $curl->setURL('https://icrs.nbki.ru/products/B2BRequestServlet')->getCmd();
$resp = $curl->setCurl('/opt/cprocsp/bin/curl')->request('https://icrs.nbki.ru/products/B2BRequestServlet')->getResponse();

//echo $cmd;
echo $resp;