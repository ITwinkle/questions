<?php

/**
 *  Service container class
 *
 * @package    vendor
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Vendor;

class Container
{
    /**
     * @var array
     */
    static $services = [];

    /**
     * Services
     *
     * @param $name
     * @param $service
     */
    public static function set($name, $service)
    {
        self::$services[$name] = $service;
    }

    /**
     * Get service
     *
     * @param $name
     * @return mixed
     */
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
            throw new Exception('No such service in container');
        }
    }

    /**
     * Delete service from container
     *
     * @param $name
     */
    public static function delete($name)
    {
        unset(self::$services[$name]);
    }
}