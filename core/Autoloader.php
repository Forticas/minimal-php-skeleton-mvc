<?php

class Autoloader
{
    public static function init()
    {
        spl_autoload_register(function ($class_name) {
            $directories = ['controller', 'core', 'model'];
            foreach ($directories as $directory) {
                $filename = __DIR__ . '/../' . $directory . '/' . $class_name . '.php';
                if (file_exists($filename))
                    include __DIR__ . '/../' . $directory . '/' . $class_name . '.php';

            }
        });
    }
}