<?php

/**
 *  Answer model
 *
 * @package    questions
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Questions\Model;

use Vendor\Model;

class Answer extends Model
{
    /**
     * @var string
     */
    public $table = 'answer';

    /**
     * Get expert's rating
     *
     * @param bool $limit
     * @return array
     */
    public function getRating($limit = null)
    {
        if ($limit) {
            $rating_with_id = $this->getList(['avg(rating) rating, expert_id'],
                ['group' => 'expert_id', 'limit' => $limit]);
        } else {
            $rating_with_id = $this->getList(['avg(rating) rating, expert_id'], ['group' => 'expert_id']);
        }
        $rating = [];
        foreach ($rating_with_id as $rat) {
            $rating[$rat['expert_id']] = $rat['rating'];
        }

        return $rating;
    }

    /**
     * Get expert's count of answers
     *
     * @return array
     */
    public function getCountAnswers()
    {
        $answ = $this->getList(['count(answer_text) count,expert_id'], ['group' => 'expert_id']);
        $count = [];
        foreach ($answ as $answer) {
            $count[$answer['expert_id']] = $answer['count'];
        }

        return $count;
    }

    /**
     * @inheritdoc
     */
    public function buildWhere($query, array $parameters = [])
    {
        if (array_key_exists('answer', $parameters)) {
            $query .= ' where id = \'' . $parameters['answer'] . '\'';
        }
        return $query;
    }


    /**
     * @inheritdoc
     */
    public function buildJoin($query, array $parameters = [])
    {
        if (array_key_exists('group', $parameters)) {
            $query .= ' join expert on(expert.id=answer.expert_id)';
        }

        return $query;
    }

    /**
     * @inheritdoc
     */
    public function buildOther($query, array $parameters = [])
    {

        if (array_key_exists('group', $parameters)) {
            $query .= ' group by ' . $parameters['group'];
        }

        return parent::buildOther($query, $parameters);;
    }
}
