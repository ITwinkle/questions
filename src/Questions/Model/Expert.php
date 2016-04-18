<?php

/**
 *  Expert model
 *
 * @package    questions
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Questions\Model;

use Vendor\Model;

class Expert extends Model
{
    /**
     * @var string
     */
    public $table = 'expert';

    /**
     * @inheritdoc
     */
    public function buildWhere($query, array $parameters = [])
    {
        if (array_key_exists('alias', $parameters)) {
            $query .= ' where category.alias = \'' . $parameters['alias'] . '\'';
        }

        if (array_key_exists('name', $parameters)) {
            $query .= ' where expert.name like \'' . $parameters['name'] . '%\'';
        }

        if (array_key_exists('cat', $parameters)) {
            $query .= ' and category.name = \'' . $parameters['cat'] . '\'';
        }

        if (array_key_exists('expert', $parameters)) {
            $query .= ' where id =\'' . $parameters['expert'] . '\'';
        }


        return $query;
    }

    /**
     * @inheritdoc
     */
    public function buildJoin($query, array $parameters = [])
    {
        if (array_key_exists('category_for_expert', $parameters)) {
            $query .= ' join category_for_expert on(category_for_expert.exp_id=expert.id) ';
        }

        if (array_key_exists('category', $parameters)) {
            $query .= ' join category on(category_for_expert.cat_id = category.id)';
        }

        if (array_key_exists('group', $parameters)) {
            $query .= ' join answer on(expert.id=answer.expert_id)';
        }

        return $query;
    }

    /**
     * Get top experts in all categories
     *
     * @param $limit
     * @return mixed
     */
    public function getTop($limit)
    {
        $top = $this->getList(['photo,name, avg(rating) rating'],
            ['group' => 'expert_id', 'limit' => $limit]);
        foreach ($top as $k => $v) {
            $rating[$k] = $v['rating'];
        }

        array_multisort($rating, SORT_DESC, $top);

        return $top;
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

    /**
     * Get result of search
     *
     * @param $string
     * @param $cat
     * @return mixed
     */
    public function getSearchResult($string, $cat)
    {
        $experts = $this->getList(['expert.*,category.name cat'],
            ['category' => null, 'category_for_expert' => null, 'name' => $string, 'cat' => $cat]);
        $answer_model = new Answer();
        $rating = $answer_model->getRating();
        $count_answers = $answer_model->getCountAnswers();
        for ($i = 0; $i < count($experts); $i++) {
            $experts[$i]['rating'] = $rating[$i + 1];
            $experts[$i]['col_answers'] = $count_answers[$i + 1];
        }
        return $experts;
    }
}