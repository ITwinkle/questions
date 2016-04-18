<?php

namespace Vendor;

use Vendor\Container;

class Model
{
    protected static $pdo;

    public static function setPDO($pdo){
        static::$pdo = $pdo;
        static::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getList(array $columns = [], array $parameters = [], $type = \PDO::FETCH_ASSOC){
        if(!empty($columns)) {
            $query = 'select ' . implode(',', $columns) . ' from ' . $this->table;
        } else {
            $query = 'select * from '.$this->table;
        }
        $query = $this->buildJoin($query, $parameters);
        $query = $this->buildWhere($query, $parameters);
        $query = $this->buildOther($query, $parameters);
        return static::$pdo->query($query)->fetchAll($type);
    }

    protected function buildJoin($query, array $parameters = []){
        return $query;
    }

    protected function buildWhere($query, array $parameters = []){
        if(array_key_exists('where', $parameters)){
            $query .= ' where '.$parameters['where'];
        }

        return $query;
    }

    protected function buildOther($query, array $parameters = []){
        if(array_key_exists('limit',$parameters)){
            $query .= ' limit '.$parameters['limit'];
        }

        if(array_key_exists('order',$parameters)){
            if(array_key_exists('type',$parameters['order'])){
                $query .= ' order by '.$parameters['order']['column'].' '.$parameters['order']['type'];
            } else {
                $query .= ' order by '.$parameters['column'];
            }
        }

        return $query;
    }

    public function post(array $fields){
        $query = 'insert into ' . $this->table.'('.implode(',',array_keys($fields)) .
            ') values(\'' .implode('\',\'',$fields).'\')';
        static::$pdo->query($query);
    }

    public function update(array $field, array $parameters = []){
        $query = 'update '.$this->table.' set ' . $field[0]. '= \''. $field[1].'\'';

        $query = $this->buildWhere($query,$parameters);
        static::$pdo->query($query);
    }
}