<?php

namespace Questions\Controller;


use Vendor\Container;
use Vendor\Controller;

abstract class BaseController extends Controller
{
    public function __construct()
    {
        if(!Container::get('auth')->checkLogged()){
            $this->redirect('login');
        }
    }
}