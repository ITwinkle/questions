<?php

namespace Questions\Controller;

use Questions\Helpers\Email;
use Random;
use Vendor\Container;
use Questions\Model\Question;
use Questions\Model\User;

class QuestionController extends BaseController
{
    public function questionsAction()
    {
            $id = User::getUser($_SESSION['email'])['id'];
            $questions = Question::getQuestions($id);
            $top = User::top();
            return $this->render('questions.php', ['questions' => $questions,'top'=>$top]);
    }

    public function questionAction($id)
    {
        $question = Question::getQuestion($id);
        return $this->render('show_question.php',['question'=>$question]);
    }

    public function questionAnswerAction($hash)
    {
        if ($this->getRequest()->isGet()) {
            $id = User::getUser($_SESSION['email'])['id'];
            $question = Question::getQuestionAnswer($hash, $id);
            return $this->render('answer.php', ['question' => $question, 'hash' => $hash]);
        } else {
            $data = $this->getRequest()->post();
            Question::insertAnswer($data);
            Email::sendEmail($data['answer'], 'questions/' . $data['id'], $data['email'], 'answer');
            return $this->render('answer.php');
        }
    }

    public function askAction($cat, $id)
    {
        if ($this->getRequest()->isGet()) {
            return $this->render('add.php', ['cat' => $cat, 'expert_id' => $id], false);
        } else {
            $data = $this->getRequest()->post();
            $data['date'] = (new \DateTime())->format('Y-m-d H:i:s');
            $data['cat'] = $cat;
            $data['expert_id'] = $id;
            $data['hash'] = Random::random_string(10, 'lower,numbers');
            $data['id'] = User::getUser($_SESSION['email'])['id'];
            Question::insertQuestion($data);
            Email::sendEmail($data['question'], 'answer/' . $data['hash'], $id, 'question',$_SESSION['email']);
            return $this->render('add.php', ['data' => $data, 'id' => $id]);
        }
    }



}