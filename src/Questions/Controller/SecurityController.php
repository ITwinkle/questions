<?php

namespace Questions\Controller;

use Questions\Model\User;
use Vendor\Controller;
use Vendor\Auth\GoogleAuth;
use Vendor\Model;

class SecurityController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $googleClient = new \Google_Client;
        $this->auth =  new GoogleAuth($googleClient);
    }

    public function loginAction()
    {
        if($this->auth->checkRedirectCode()){
            $_SESSION['email'] = $this->auth->getPayload()['email'];
            $this->redirect();
        } else {
            return $this->render('login.php', ['auth' => $this->auth]);
        }
    }

    public function logoutAction()
    {
        unset($_SESSION['access_token'],$_SESSION['email']);
        $this->redirect();
    }

}