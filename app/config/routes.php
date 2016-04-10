<?php
return [
    'index' => [
        'pattern' => '/',
        'controller' => 'Questions\\Controller\\QuestionController',
        'action' => 'index'
    ],
    'questions' => [
        'pattern' => '/questions',
        'controller' => 'Questions\\Controller\\QuestionController',
        'action' => 'questions',
    ],
    'search' => [
        'pattern' => '/search/{string}',
        'controller' => 'Questions\\Controller\\UserController',
        'action' => 'search',
        'requirements' => [
            'string' => '\w+'
        ]
    ],
    'question' => [
        'pattern' => '/questions/{id}',
        'controller' => 'Questions\\Controller\\QuestionController',
        'action' => 'question',
        'requirements' => [
            'id' => '\d+'
        ]
    ],
    'answer' => [
        'pattern' => '/answer/{hash}',
        'controller' => 'Questions\\Controller\\QuestionController',
        'action' => 'questionAnswer',
        'requirements' => [
            'hash' => '[\w\d]+'
        ]
    ],
    'ask' => [
        'pattern' => '/{cat}/experts/{exp_id}/ask',
        'controller' => 'Questions\\Controller\\QuestionController',
        'action' => 'ask',
        'requirements' => [
            'cat' => '\w+',
            'exp_id' => '\d+'
        ]
    ],
    'login' => [
        'pattern' => '/login',
        'controller' => 'Questions\\Controller\\SecurityController',
        'action' => 'login'
    ],
    'logout' => [
        'pattern' => '/logout',
        'controller' => 'Questions\\Controller\\SecurityController',
        'action' => 'logout'
    ],
    'experts' => [
        'pattern' => '/{cat}/experts',
        'controller' => 'Questions\\Controller\\UserController',
        'action' => 'showAllExperts',
        'requirements' => [
            'cat' => '\w+'
        ]
    ],
    'expert' => [
        'pattern' => '/{cat}/experts/{id}',
        'controller' => 'Questions\\Controller\\UserController',
        'action' => 'showExpert',
        'requirements' => [
            'cat' => '\w+',
            'id' => '\d+'
        ]
    ]
];