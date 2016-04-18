<?php

/**
 *  Expert controller
 *
 * @package    questions
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Questions\Controller;

use Vendor\Container;
use Questions\Model\Answer;
use Questions\Model\Expert;
use Vendor\Response\JsonResponse;

class ExpertController extends SecurityController
{
    /**
     * @var Expert
     */
    private $model;

    /**
     * ExpertController constructor.
     */
    public function __construct()
    {
        $this->model = new Expert();
    }

    /**
     * Get all experts
     *
     * @param $cat
     * @return \Vendor\Response\Response
     * @throws \Vendor\Exception
     */
    public function getExpertsAction($cat)
    {
        $experts = $this->model->getList(['expert.*'], ['category_for_expert' => null, 'category' => null, 'alias' => $cat]);
        $answer_model = new Answer();
        $rating = $answer_model->getRating();
        $count_answers = $answer_model->getCountAnswers();
        Container::get('session')->set('uri', $_SERVER['REQUEST_URI']);
        return $this->render('experts.php', ['experts' => $experts, 'cat' => $cat, 'rating' => $rating,
            'count' => $count_answers]);
    }

    /**
     * Search requested string and get result
     *
     * @param $string
     * @return JsonResponse
     */
    public function searchAction($string)
    {
        $cat = $this->getRequest()->post('cat');
        $experts = $this->model->getSearchResult($string, $cat);

        if (!empty($experts)) {
            return new JsonResponse($experts);
        } else {
            return new JsonResponse([]);
        }
    }

    /**
     * Save score
     */
    public function postScoreAction()
    {
        $data = $this->getRequest()->post();
        (new Answer())->update(['rating', $data['rat']], ['answer' => $data['id']]);
    }
}