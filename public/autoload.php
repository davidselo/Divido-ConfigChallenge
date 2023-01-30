<?php
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('BP', dirname(dirname(__FILE__)));
spl_autoload_register( function($class) {
    $path =   DS .'app'. DS;
    require_once  ".".$path . str_replace('\\', '/', $class) . '.php';
});
