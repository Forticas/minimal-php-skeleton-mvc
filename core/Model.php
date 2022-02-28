<?php
declare(strict_types=1);

namespace App\core;

/**
 * Class Model
 * @package App\core
 * @author Houssem TAYECH <houssem@forticas.com>
 */
class Model
{
    public function __construct()
    {
        Dao::connect();
    }
}