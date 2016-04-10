<?php

namespace Vendor;

use Vendor\Response;
use Vendor\Container;
class Application
{
    public static $config = [];

    public function __construct($config)
    {
        static::$config = include $config;
        session_start();
        Container::set('router',new \Vendor\Router());
        Container::set('request',new \Vendor\Request());
        Container::set('view', new \Vendor\View());
        Container::set('email', new \Vendor\Services\Email());
        try{
            Container::set('pdo', new \PDO(static::$config['pdo']['connect'],
                static::$config['pdo']['username'],
                static::$config['pdo']['password']));
            Model::setPDO();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        Container::get('router')->set(static::$config['routes']);
    }

    public function run(){
        $route = Container::get('router')->getRoute();
        $controllerClass = $route['controller'];
        $actionClass = $route['action'].'Action';
        try{
            if (class_exists($controllerClass)) {
                $refl = new \ReflectionClass($controllerClass);
            } else {
                echo 'No such controller';
            }
            if ($refl->hasMethod($actionClass)) {
                $controller     = $refl->newInstance();
                $action         = $refl->getMethod($actionClass);
                unset($route['controller'],$route['action']);
                $response = $action->invokeArgs($controller,$route);
                $response->send();

            } else {
                echo 'No such method';
            }
        } catch (Exception $e){
          echo "ERROR";
        }
    }

    public function __destruct()
    {
        Container::delete('pdo');
    }
}
