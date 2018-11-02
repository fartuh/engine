<?php

namespace core;

class Controller
{
    public static function isAuth(){
        if(isset($_SESSION['id']) || isset($_COOKIE['id'])) return true;
        return false;
    }

    public static function getCurrentAuth(){
        if(isset($_COOKIE['id'])) return $_COOKIE['id'];
        elseif(isset($_SESSION['id'])) return $_SESSION['id'];
        else return false; 
    }

    public static function findPage($error='404'){
        if(file_exists(ROOT . "pages/" . PAGE . ".php")) require_once('pages/' . PAGE . ".php");
        else require_once(ROOT . "pages/$error.php");
    }

    public static function page($name){
        require("pages/$name.php");
        exit();
    }

}