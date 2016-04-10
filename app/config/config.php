<?php
return [
    'routes' => include('routes.php'),
    'layout' => __DIR__.'/../../src/Questions/View/layout.php',
    'client_id' => '851756588478-590tqecjfskvultpro6gi6qgers19s9p.apps.googleusercontent.com',
    'secret' => 'dXprGP8fSpsKkCyX3Z21gYLn',
    'pdo' => [
        'connect' => 'mysql:host=localhost;dbname=questions',
        'username' => 'root',
        'password' => 'independent12'
    ]
];