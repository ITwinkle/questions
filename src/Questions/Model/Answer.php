<?php

namespace Questions\Model;

use Vendor\Model;

class Answer extends Model
{
    public $table = 'answer';

    public function getRating($limit = null){
        if($limit){
            $rating_with_id = $this->getList(['avg(rating) rating, expert_id'],
                ['group'=>'expert_id','limit'=>$limit]);
        } else {
            $rating_with_id = $this->getList(['avg(rating) rating, expert_id'],['group'=>'expert_id']);
        }
        $rating = [];
        foreach($rating_with_id as $rat){
            $rating[$rat['expert_id']] = $rat['rating'];
        }
        return $rating;
    }

    public function getCountAnswers(){
        $answ = $this->getList(['count(answer_text) count,expert_id'],['group'=>'expert_id']);
        $count = [];
        foreach($answ as $answer){
            $count[$answer['expert_id']] = $answer['count'];
        }

        return $count;
    }

    public function buildWhere($query, array $parameters = [])
    {
        if(array_key_exists('expert',$parameters)){
            $query .= ' where expert_id = \''.$parameters['expert'].'\'';
        }

        return $query;
    }


    public function buildJoin($query, array $parameters = [])
    {
        if(array_key_exists('group',$parameters)){
            $query .= ' join expert on(expert.id=answer.expert_id)';
        }

        return $query;
    }

    public function buildOther($query, array $parameters = [])
    {

        if(array_key_exists('group',$parameters)){
            $query .= ' group by '.$parameters['group'];
        }

        return parent::buildOther($query, $parameters);;
    }
}
