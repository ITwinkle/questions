<?php

namespace Vendor;

class Container
{
    static $services = [];

    public static function set($name, $service)
    {
        self::$services[$name] = $service;
    }

    public static function get($name)
    {
        if (isset(self::$services[$name])) {
            if (self::$services[$name] instanceof \Closure) {
                $class = call_user_func(self::$services[$name]);
            } elseif (is_string(self::$services[$name])) {
                $class = new self::$services[$name];
            } else {
                $class = self::$services[$name];
            }
            return $class;
        } else {
            //throw new Exception('No such service in container');
        }
    }

    public static function delete($name){
        unset(self::$services[$name]);
    }
}