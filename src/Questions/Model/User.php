<?php

namespace Questions\Model;
use Vendor\Model;

class User extends Model
{
    public static function getExperts($cat){
        $query = "select e.* from expert e join category_for_expert cfe on (e.id = cfe.exp_id) join category c
                  on (c.id = cfe.cat_id) where c.name='{$cat}'";
        return self::selectAll($query);
    }

    public static function getExpert($id){
        $query = "select * from expert where id='{$id}'";
        return self::select($query);
    }

    public static function getExpertEmail($id){
        $query = 'select email from expert where id=\''.$id.'\'';
        return self::select($query);
    }

    public static function getUser($email){
        $query = 'select id from user where email=\''.$email.'\'';
        return self::select($query);
    }

    public static function updateColAnswers($id){
        $query = 'update expert set col_answers = col_answers + 1 where id=\''.$id.'\'';
        self::insert($query);
    }

    public static function updateRating($data){
        $query = 'update expert set rating = rating + \''.$data['rat'].'\' where id = \''.$data['id'].'\'';
        self::insert($query);
    }

    public static function search($string){
        $query = 'select e.id, e.name, c.name as cat from expert e join category_for_expert cfe on (e.id = cfe.exp_id) join category c
                  on (c.id = cfe.cat_id) where e.name like \'%'.$string.'%\'';
        return static::selectAll($query);
    }

    public static function top(){
        $query = 'select name, rating/col_answers rat, photo from expert order by rat desc limit 5';
        return self::selectAll($query);
    }
}