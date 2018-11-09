<?php

namespace core;

class Controller
{
    private static $sets = [];

    public static function sets($sets){
        self::$sets = $sets;
    }

    public static function isAuth(){
        if(isset($_SESSION['id']) || isset($_COOKIE['id'])) return true;
        return false;
    }

    public static function getCurrentAuth(){
        if(isset($_COOKIE['id'])) return $_COOKIE['id'];
        elseif(isset($_SESSION['id'])) return $_SESSION['id'];
        else return false; 
    }

    public static function findPage($page = PAGE, $error = '404'){
        if(file_exists(ROOT . "pages/" . $page . ".php")) require_once('pages/' . $page . ".php");
        else require_once(ROOT . "pages/$error.php");
        exit();
    }

    public static function getFilePath($name){
        $path = ROOT . "pages/actions/$name.php";
        return $path;
    }

    public static function action($action){
        require_once(ROOT . "pages/actions/$action.php");
    }

    public static function crypt($pass){
        return sha1($pass);
    }

    public static function url($url){
        return self::$sets['host'] . '/' . $url;
    }

    public static function getSet($name){
        return self::$sets[$name];
    }
    
}
