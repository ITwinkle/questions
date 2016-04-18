<?php

/**
 *  User model
 *
 * @package    questions
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Questions\Model;

use Vendor\Model;

class User extends Model
{
    /**
     * @var string
     */
    public $table = 'user';

    /**
     * @inheritdoc
     */
    public function buildWhere($query, array $parameters = [])
    {
        if (array_key_exists('email', $parameters)) {
            $query .= ' where email = \'' . $parameters['email'] . '\'';
        }

        return $query;
    }
}