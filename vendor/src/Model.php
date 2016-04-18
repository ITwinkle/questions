<?php

/**
 *  Model class
 *
 * @package    vendor
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Vendor;

use Vendor\Container;

class Model
{
    /**
     * @var Object
     */
    protected static $pdo;

    /**
     * Set pdo
     *
     * @param $pdo
     */
    public static function setPDO($pdo)
    {
        static::$pdo = $pdo;
        static::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Select fields from table
     *
     * @param array $columns names of fields
     * @param array $parameters
     * @param int $type
     * @return mixed
     */
    public function getList(array $columns = [], array $parameters = [], $type = \PDO::FETCH_ASSOC)
    {
        if (!empty($columns)) {
            $query = 'select ' . implode(',', $columns) . ' from ' . $this->table;
        } else {
            $query = 'select * from ' . $this->table;
        }
        $query = $this->buildJoin($query, $parameters);
        $query = $this->buildWhere($query, $parameters);
        $query = $this->buildOther($query, $parameters);
        return static::$pdo->query($query)->fetchAll($type);
    }

    /**
     * Build join method
     *
     * @param $query
     * @param array $parameters
     * @return mixed
     */
    protected function buildJoin($query, array $parameters = [])
    {
        return $query;
    }

    /**
     * Build where method
     *
     * @param $query
     * @param array $parameters
     * @return string
     */
    protected function buildWhere($query, array $parameters = [])
    {
        if (array_key_exists('where', $parameters)) {
            $query .= ' where ' . $parameters['where'];
        }

        return $query;
    }

    /**
     * Build different parameters of query
     *
     * @param $query
     * @param array $parameters
     * @return string
     */
    protected function buildOther($query, array $parameters = [])
    {
        if (array_key_exists('limit', $parameters)) {
            $query .= ' limit ' . $parameters['limit'];
        }

        if (array_key_exists('order', $parameters)) {
            if (array_key_exists('type', $parameters['order'])) {
                $query .= ' order by ' . $parameters['order']['column'] . ' ' . $parameters['order']['type'];
            } else {
                $query .= ' order by ' . $parameters['column'];
            }
        }

        return $query;
    }

    /**
     * Save fields to table
     *
     * @param array $fields
     */
    public function post(array $fields)
    {
        $query = 'insert into ' . $this->table . '(' . implode(',', array_keys($fields)) .
            ') values(\'' . implode('\',\'', $fields) . '\')';
        static::$pdo->query($query);
    }

    /**
     * Update fields
     *
     * @param array $field
     * @param array $parameters
     */
    public function update(array $field, array $parameters = [])
    {
        $query = 'update ' . $this->table . ' set ' . $field[0] . '= \'' . $field[1] . '\'';

        $query = $this->buildWhere($query, $parameters);
        static::$pdo->query($query);
    }
}