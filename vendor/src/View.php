<?php

namespace Vendor;

class View
{
    /**
     * @var string
     */
    public static $renderPath;

    /**
     * @var string
     */
    private $view = '';

    /**
     * @var array
     */
    private $vars = array();

    public function __construct()
    {
        static::$renderPath = __DIR__ . '/../../src/Questions/View/';
        $this->set('route', function ($name) {
            return Container::get('router')->generateRoute($name);
        });
    }

    /**
     * Set variables
     *
     * @param $var
     * @param string $value
     * @return $this
     */
    public function set($var, $value = '')
    {
        if (is_array($var)) {
            $this->vars = array_merge($this->vars, $var);
        } else {
            $this->vars[$var] = $value;
        }
        return $this;
    }


    /**
     * Render template
     *
     * @param $view
     * @param string $vars
     * @return string
     */
    public function render($view, $vars = '')
    {
        if ($view == Application::$config['layout']) {
            $this->view = $view;
        } else {
            $this->view = $view;
        }
        if (!empty($vars)) {
            $this->vars = array_merge($this->vars, $vars);
        }
        ob_start();
        extract($this->vars);
        include $this->view;
        return ob_get_clean();
    }
}
