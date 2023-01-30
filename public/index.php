<?php
// bootstrap to load all the examples.

// Setting up autoload.
include('./autoload.php');


// Load json File using config object.
use Loader\Config;

$_configType = 'json';
$config = new Config($_configType);
try {
    $baseConfig = $config->getAdapter()->loadConfig("config.json");
    $overwriteConfig = $config->getAdapter()->overwriteConfig($baseConfig, "config.local.json");
    var_dump($baseConfig);
    exit;
} catch (Exception $e) {
    var_dump($e->getMessage());
}


