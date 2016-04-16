<?php

namespace Vendor;

use Vendor\Response\Response;
use Vendor\Container;
use Vendor\Response\ResponseInterface;

class Application
{
    public static $config = [];

    public function __construct($config)
    {
        static::$config = include $config;
        session_start();
        try{
            Container::set('pdo', new \PDO(static::$config['pdo']['connect'],
                static::$config['pdo']['username'],
                static::$config['pdo']['password']));
            Model::setPDO(Container::get('pdo'));
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        Container::set('auth', new \Vendor\Auth\GoogleAuth());
        Container::set('router',new \Vendor\Router());
        Container::set('request',new \Vendor\Request());
        Container::set('view', new \Vendor\View());
        Container::set('email', new \Vendor\Services\Email());
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
                (new Response(Container::get('view')->render(static::$config['error404'])))->send();
            }
            if ($refl->hasMethod($actionClass)) {
                $controller     = $refl->newInstance();
                $action         = $refl->getMethod($actionClass);
                unset($route['controller'],$route['action']);
                $response = $action->invokeArgs($controller,$route);
                if($response instanceof ResponseInterface) {
                    $response->send();
                } else {
                    echo $response;
                }

            } else {
                (new Response(Container::get('view')->render(static::$config['error404'])))->send();
            }
        } catch (Exception $e){
            (new Response(Container::get('view')->render(static::$config['error404'])))->send();
        }
    }

    public function __destruct()
    {
        Container::delete('pdo');
    }
}
