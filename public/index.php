<?php
// TODO 1- définir un autoloader
// TODO 2- Utilser les namespaces
require_once __DIR__.'/../core/Controller.php';
require_once __DIR__.'/../controller/PostController.php';



/**************************************/
$request = $_SERVER['REQUEST_URI'];

// TODO organiser la partie configuration
$config = parse_ini_file(__DIR__."/../config.ini");

define('BASE_URI', $config['base_uri']);



// TODO creer un routeur

switch ($request){
    case BASE_URI.'/':
    {
        // afficher page d'accueil

    }
        break;
    case BASE_URI.'/posts':
    {

        $pc = new PostController();
        $pc->list();

    }
        break;
    case BASE_URI.'/post/':
    {
        // TODO remodifier le routeur
        $pc = new PostController();
        $pc->show($_GET['id']);

    }
        break;
}