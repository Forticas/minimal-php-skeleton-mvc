<?php
namespace App\core;

class Controller
{
    public function renderView(string $path){
        require_once __DIR__.'/../view/'.$path.'.php';
    }

    public function redirectTo(string $path)
    {
        header("Location: $path");
    }

    public function redirectToRoute(string $path)
    {
        header("Location: {$_SERVER["REQUEST_SCHEME"]}://{$_SERVER["HTTP_HOST"]}".BASE_URI."/$path");
    }

    // TODO définir les autres méthodes utiles
}
