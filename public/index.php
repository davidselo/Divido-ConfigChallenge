<?php
// bootstrap to load all the examples.

// Setting up autoload.
include('./autoload.php');


// Load json File using config object.
use Loader\Config;

$_configType = 'json';
$config = new Config($_configType);
try {
    $baseConfig = $config->loadConfigFiles(
        ['config.json', 'config.local.json', 'config.payments.json', 'config.payments.klarna.json']
    );

    var_dump($config->getConfig());
    exit;
} catch (Exception $e) {
    var_dump($e->getMessage());
}


