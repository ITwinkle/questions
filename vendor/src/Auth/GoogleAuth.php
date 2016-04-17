<?php

namespace Vendor\Auth;

use Vendor\Application;
use Vendor\Auth\Model\User;
use Vendor\Container;
use Vendor\Model;

class GoogleAuth
{
    protected $client;

    private $model;

    public function __construct(\Google_Client $googleClient = null)
    {
        $this->model = new User();
        $this->client = $googleClient;
        if($this->client){
            $this->client->setClientId(Application::$config['client_id']);
            $this->client->setClientSecret(Application::$config['secret']);
            $this->client->setRedirectUri('http://questions.com/login');
            $this->client->setScopes('email');
        }
    }

    public function checkToken(){
        return Container::get('session')->isExist('access_token');
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
        Container::get('session')->set('access_token',json_decode($token,true)['access_token']);
        $this->client->setAccessToken($token);
    }

    public function getPayload(){
        return $this->client->verifyIdToken()->getAttributes()['payload'];
    }

    protected function storeUser($payload){

        $user = $this->model->getList(['email'],['email' => $payload['email']])[0]['email'];
        if(!$user){
            $this->model->post(['email'=>$payload['email']]);
        }
        $token = json_decode($this->client->getAccessToken(),true)['access_token'];
        $this->model->update(['access_token',$token],
            ['email' => $payload['email']]);
    }

    public function checkLogged()
    {
        if( Container::get('session')->isExist('access_token')){
            $model = new User();
            $access_token = $model->getList(['access_token'],['email' => Container::get('session')->get('email')])[0]['access_token'];
            if($access_token === Container::get('session')->get('access_token')){
                return true;
            }
        }
        return false;
    }
}