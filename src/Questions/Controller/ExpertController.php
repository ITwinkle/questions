<?php

namespace Questions\Controller;

use Vendor\Container;
use Questions\Model\Answer;
use Questions\Model\Expert;
use Vendor\Response\JsonResponse;

class ExpertController extends SecurityController
{
    private $model;

    public function __construct()
    {
        $this->model = new Expert();
    }

    public function getExpertsAction($cat){
        $experts = $this->model->getList(['expert.*'],['category_for_expert'=>null,'category'=>null,'alias'=>$cat]);
        $answer_model = new Answer();
        $rating = $answer_model->getRating();
        $count_answers = $answer_model->getCountAnswers();
        Container::get('session')->set('uri',$_SERVER['REQUEST_URI']);
        return $this->render('experts.php', ['experts' => $experts, 'cat' => $cat, 'rating' => $rating,
            'count' => $count_answers]);
    }

    public function searchAction($string)
    {
        $cat = $this->getRequest()->post()['cat'];
        $experts = $this->model->getList(['expert.*,category.name cat'],
            ['category'=>null,'category_for_expert'=>null,'name'=>$string,'cat'=>$cat]);
//        $answer_model = new Answer();
//        $rating = $answer_model->getRating();
//        $count_answers = $answer_model->getCountAnswers();
        //$data = ['expert'=>$experts,'rating'=>$rating,'answers'=>$count_answers];
        if(!empty($experts)){
            return new JsonResponse($experts);
        } else {
            return [];
        }
    }

    public function postScoreAction(){
        $data = $this->getRequest()->post();
        (new Answer())->update(['rating',$data['rat']],['answer'=>$data['id']]);
    }
}