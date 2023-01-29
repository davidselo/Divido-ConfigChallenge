<?php
// bootstrap to load all the examples.

// Setting up autoload.
include('./autoload.php');


// Load json File using config object.
use Loader\Config;
$_configType = 'json';
$config = new Config($_configType);

var_dump($config->getAdapter()->loadConfig("hola"));


