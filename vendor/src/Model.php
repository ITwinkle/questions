<?php

namespace Vendor;

use Vendor\Container;

class Model
{
    protected static $pdo;

    public static function selectAll($query){
        $pdo = static::$pdo->prepare($query);
        $pdo->setFetchMode(\PDO::FETCH_ASSOC);
        $pdo->execute();
        return $pdo->fetchAll();
    }

    public static function select($query){
        $pdo = static::$pdo->prepare($query);
        $pdo->setFetchMode(\PDO::FETCH_ASSOC);
        $pdo->execute();
        return $pdo->fetch();
    }

    public static function insert($query){
        $pdo = static::$pdo->prepare($query);
        $pdo->execute();
    }

    public static function setPDO(){
        static::$pdo = Container::get('pdo');
        static::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}