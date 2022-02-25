<?php
declare(strict_types=1);

namespace App\core;

class Model
{
    public function __construct()
    {
        Dao::connect();
    }
}