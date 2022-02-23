<?php

require_once __DIR__ . '/../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
// TODO organiser la partie configuration
$config = parse_ini_file(__DIR__ . "/../config.ini");

define('BASE_URI', $config['base_uri']);


$request = $_SERVER['REQUEST_URI'];




// TODO creer un routeur

switch ($request) {
    case BASE_URI . '/':
        {
            // afficher page d'accueil

        }
        break;
    case BASE_URI . '/posts':
        {

            $pc = new \App\controller\PostController();
            $pc->list();

        }
        break;
    case BASE_URI . '/post/#variable':
        {
            // TODO remodifier le routeur
            $pc = new \App\controller\PostController();
            //$pc->show($id);

        }
        break;
}
