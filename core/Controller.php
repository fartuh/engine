<?php

namespace core;

class Controller
{
    private static $sets = [];

    /*
     * Core's functions
     */

    public static function sets($sets){
        self::$sets = $sets;
    }

    public static function isAuth(){
        if(isset($_SESSION['id']) || isset($_COOKIE['id'])) return true;
        return false;
    }

    public static function getAuth(){
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

    /*
     * User's functions
     */

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
    
    public static function auth($id, $login, $remember, $header = true){
        if($remember == 'remember') $_SESSION['id'] = $id;
        else setcookie('id', $id, time() + 60*60*24);
        $json = self::getUserData($login);
        end($json->ip);
        $key = key($json->ip);
        if($json->ip[$key] != $_SERVER['REMOTE_ADDR']){
            $json->ip[] = $_SERVER['REMOTE_ADDR'];
        }
        $date = date('d.m.Y');
        $json->list->$date[] = date('h:i:s');
        self::putUserData($login, $json);
        if($header = true){
            $url = self::url('profile');
            header("Location: $url");
        }
    
    }

    public static function getUserData($login){
        return json_decode(file_get_contents(ROOT . "user_data/$login.json"));
    }

    public static function putUserData($login, $json){
        file_put_contents(ROOT . "user_data/$login.json", json_encode($json));
    }
}
