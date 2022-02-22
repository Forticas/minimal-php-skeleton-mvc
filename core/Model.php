<?php

class Model
{
    public function __construct()
    {
        Dao::connect();
    }
}