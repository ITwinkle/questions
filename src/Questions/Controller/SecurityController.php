<?php

namespace Questions\Controller;

use Questions\Model\User;
use Vendor\Controller;
use Vendor\Services\GoogleAuth;

class SecurityController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $googleClient = new \Google_Client;
        $this->auth =  new GoogleAuth($googleClient);
    }

    public function loginAction(){

        if($this->auth->checkRedirectCode()){
            $_SESSION['email'] = $this->auth->getPayload()['email'];
            $this->redirect('questions');
        } else {
            return $this->render('login.php', ['auth' => $this->auth]);
        }
    }

    public function logoutAction(){
        unset($_SESSION['access_token']);
        $this->redirect();
    }

    public function checkLogged(){
        if(isset($_SESSION['access_token'])){
            return true;
        }
        return false;
    }

}