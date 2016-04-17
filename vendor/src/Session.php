<?php

namespace Vendor;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function set($name,$val){
        $_SESSION[$name] = $val;
    }

    public function get($name){
        return $this->isExist($name)?$_SESSION[$name] : null;
    }

    public function delete($name){
        if(is_array($name)){
            foreach($name as $n){
                unset($_SESSION[$n]);
            }
        } else {
            unset($_SESSION[$name]);
        }
    }

    public function isExist($name){
        return isset($_SESSION[$name]);
    }
}