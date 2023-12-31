<?php

ini_set('session.cookie_lifetime', '864000');

require '../vendor/autoload.php';

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

session_start();

$router = new Core\Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('login', ['controller' => 'Login', 'action' => 'new']);
$router->add('signup', ['controller' => 'Signup', 'action' => 'new']);
$router->add('logout', ['controller' => 'Login', 'action' => 'destroy']);
$router->add('password/reset/{token:[\da-f]+}', ['controller' => 'password', 'action' => 'reset']);
$router->add('signup/activate/{token:[\da-f]+}', ['controller' => 'signup', 'action' => 'activate']);
// $router->add('{controller}/{action}/{categoryid:[\d]+}');
$router->add('{controller}/{action}');

$url = $_SERVER['QUERY_STRING'];

$router->dispatch($url);
