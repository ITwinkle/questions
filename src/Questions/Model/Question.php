<?php

/**
 *  Question model
 *
 * @package    questions
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Questions\Model;

use Vendor\Model;

class Question extends Model
{
    /**
     * @var string
     */
    public $table = 'question';

    /**
     * @inheritdoc
     */
    public function buildWhere($query, array $parameters = [])
    {
        if (array_key_exists('category_id', $parameters)) {
            $query .= ' where question.author_id=\'' . $parameters['category_id'] . '\'';
        }
        if (array_key_exists('current', $parameters)) {
            $query .= ' where question.id=\'' . $parameters['current'] . '\'';
        }
        if (array_key_exists('hash', $parameters)) {
            $query .= ' where question.hash = \'' . $parameters['hash'] . '\'';
        }

        return $query;
    }

    /**
     * @inheritdoc
     */
    public function buildJoin($query, array $parameters = [])
    {
        if (array_key_exists('category_id', $parameters)) {
            $query .= ' join category on(question.category_id=category.id)';
        }

        if (array_key_exists('answer', $parameters)) {
            $query .= ' left join answer on(answer.question_id=question.id)';
        }

        if (array_key_exists('current', $parameters)) {
            $query .= ' left join answer on(answer.question_id=question.id)
             join category on(question.category_id=category.id)';
        }

        if (array_key_exists('user', $parameters)) {
            $query .= ' join user on (user.id=question.author_id)';
        }

        if (array_key_exists('category', $parameters)) {
            $query .= ' join category on (question.category_id=category.id)';
        }

        return $query;
    }
}