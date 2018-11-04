<?php

namespace core;

class Model
{

    private static $db = null;

    public static function connect(array $data){
        $host = $data['host'];
        $dbname = $data['dbname'];
        $charset = $data['charset'];
        self::$db = new \PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $data['user'], $data['pass']);
    }

    public static function query($query){
        return self::$db->query($query);
    }

    public static function prepare($query){
        return self::$db->prepare($query);
    }

}
