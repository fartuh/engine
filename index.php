<?php

session_start();

// Defines
if(!isset($_GET['__page__']) || $_GET['__page__'] == '') define('PAGE', 'profile');
else define('PAGE', strip_tags(trim($_GET['__page__'])));
define('ROOT', __DIR__ . '/');

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
if(!Controller::isAuth() && PAGE != 'reg' && PAGE != 'forget'){
    Controller::findPage('auth');
}

Controller::findPage();
