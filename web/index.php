<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once(__DIR__.'/../vendor/autoload.php');
//require_once(__DIR__.'/../vendor/src/Autoloader.php');
//Autoloader::addNamespacePath('Questions\\',__DIR__.'/../src/Questions/');
//Autoloader::addNamespacePath('Vendor\\',__DIR__.'/../vendor/src/');
//Autoloader::register();

$app = (new \Vendor\Application(__DIR__.'/../app/config/config.php'))->run();
