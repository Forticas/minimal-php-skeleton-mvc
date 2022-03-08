<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Debogger
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();



$config = parse_ini_file(__DIR__ . "/../config.ini");
define('BASE_URI', $config['base_uri']);



// Router
use App\core\Router;

$router = new Router();
/************ Routes *************/
$router->register('/', '\App\controller\DefaultController::home');
$router->register('/contact', '\App\controller\DefaultController::contact');


/************ /Routes *************/
$router->run();


