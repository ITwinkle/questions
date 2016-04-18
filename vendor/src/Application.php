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

        Container::set('session', new \Vendor\Session());
        Container::set('pdo', new \PDO(static::$config['pdo']['connect'],
            static::$config['pdo']['username'],
            static::$config['pdo']['password']));
        Model::setPDO(Container::get('pdo'));
        Container::set('auth', new \Vendor\Auth\GoogleAuth());
        Container::set('router',new \Vendor\Router());
        Container::set('request',new \Vendor\Request());
        Container::set('view', new \Vendor\View());
        Container::set('email', new \Vendor\Services\SwiftMailer());
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
                throw new \Exception();
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
                throw new \Exception();
            }
        } catch (Exception $e){
            throw new \Exception();
        }
    }

    public function __destruct()
    {
        Container::delete('pdo');
    }
}
