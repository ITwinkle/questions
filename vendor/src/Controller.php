<?php

/**
 *  Controller class
 *
 * @package    vendor
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Vendor;

use Vendor\View;
use Vendor\Response\Response;
use Vendor\Application;

class Controller
{
    /**
     * Render template
     *
     * @param $view name of file
     * @param string $vars variables
     * @param bool $layout
     * @return Response
     * @throws Exception
     */
    public function render($view, $vars = '', $layout = true)
    {
        $class = explode('\\', static::class);
        $class = substr($class[2], 0, strpos($class[2], 'Controller'));
        $view = View::$renderPath . $class . '/' . $view;
        if ($layout) {
            return new Response(Container::get('view')->render(Application::$config['layout'],
                array('content' => Container::get('view')->render($view, $vars)))
            );
        } else {
            return new Response(Container::get('view')->render($view, $vars));
        }
    }

    /**
     * Get object of Request
     *
     * @return Request
     */
    public function getRequest()
    {
        return new Request();
    }

    /**
     * Redirect method
     *
     * @param string $uri
     */
    public function redirect($uri = '')
    {
        header('location: ' . '/' . trim($uri, '/'));
    }

}