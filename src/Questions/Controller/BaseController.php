<?php

/**
 *  Base controller
 *
 * @package    questions
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Questions\Controller;

use Vendor\Container;
use Vendor\Controller;

abstract class BaseController extends Controller
{
    /**
     * Check logged user
     *
     * @throws \Vendor\Exception
     */
    protected function checkLogged(){
        if(!Container::get('auth')->checkLogged()){
            $this->redirect('login');
        }
    }
}