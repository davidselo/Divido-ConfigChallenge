<?php
// bootstrap to load all the examples.

// Setting up autoload.
include('./autoload.php');


// Load json File using config object.
use Loader\Config;

$_configType = 'json';
$config = new Config($_configType);
try {

    $config->loadConfigFiles(
        ['config.json', 'config.local.json', 'config.payments.json', 'config.payments.klarna.json']
    );
    $config->loadConfigFiles(
        ['config.payments.local.json']
    );

    echo "=======================================================================\n";
    echo "============================= OverWriting config ======================\n";
    echo "=======================================================================\n";
    echo "The global configuration Array is:\n";
    var_export($config->getConfig());
    echo "\n";
    echo "retrieving get('database')\n";
    $value = $config->get('database');
    var_dump($value);
    echo "\n";
    echo "retrieving get('database.port')\n";
    $value = $config->get('database.port');
    var_dump($value);
    echo "\n";
    echo "=======================================================================\n";
    echo "=======================================================================\n";


} catch (Exception $e) {
    var_dump("Exception: ". $e->getMessage() );
}


