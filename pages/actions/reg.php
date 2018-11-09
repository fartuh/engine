<?php

use core\Model;
use core\Controller;

if(isset($_POST['login']) && isset($_POST['pass'])){

    if(isset($_POST['remember'])) $remember = $_POST['remember'];
    else $remember = false;

    $login = trim($_POST['login']);
    $pass_c = Controller::crypt(strip_tags(trim($_POST['pass'])));
    $pass = strip_tags(trim($_POST['pass']));
    $nic = trim($_POST['nic']);
    $vk = trim($_POST['vk']);
    $skype = trim($_POST['skype']);
    $secret_c = Controller::crypt(strip_tags(trim($_POST['secret'])));
    $secret = strip_tags(trim($_POST['secret']));
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
            $result = $stmt->execute([$login, $pass_c, $nic, $vk, $skype, $secret_c, $ip]);

            $stmt = Model::prepare('SELECT * FROM users WHERE login = ?');
            $stmt->execute([$login]);
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);

            if($remember == 'remember') $_SESSION['id'] = $data['id'];
            else setcookie('id', $data['id'], time() + 60*60*24);
            $url = Controller::url('profile');
            $f = fopen(ROOT . "user_data/$login.txt", "a+");
            fwrite($f, "login=$login\npass=$pass\nnic=$nic\nvk=$vk\nskype=$skype\nsecret=$secret\nip=$ip");
            fclose($f);
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
