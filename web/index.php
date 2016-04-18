<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once(__DIR__.'/../vendor/autoload.php');

use Vendor\Response\Response;
use Vendor\Container;
use Vendor\Application;
try{
    $app = (new \Vendor\Application(__DIR__.'/../app/config/config.php'))->run();
} catch(Exception $e){
    (new Response(Container::get('view')->render(Application::$config['error404'])))->send();
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}