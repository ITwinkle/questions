<?php
return [
    'index' => [
        'pattern' => '/',
        'controller' => 'Questions\\Controller\\MainController',
        'action' => 'index',
        'method' => 'GET'
    ],
    'getQuestions' => [
        'pattern' => '/questions',
        'controller' => 'Questions\\Controller\\QuestionController',
        'action' => 'getQuestions',
        'method' => 'GET'
    ],
    'getQuestion' => [
        'pattern' => '/questions/{id}',
        'controller' => 'Questions\\Controller\\QuestionController',
        'action' => 'getQuestion',
        'requirements' => [
            'id' => '\d+'
        ],
        'method' => 'GET'
    ],
    'getAnswer' => [
        'pattern' => '/answer/{hash}',
        'controller' => 'Questions\\Controller\\QuestionController',
        'action' => 'getQuestionAnswer',
        'requirements' => [
            'hash' => '[\w\d]+'
        ],
        'method' => 'GET'
    ],
    'postAnswer' => [
        'pattern' => '/answer',
        'controller' => 'Questions\\Controller\\QuestionController',
        'action' => 'postQuestionAnswer',
        'method' => 'POST'
    ],
    'getAsk' => [
        'pattern' => '/{cat}/experts/{exp_id}/ask',
        'controller' => 'Questions\\Controller\\QuestionController',
        'action' => 'getAsk',
        'requirements' => [
            'cat' => '\w+',
            'exp_id' => '\d+'
        ],
        'method' => 'GET'
    ],
    'postAsk' => [
        'pattern' => '/{cat}/experts/{exp_id}/ask',
        'controller' => 'Questions\\Controller\\QuestionController',
        'action' => 'postAsk',
        'requirements' => [
            'cat' => '\w+',
            'exp_id' => '\d+'
        ],
        'method' => 'POST'
    ],
    'login' => [
        'pattern' => '/login',
        'controller' => 'Questions\\Controller\\SecurityController',
        'action' => 'login',
        'method' => 'GET'
    ],
    'logout' => [
        'pattern' => '/logout',
        'controller' => 'Questions\\Controller\\SecurityController',
        'action' => 'logout',
        'method' => 'GET'
    ],
    'getExperts' => [
        'pattern' => '/{cat}/experts',
        'controller' => 'Questions\\Controller\\ExpertController',
        'action' => 'getExperts',
        'requirements' => [
            'cat' => '\w+'
        ],
        'method' => 'GET'
    ],
    'getExpert' => [
        'pattern' => '/{cat}/experts/{id}',
        'controller' => 'Questions\\Controller\\ExpertController',
        'action' => 'getExpert',
        'requirements' => [
            'cat' => '\w+',
            'id' => '\d+'
        ],
        'method' => 'GET'
    ],
    'search' => [
        'pattern' => '/search/{string}',
        'controller' => 'Questions\\Controller\\ExpertController',
        'action' => 'search',
        'requirements' => [
            'string' => '\w+'
        ],
        'method' => 'POST'
    ],
    'postScore' => [
        'pattern' => '/score',
        'controller' => 'Questions\\Controller\\ExpertController',
        'action' => 'postScore',
        'method' => 'POST'
    ]
];