<?php

namespace Questions\Controller;

use Vendor\Container;
use Vendor\Controller;

abstract class BaseController extends Controller
{
    protected function checkLogged(){
        if(!Container::get('auth')->checkLogged()){
            $this->redirect('login');
        }
    }
}