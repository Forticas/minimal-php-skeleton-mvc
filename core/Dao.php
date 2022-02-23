<?php

namespace App\core;

class Dao
{

    public static $cnx;

    public static function connect()
    {

        $db_setting = parse_ini_file(__DIR__.'/../config.ini');

        try {
            self::$cnx = new \PDO(
                "mysql:host={$db_setting['host']};dbname={$db_setting['dbname']};port={$db_setting['port']};charset=UTF8",
                $db_setting['username'],
                $db_setting['password']);

        } catch (\PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    public static function getOne($className, $args)
    {
        $classNameLower = strtolower($className);
        $classNameLower = explode("\\", $classNameLower);
        $classNameLower = end($classNameLower);

        $sql = "SELECT * From {$classNameLower} WHERE ";

        foreach (array_keys($args) as $key => $value)
        {
            $sql .= $value.' = :'.$value;
            if($key < count($args)- 1)
            {
                $sql .=' AND ';
            }
        }

        $stmt = self::$cnx->prepare($sql);

        foreach ($args as $key => $value)
        {
            $stmt->bindParam(':'.$key, $value);

        }

        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $className);
        $result = $stmt->fetch();

        return $result;
    }
    public static function getMany($className, $args = [])
    {
        $classNameLower = strtolower($className);
        $classNameLower = explode("\\", $classNameLower);
        $classNameLower = end($classNameLower);

        $sql = "SELECT * From {$classNameLower}";
        if(count($args) != 0)
        {
            $sql .= ' WHERE';
            foreach (array_keys($args) as $key => $value)
            {
                $sql .= $value.' = :'.$value;
                if($key < count($args)- 1)
                {
                    $sql .=' AND ';
                }
            }
        }
        $stmt = self::$cnx->prepare($sql);

        foreach ($args as $key => $value)
        {
            $stmt->bindParam(':'.$key, $value);

        }

        $stmt->execute();

        $stmt->setFetchMode(\PDO::FETCH_CLASS, $className);
        $results = $stmt->fetchAll();

        return $results;
    }

   // TODO
    public static function insert()
    {

    }
    public static function edit()
    {

    }
     public static function delete()
    {

    }

}