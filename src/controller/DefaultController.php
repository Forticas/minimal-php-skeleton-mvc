<?php

declare(strict_types=1);

namespace App\controller;

use App\core\Controller;

class DefaultController extends Controller
{
    public function home()
    {
        
        $this->renderView('default/home');
    }

    public function contact()
    {
        dd("contact");
    }
}

