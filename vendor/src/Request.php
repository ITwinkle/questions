<?php

namespace Vendor;

class Request
{
    private $get;

    private $post;

    private $uri;

    private $method;

    public function __construct()
    {
        array_walk_recursive($_POST, 'trim');
        array_walk_recursive($_GET, 'trim');
        $this->get    = $_GET;
        $this->post   = $_POST;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function get($key = false)
    {
        return ($key)?(isset($this->get[$key])?$this->get[$key]:false):$this->get;
    }

    public function post($key = false)
    {
        return ($key)?(isset($this->post[$key])?$this->post[$key]:false):$this->post;
    }

    public function isGet()
    {
        return 'GET' == $this->getMethod();
    }

    public function isPost()
    {
        return 'POST' == $this->getMethod();
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }
}