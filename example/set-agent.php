<?php
require __DIR__.'/../vendor/autoload.php';

use efureev\CustomCurl;

$curl = new CustomCurl('http://ya.ru');

$resp = $curl->setUserAgent('Mozilla/3.0 (Win95; I)')->getCmd();

echo $resp;