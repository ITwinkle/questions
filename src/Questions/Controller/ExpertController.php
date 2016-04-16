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
        $experts = $this->model->getList(['expert.*'],['category_for_expert'=>null,'category'=>$cat]);
        $answer_model = new Answer();
        $rating = $answer_model->getRating();
        $count_answers = $answer_model->getCountAnswers();
        $_SESSION['uri'] = $_SERVER['REQUEST_URI'];
        return $this->render('experts.php', ['experts' => $experts, 'cat' => $cat, 'rating' => $rating,
            'count' => $count_answers]);
    }

    public function searchAction($string){
        $expert = User::search($string);
        if(!empty($expert)){
            return new JsonResponse($expert);
        } else {
            return [];
        }
    }

    public function postScoreAction(){
        $data = $this->getRequest()->post();
        (new Answer())->update(['rating',$data['rat']],['answer'=>$data['id']]);
    }
}