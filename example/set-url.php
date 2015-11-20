<?php
require __DIR__.'/../vendor/autoload.php';

use efureev\CustomCurl;

$curl = new CustomCurl('http://ya.ru');

$resp = $curl->request()->getResponse();

echo $resp;