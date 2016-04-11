<?php

namespace Questions\Controller;

use Vendor\Container;
use Questions\Model\Question;
use Questions\Model\User;

class QuestionController extends SecurityController
{
    public function indexAction()
    {
        $categories = Question::getCategories();
        return $this->render('index.php', ['categories' => $categories]);
    }

    public function questionsAction()
    {
        if ($this->checkLogged()) {
            $id = User::getUser($_SESSION['email'])['id'];
            $questions = Question::getQuestions($id);
            $top = User::top();
            return $this->render('questions.php', ['questions' => $questions,'top'=>$top]);
        } else {
            $this->redirect('login');
        }
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
            $this->sendEmail($data['answer'], 'questions/' . $data['id'], $data['email'], 'answer');
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
            $data['hash'] = $this->random_string(10, 'lower,numbers');
            $data['id'] = User::getUser($_SESSION['email'])['id'];
            Question::insertQuestion($data);
            $this->sendEmail($data['question'], 'answer/' . $data['hash'], $id, 'question',$_SESSION['email']);
            return $this->render('add.php', ['data' => $data, 'id' => $id]);
        }
    }

    public function sendEmail($text, $id, $expert_id, $type,$to_exp = false)
    {
        $email_text = 'Hi! You have a ' . $type . ': ' . $text . '<br/>
                       Url: questions.com/' . $id;
        if($to_exp){
            $email_text .= '<br> Author of question: ' . $to_exp;
        }
        $subject = strtoupper($type);
        $to = $expert_id;
        Container::get('email')->send($email_text, $subject, $to);
    }

    private function random_string($length, $chartypes)
    {
        $chartypes_array = explode(",", $chartypes);

        $lower = 'abcdefghijklmnopqrstuvwxyz';
        $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '1234567890';
        $chars = "";

        if (in_array('all', $chartypes_array)) {
            $chars = $lower . $upper . $numbers;
        } else {
            if (in_array('lower', $chartypes_array)) {
                $chars = $lower;
            }
            if (in_array('upper', $chartypes_array)) {
                $chars .= $upper;
            }
            if (in_array('numbers', $chartypes_array)) {
                $chars .= $numbers;
            }
        }

        $chars_length = strlen($chars) - 1;
        $string = $chars{rand(0, $chars_length)};
        for ($i = 1; $i < $length; $i = strlen($string)) {
            $random = $chars{rand(0, $chars_length)};
            if ($random != $string{$i - 1})
                $string .= $random;
        }

        return $string;
    }

}