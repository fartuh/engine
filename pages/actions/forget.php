<?php

use core\{Controller,Model};

if(isset($_POST['login']) && isset($_POST['secret']) && isset($_POST['newpass']) && $_POST['login'] != '' && $_POST['secret'] != '' && $_POST['newpass'] != ''){
    $login = strip_tags(trim($_POST['login']));
    $secret = Controller::crypt(strip_tags(trim($_POST['secret'])));
    $pass_c = Controller::crypt(strip_tags(trim($_POST['newpass'])));
    $pass = strip_tags(trim($_POST['newpass']));

    $stmt = Model::prepare("SELECT * FROM users WHERE login = ?");
    $result = $stmt->execute([$login]);
    $user_data = $stmt->fetch(\PDO::FETCH_ASSOC);
    if(!isset($user_data['id'])){ 
        echo "Пользователь с таким логином не найден";
    }
    else{
        if($user_data['secret'] == $secret){
            $stmt = Model::prepare("UPDATE users SET pass = ? WHERE id = ?");
            $result = $stmt->execute([$pass_c, $user_data['id']]);
            if(!$result) exit('Ошибка');
            $json_data = Controller::getUserData($login);
            $json_data->pass[] = $pass;
            Controller::putUserData($login, $json_data);
            Controller::auth($user_data['id'], $login, '');
        }
        else{
            echo "Секретное слово введено не верно";
        }
    }
}
