<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

$router = new \App\Router();

$router->get('/',     function() {
    return 'home';
});

$router->get('/about', function() {
    return 'about';
});

$router->get('/posts/*', function() {
    return 'posts';
});

$router->get('/index', function() {
    return new App\View('index', ['title' => 'Index Page']);
});

$router->get('/test/*/test2/*' , function($param1 = '', $param2 = '') {
    return "Test page with param1=$param1 param2=$param2";
});

$config = new \App\Config(connect('localhost', 'mysql', 'mysql', 'mysql', 'mysql'));

$application = new \App\Application($router, $config);

$application->run();
