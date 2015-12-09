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
