<?php

/**
 *  Category model
 *
 * @package    questions
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */


namespace Questions\Model;

use Vendor\Model;

class Category extends Model
{
    /**
     * @var string
     */
    public $table = 'category';

    /**
     * @inheritdoc
     */
    public function buildWhere($query, array $parameters = [])
    {
        if (array_key_exists('name', $parameters)) {
            $query .= ' where name = \'' . $parameters['name'] . '\'';
        }

        return $query;
    }
}