<?php

namespace Questions\Model;

use Vendor\Model;

class Question extends Model{

    public static function getQuestions($id){
        $query = 'select q.*,c.name from question q join category c on(q.category_id=c.id) where q.author_id = \''.$id.'\' order by q.date desc';
        return static::selectAll($query);
    }

    public static function getQuestion($id){
        $query = 'select q.*,c.name from question q join category c on(q.category_id=c.id) where q.id=\''.$id.'\'';
        return self::select($query);
    }

    public static function insertQuestion($data){
        $query = 'select id from category where name=\''.$data['cat'].'\'';
        $cat_id = self::select($query)['id'];
        $query = 'insert into question(author_id,question_text,date,category_id,expert_id,hash)
                  values(\''.$data['id'].'\',\''.$data['question'].'\',\''.
                  $data['date'].'\',\''.$cat_id.'\',\''.$data['expert_id'].'\',\''.$data['hash'].'\')';
        self::insert($query);
    }

    public static function getQuestionAnswer($hash,$id){
        $query = 'select q.question_text,c.name,q.answer,q.id,u.email,q.expert_id from question q
                  join category c on(c.id=q.category_id) join user u on(u.id=q.author_id) where q.hash=\''.$hash.'\'';
        return static::select($query);
    }

    public static function insertAnswer($data){
        $query = 'update question set answer = (\''.$data['answer'].'\') where id=\''.$data['id'].'\'';
        self::insert($query);
        User::updateColAnswers($data['expert_id']);
    }



}