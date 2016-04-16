<?php

namespace Questions\Model;
use Vendor\Model;

class Expert extends Model
{
    public $table = 'expert';



    public function buildWhere($query, array $parameters = [])
    {
        if(array_key_exists('category',$parameters)){
            $query .= ' where category.alias = \''.$parameters['category'].'\'';
        }

        return $query;
    }

    public function buildJoin($query, array $parameters = [])
    {
        if(array_key_exists('category_for_expert',$parameters)){
            $query .= ' join category_for_expert on(category_for_expert.exp_id=expert.id) ';
        }

        if(array_key_exists('category',$parameters)){
            $query .= ' join category on(category_for_expert.cat_id = category.id)';
        }

        if(array_key_exists('group',$parameters)){
            $query .= ' join answer on(expert.id=answer.expert_id)';
        }

        return $query;
    }

    public function getTop($limit){
        $top = $this->getList(['photo,name, avg(rating) rating'],
            ['group'=>'expert_id','limit'=>$limit]);
        foreach($top as $k=>$v){
            $rating[$k] = $v['rating'];
        }

        array_multisort($rating,SORT_DESC,$top);

        return $top;
    }

    public function buildOther($query, array $parameters = [])
    {

        if(array_key_exists('group',$parameters)){
            $query .= ' group by '.$parameters['group'];
        }
        return parent::buildOther($query, $parameters);;
    }
//    public static function search($string){
//        $query = 'select e.id, e.name, c.name as cat from expert e join category_for_expert cfe on (e.id = cfe.exp_id) join category c
//                  on (c.id = cfe.cat_id) where e.name like \'%'.$string.'%\'';
//        return static::selectAll($query);
//    }
}