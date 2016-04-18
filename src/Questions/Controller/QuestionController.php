<?php

/**
 *  Question controller
 *
 * @package    questions
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Questions\Controller;

use Questions\Model\Category;
use Vendor\Container;
use Questions\Helpers\Email;
use Questions\Helpers\Random;
use Questions\Model\Answer;
use Questions\Model\Expert;
use Questions\Model\Question;
use Questions\Model\User;

class QuestionController extends BaseController
{
    /**
     * @var Question
     */
    private $model;

    /**
     * QuestionController constructor.
     */
    public function __construct()
    {
        $this->model = new Question();
    }

    /**
     * Get all questions page
     *
     * @return \Vendor\Response\Response
     * @throws \Vendor\Exception
     */
    public function getQuestionsAction()
    {
        $this->checkLogged();
        $id = (new User())->getList(['id'], ['email' => Container::get('session')->get('email')])[0]['id'];
        $questions = $this->model->getList(['question.*, name, answer_text, rating, answer.id answer_id'],
            ['category_id' => $id, 'answer' => $id, 'order' => ['column' => 'question.date',
                'type' => 'desc']]);
        $top = (new Expert())->getTop(5);
        Container::get('session')->set('uri', $_SERVER['REQUEST_URI']);
        return $this->render('questions.php', ['questions' => $questions, 'top' => $top]);
    }

    /**
     * Get one question page
     *
     * @param $id
     * @return \Vendor\Response\Response
     */
    public function getQuestionAction($id)
    {
        $this->checkLogged();
        $question = $this->model->getList(['question.*,name,answer_text'],
            ['current' => $id]);
        return $this->render('show_question.php', ['question' => $question[0]]);
    }

    /**
     * Get page with answer of question
     *
     * @param $hash
     * @return \Vendor\Response\Response
     * @throws \Vendor\Exception
     */
    public function getQuestionAnswerAction($hash)
    {
        Container::get('session')->set('uri', $_SERVER['REQUEST_URI']);
        $question = $this->model->getList(['question.question_text', 'question.id',
            'question.expert_id', 'category.name', 'user.email'], ['category' => '', 'user' => '', 'hash' => $hash])[0];
        return $this->render('answer.php', ['question' => $question, 'hash' => $hash]);
    }

    /**
     * Save answer
     *
     * @return \Vendor\Response\Response
     */
    public function postQuestionAnswerAction()
    {
        $data = $this->getRequest()->post();
        (new Answer())->post(['answer_text' => $data['answer'], 'question_id' => $data['id'], 'expert_id' => $data['expert_id']]);
        Email::sendEmail($data['answer'], 'questions/' . $data['id'], $data['email'], 'answer');
        return $this->render('answer.php');
    }

    /**
     * Get ask page
     *
     * @param $cat
     * @param $id
     * @return \Vendor\Response\Response
     */
    public function getAskAction($cat, $id)
    {
        $this->checkLogged();
        return $this->render('add.php', ['cat' => $cat, 'expert_id' => $id], false);
    }

    /**
     * Save ask
     *
     * @param $cat
     * @param $id
     * @return \Vendor\Response\Response
     * @throws \Vendor\Exception
     */
    public function postAskAction($cat, $id)
    {
        $data = $this->getRequest()->post();
        $data['date'] = (new \DateTime())->format('Y-m-d H:i:s');
        $data['cat'] = $cat;
        $data['expert_id'] = $id;
        $data['hash'] = Random::random_string(10, 'lower,numbers');
        $data['id'] = (new User())->getList(['id'], ['email' => Container::get('session')->get('email')])[0]['id'];
        $data['email'] = (new Expert())->getList(['email'], ['expert' => $data['expert_id']])[0]['email'];
        $data['cat_id'] = (new Category())->getList(['id'], ['name' => $data['cat']])[0]['id'];
        $this->model->post([
            'author_id' => $data['id'],
            'hash' => $data['hash'],
            'question_text' => $data['question'],
            'expert_id' => $data['expert_id'],
            'date' => $data['date'],
            'category_id' => $data['cat_id']
        ]);
        Email::sendEmail($data['question'], 'answer/' . $data['hash'], $data['email'], 'question', Container::get('session')->get('email'));
        return $this->render('add.php', ['data' => $data, 'id' => $id]);
    }
}