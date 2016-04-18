<?php

/**
 *  Security controller
 *
 * @package    questions
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Questions\Controller;

use Questions\Model\User;
use Vendor\Container;
use Vendor\Controller;
use Vendor\Auth\GoogleAuth;
use Vendor\Model;

class SecurityController extends Controller
{
    /**
     * @var GoogleAuth
     */
    protected $auth;

    /**
     * SecurityController constructor.
     */
    public function __construct()
    {
        $googleClient = new \Google_Client;
        $this->auth = new GoogleAuth($googleClient);
    }

    /**
     * Get login page
     *
     * @return \Vendor\Response\Response
     * @throws \Vendor\Exception
     */
    public function loginAction()
    {
        if ($this->auth->checkRedirectCode()) {
            Container::get('session')->set('email', $this->auth->getPayload()['email']);
            $this->redirect(Container::get('session')->get('uri'));
        } else {
            return $this->render('login.php', ['auth' => $this->auth]);
        }
    }

    /**
     * Logout action
     *
     * @throws \Vendor\Exception
     */
    public function logoutAction()
    {
        Container::get('session')->delete(['email', 'access_token']);
        $this->redirect();
    }
}