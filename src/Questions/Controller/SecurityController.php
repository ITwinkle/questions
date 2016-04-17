<?php

namespace Questions\Controller;

use Questions\Model\User;
use Vendor\Container;
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
            Container::get('session')->set('email',$this->auth->getPayload()['email']);
            $this->redirect(Container::get('session')->get('uri'));
        } else {
            return $this->render('login.php', ['auth' => $this->auth]);
        }
    }

    public function logoutAction()
    {
        Container::get('session')->delete(['email','access_token']);
        $this->redirect();
    }

}