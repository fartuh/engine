<?php

use \core\{Controller,Model};

Controller::action('forget');

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title></title>
</head>
<body>
    <form action="" method="post">
        <label for="">Введите ваш login<br/><input type="text" name="login"><br/></label>
        <label for="">Введите секретное слово, указанное при регистрации<br/><input type="text" name="secret"><br/></label>
        <label for="">Введите новый пароль<br/><input type="text" name="newpass"><br/></label>
        <input type="submit" value="Восстановить аккаунт">
    </form>
</body>
</html>
