<?php

/**
 *  Autoloader class
 *
 * @package    vendor
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

class Autoloader
{
    public static $aliases = [];


    public static function register()
    {
        spl_autoload_register(array(self::class, 'loadClass'));
    }

    public static function addNamespacePath($alias, $dir)
    {
        if (isset(self::$aliases[$alias]) === false) {
            self::$aliases[$alias] = array();
        }
        array_push(self::$aliases[$alias], $dir);
    }

    public static function loadClass($class)
    {
        $alias = $class;
        while (false !== $pos = strrpos($alias, '\\')) {
            $alias = substr($class, 0, $pos + 1);
            $relative_class = substr($class, $pos + 1);
            $mapped_file = self::loadMappedFile($alias, $relative_class);
            if ($mapped_file) {
                return $mapped_file;
            }
            $alias = rtrim($alias, '\\');
        }
        return false;
    }

    protected static function loadMappedFile($alias, $relative_class)
    {
        if (isset(self::$aliases[$alias]) === false) {
            return false;
        }
        foreach (self::$aliases[$alias] as $dir) {
            $file = $dir
                . str_replace('\\', '/', $relative_class)
                . '.php';
            if (self::requireFile($file)) {
                return $file;
            }
        }
        return false;
    }

    protected static function requireFile($file)
    {
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    }
}