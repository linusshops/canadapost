<?php
require __DIR__ . '/../vendor/autoload.php';

$config = json_decode(file_get_contents(__DIR__.'/config.json'), true);
if ($config == false) {
    $user = getenv('CP_USER');
    $pass = getenv('CP_PASSWORD');
} else {
    $user = $config['CP_USER'];
    $pass = $config['CP_PASSWORD'];
}

define('CP_USER', $user);
define('CP_PASSWORD', $pass);
define('CP_SANDBOX_ENDPOINT', "https://ct.soa-gw.canadapost.ca");
define('LOOKUP_CODE', 'H3G2A9');
define('LOOKUP_CITY', 'Montreal');
define('LOOKUP_PROVINCE', 'QC');
define('LOOKUP_LONG', '-73.63908');
define('LOOKUP_LAT', "45.54545");
