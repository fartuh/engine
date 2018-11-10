<?php

use core\Model;
use core\Controller;

// Проверка на существование логина и пароля
if(isset($_POST['login']) && isset($_POST['pass'])){
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    if(isset($_POST['remember'])) $remember = $_POST['remember'];
    else $remember = false;
    $ip = $_SERVER['REMOTE_ADDR'];

    // Проверка на содержание логина и пароля
    if($login == "" || $pass == ""){ 
        echo "Заполните все поля";
    }
    else{
        $stmt = Model::prepare("SELECT * FROM users WHERE login = ?");        
        $stmt->execute([$login]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(!isset($data['id'])) echo 'Данные введены неверно'; 
        else{
            if(Controller::crypt($pass) != $data['pass']){
                echo 'Данные введены неверно'; 
                if(!isset($_SESSION['login'])) $_SESSION['login'] = 1;
                if(!isset($_SESSION['ip'])) $_SESSION['ip'] = $ip;
                if($_SESSION['ip'] == $ip){
                    $_SESSION['login'] += 1;
                    if($_SESSION['login'] >= 5){ 
                        file_put_contents(ROOT . "banned/$ip.txt", $ip."|".time());
                    }
                    
                }
            }
            else{
                unset($_SESSION['login']);
                unset($_SESSION['ip']);
                Controller::auth($data['id'], $login, $remember);
            }
            
        }

    }
}
