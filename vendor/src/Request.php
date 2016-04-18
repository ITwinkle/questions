<?php

/**
 *  Request class
 *
 * @package    vendor
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Vendor;

class Request
{
    /**
     * @var array
     */
    private $get = [];

    /**
     * @var array
     */
    private $post = [];

    /**
     * @var array
     */
    private $uri = [];

    /**
     * @var string
     */
    private $method = '';

    /**
     * Request constructor.
     */
    public function __construct()
    {
        array_walk_recursive($_POST, 'trim');
        array_walk_recursive($_GET, 'trim');
        $this->get = $_GET;
        $this->post = $_POST;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get params of GET method
     *
     * @param bool $key
     * @return array|bool
     */
    public function get($key = false)
    {
        return ($key) ? (isset($this->get[$key]) ? $this->get[$key] : false) : $this->get;
    }

    /**
     * get params from POST method
     *
     * @param bool $key
     * @return array|bool
     */
    public function post($key = false)
    {
        return ($key) ? (isset($this->post[$key]) ? $this->post[$key] : false) : $this->post;
    }

    /**
     * Check method is GET
     *
     * @return bool
     */
    public function isGet()
    {
        return 'GET' == $this->getMethod();
    }

    /**
     * Check method is POST
     *
     * @return bool
     */
    public function isPost()
    {
        return 'POST' == $this->getMethod();
    }

    /**
     * Get uri
     *
     * @return array
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Get current method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}