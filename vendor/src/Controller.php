<?php

namespace Vendor;

use Vendor\View;
use Vendor\Response\Response;
use Vendor\Application;

class Controller
{

    public function render($view, $vars = '',$layout = true){
        $class = explode('\\',static::class);
        $class =  substr($class[2],0,strpos($class[2],'Controller'));
        $view = View::$renderPath.$class.'/'.$view;
        if($layout){
            return  new Response(Container::get('view')->render(Application::$config['layout'],
                array('content'=>Container::get('view')->render($view,$vars)))
            );
        } else {
            return new Response(Container::get('view')->render($view,$vars));
        }
    }

    public function getRequest(){
        return new Request();
    }

    public function redirect($uri = ''){
        header('location: '.'/'.trim($uri,'/'));
    }

}