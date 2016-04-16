<?php

namespace Questions\Model;

use Vendor\Model;

class Category extends Model
{
    public $table = 'category';

    public function buildWhere($query, array $parameters = [])
    {
        if(array_key_exists('name',$parameters)){
            $query .= ' where name = \''.$parameters['name'].'\'';
        }

        return $query;
    }
}