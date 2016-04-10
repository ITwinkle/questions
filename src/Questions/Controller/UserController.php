<?php

namespace Questions\Controller;

use Questions\Model\User;

class UserController extends SecurityController
{
    public function showAllExpertsAction($cat){
        if($this->checkLogged()) {
            $experts = User::getExperts($cat);
            return $this->render('experts.php', ['experts' => $experts, 'cat' => $cat]);
        } else{
            $this->redirect('login');
        }
    }

    public function showExpertAction($cat, $id){
        if($this->checkLogged()) {
            $expert = User::getExpert($id);
            return $this->render('expert.php', ['expert' => $expert, 'cat' => $cat]);
        } else {
            $this->redirect('login');
        }
    }}