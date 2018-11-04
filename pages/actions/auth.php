<?php

use core\Model;
use core\Controller;

// Проверка на существование логина и пароля
if(isset($_POST['login']) && isset($_POST['pass'])){
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    if(isset($_POST['remember'])) $remember = $_POST['remember'];
    else $remember = false;

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
            if(Controller::crypt($pass) != $data['pass']) echo 'Данные введены неверно'; 
            else{
                if($remember == 'remember') $_SESSION['id'] = $data['id'];
                else setcookie('id', $data['id'], time() + 60*60*24);
                header("Refresh:0");
            }
        }
    }


}
