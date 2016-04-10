<?php

namespace Vendor\Services;

use Vendor\Application;
use Vendor\Model;

class GoogleAuth
{
    protected $client;

    public function __construct(\Google_Client $googleClient = null)
    {
        $this->client = $googleClient;
        if($this->client){
            $this->client->setClientId(Application::$config['client_id']);
            $this->client->setClientSecret(Application::$config['secret']);
            $this->client->setRedirectUri('http://questions.com/login');
            $this->client->setScopes('email');
        }
    }

    public function isLoggedIn(){
        return isset($_SESSION['access_token']);
    }

    public function getAuthUrl(){
        return $this->client->createAuthUrl();
    }

    public function checkRedirectCode(){
        if(isset($_GET['code'])){
            $this->client->authenticate($_GET['code']);
            $this->setToken($this->client->getAccessToken());
            $this->storeUser($this->getPayload());
            return true;
        }
        return false;
    }

    public function setToken($token){
        $_SESSION['access_token'] = $token;
        $this->client->setAccessToken($token);
    }

    public function getPayload(){
        return $this->client->verifyIdToken()->getAttributes()['payload'];
    }

    protected function storeUser($payload){
        $select_query = "select email from user where email = '{$payload['email']}'";
            if(!Model::select($select_query)){
            $query = "insert into user(email) values ('{$payload['email']}') on duplicate key UPDATE id=id";
            Model::insert($query);
        }
        return false;
    }
}