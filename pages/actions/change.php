<?php

use \core\{Model,Controller};

if(isset($_POST['newpass']) && trim($_POST['newpass']) != ""){
    $pass_c = Controller::crypt(strip_tags(trim($_POST['newpass'])));
    $pass = strip_tags(trim($_POST['newpass']));
    $id = Controller::getAuth();
    $url = Controller::url('profile');
    $stmt = Model::prepare("UPDATE users SET pass = ? WHERE id = ?");
    $result = $stmt->execute([$pass_c, $id]);
    if(!$result) exit('Ошибка');
    $stmt = Model::prepare("SELECT login FROM users WHERE id = ?");
    $result = $stmt->execute([$id]);
    if(!$result) exit('Ошибка');
    $login = $stmt->fetch()[0];

    $json = Controller::getUserData($login);
    $json->pass[] = $pass;
    Controller::putUserData($login, $json);

    header("Location: $url");
}
