<?php

session_start();

// Defines
define('ROOT', __DIR__ . '/');

$banned = glob(ROOT . "banned/*.txt");

foreach($banned as $name){
    $data = file($name)[0];
    $data = explode('|', $data);
    $ip = $data[0];
    $time = $data[1];
    if($_SERVER['REMOTE_ADDR'] == $ip){
        if($time+60*5 < time()){
            unlink($name);
            unset($_SESSION['login']);
            unset($_SESSION['ip']);
            break;
        }
        exit('Слишком много попыток, вы забанены на 5 минут');
    }
}
if(!isset($_GET['__page__']) || $_GET['__page__'] == '') define('PAGE', 'profile');
else define('PAGE', strip_tags(trim($_GET['__page__'])));

// Autoload
spl_autoload_register(function ($class) {
    $str = '';
    $c = 0;
    $arr = explode('\\', $class);
    if($arr[0] == 'models')
        return;
        foreach($arr as $path){
            $c += 1;
            if($c == 1){
                $str .= $path;
                continue;
            }
            $str .= '/' . $path;
        }
    require($str . '.php');
});

// Use classes
use core\Controller;
use tests\Test;

$settings = require('settings.php');

require(ROOT . 'core/sets.php');

// Controller gets settings from file
Controller::sets($settings);


// Start engine
if(Controller::isAuth() && (PAGE == 'auth' || PAGE == 'reg')){
    Controller::findPage('profile');
}

if(!Controller::isAuth() && PAGE != 'reg' && PAGE != 'forget' && PAGE != 'instagram'){
    Controller::findPage('auth');
}

Controller::findPage();
