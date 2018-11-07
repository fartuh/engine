<?php

use core\Model;
use core\Controller;

if(isset($_POST['login']) && isset($_POST['pass'])){

    if(isset($_POST['remember'])) $remember = $_POST['remember'];
    else $remember = false;

    $login = trim($_POST['login']);
    $pass = Controller::crypt(trim($_POST['pass']));
    $nic = trim($_POST['nic']);
    $vk = trim($_POST['vk']);
    $skype = trim($_POST['skype']);
    $secret = Controller::crypt(trim($_POST['secret']));
    $ip = $_SERVER['REMOTE_ADDR'];

    if(isset($_POST['remember'])) $remember = true;
    else $remember = false;

    $stmt = Model::prepare('SELECT * FROM users WHERE login = ?');
    $stmt->execute([$login]);
    $data = $stmt->fetch(\PDO::FETCH_ASSOC);


    if(!$data){
        $stmt = Model::prepare('SELECT * FROM users WHERE nic = ?');
        $stmt->execute([$nic]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if(!$data){
            $stmt = Model::prepare('INSERT INTO users VALUES(NULL, ?, ?, ?, ?, ?, ?, ?)');
            $result = $stmt->execute([$login, $pass, $nic, $vk, $skype, $secret, $ip]);

            $stmt = Model::prepare('SELECT * FROM users WHERE login = ?');
            $stmt->execute([$login]);
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);

            if($remember == 'remember') $_SESSION['id'] = $data['id'];
            else setcookie('id', $data['id'], time() + 60*60*24);
            $url = Controller::url('profile');
            header("Location: $url");
        }
        else{
            echo 'Ник занят';
        }

    }
    else{
        echo 'Логин занят';
    }

}
