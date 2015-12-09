<?php
require __DIR__ . '/../vendor/autoload.php';

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
if ($config == false) {
    $user = getenv('CP_USER');
    $pass = getenv('CP_PASSWORD');
    $code = getenv('LOOKUP_CODE');
    $city = getenv('LOOKUP_CITY');
    $province = getenv('LOOKUP_PROVINCE');
    $long = getenv('LOOKUP_LONG');
    $lat = getenv('LOOKUP_LAT');
} else {
    $user = $config['CP_USER'];
    $pass = $config['CP_PASSWORD'];
    $code = $config['LOOKUP_CODE'];
    $city = $config['LOOKUP_CITY'];
    $province = $config['LOOKUP_PROVINCE'];
    $long = $config['LOOKUP_LONG'];
    $lat = $config['LOOKUP_LAT'];
}

define('CP_USER', $user);
define('CP_PASSWORD', $pass);
define('LOOKUP_CODE', $code);
define('LOOKUP_CITY', $city);
define('LOOKUP_PROVINCE', $province);
define('LOOKUP_LONG', $long);
define('LOOKUP_LAT', $lat);
