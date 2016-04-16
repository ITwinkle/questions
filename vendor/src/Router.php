<?php

namespace Vendor;

use Vendor\Container;

class Router
{
    private $routes = array();

    public function set(array $routes)
    {
        $this->routes = array_merge($this->routes, $routes);
        return $this;
    }

    public function getRoute()
    {
        $uri = explode('?', trim(Container::get('request')->getUri(), '/'));
        $uri = '/' . reset($uri);
        foreach ($this->routes as $name => $route) {
            if(Container::get('request')->getMethod()!=$route['method']){
                continue;
            }
            $pattern = str_replace(array('{', '}'), array('(?P<', '>)'), $route['pattern']);
            if (array_key_exists('requirements', $route)) {
                if (0 !== count($route['requirements'])) {
                    $search = $replace = array();
                    foreach ($route['requirements'] as $key => $value) {
                        $search[] = '<' . $key . '>';
                        $replace[] = '<' . $key . '>' . $value;
                    }
                    $pattern = str_replace($search, $replace, $pattern);
                }
            }
            if (!preg_match('~^' . $pattern . '$~', $uri, $params)) {
                continue;
            }
            $params = array_merge(array('controller' => $route['controller'], 'action' => $route['action']), $params);
            foreach ($params as $key => $value) {
                if (is_int($key)) {
                    unset($params[$key]);
                }
            }
            return $params;
        }
    }

    public function generateRoute($name){
        if(array_key_exists($name,$this->routes)){
            return $this->routes[$name]['pattern'];
        }
        return false;
    }
}