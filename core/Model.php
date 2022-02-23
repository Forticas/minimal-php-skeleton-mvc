<?php

namespace App\core;

class Model
{
    public function __construct()
    {
        Dao::connect();
    }
}