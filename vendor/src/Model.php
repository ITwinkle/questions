<?php

namespace Vendor;

use Vendor\Container;

class Model
{
    protected $pdo;

    public function __construct(){
        $this->pdo = Container::get('pdo');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getList(array $columns = [], array $parameters = []){
        if(!empty($columns)){

            $query = 'select '.implode(',', $columns).' from '.$this->table;

            $query = $this->buildJoin($query, $parameters);
            $query = $this->buildWhere($query, $parameters);
            $query = $this->buildOther($query, $parameters);

            return $this->pdo->query($query);
        }

        $query = 'select * from '.$this->table;
        return $this->pdo->query($query);
    }

    protected function buildJoin($query, array $parameters = []){
        if(array_key_exists('join', $parameters)){
            $query .= ' join '.$parameters['join']['table'].
                ' ON('.$this->table.'.'.$parameters['join']['fcolumn'].'='.
                $parameters['join']['table'].'.'.$parameters['join']['scolumn'].')';
        }

        return $query;
    }

    protected function buildWhere($query, array $parameters = []){
        if(array_key_exists('where', $parameters)){
            $query .= ' where '.$parameters['where'];
        }

        return $query;
    }

    protected function buildOther($query, array $parameters = []){
        if(array_key_exists('limit')){
            $query .= ' limit '.$parameters['limit'];
        }

        return $query;
    }

    public function post(array $fields, array $parameters = []){
        $query = 'insert into' . $this->table.'('.explode(',',$fields['column']) .
            ' values(' .explode(',',$fields['value']).')';

        $query = $this->buildWhere($query,$parameters);

        return $this->pdo->query($query);
    }

    public function update(array $fields, array $parameters = []){
        $query = 'update '.$this->table.' set ' . $fields['column']. '='. $fields['value'];

        $query = $this->buildWhere($query,$parameters);

        return $this->pdo->query($query);
    }


}