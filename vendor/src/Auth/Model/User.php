<?php

namespace Vendor\Auth\Model;

use Vendor\Model;

class User extends Model
{
    public $table = 'user';

    public function buildWhere($query, array $parameters = [])
    {
        if(array_key_exists('email',$parameters)){
            $query .= ' where email = \''.$parameters['email'].'\'';
        }

        return $query;
    }
}