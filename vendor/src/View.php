<?php

namespace Vendor;

class View
{
    public static  $renderPath;

    private $view = '';

    private $_vars = array();

    public function __construct(){
        static::$renderPath = __DIR__.'/../../src/Questions/View/';
        $this->set('route',function($name){return Container::get('router')->generateRoute($name);} );
    }

    public function set($var, $value = '')
    {
        if (is_array($var)) {
            $this->_vars = array_merge($this->_vars, $var);
        } else {
            $this->_vars[$var] = $value;
        }
        return $this;
    }


    public function render($view, $vars = '')
    {
        if($view == Application::$config['layout']){
            $this->view = $view;
        } else {
            $this->view = $view;
        }
        if(!empty($vars)){
            $this->_vars = array_merge($this->_vars, $vars);
        }
        ob_start();
        extract($this->_vars);
        include $this->view;
        return ob_get_clean();
    }
}
