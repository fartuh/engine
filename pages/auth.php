<?php

use \core\Controller;

Controller::action('auth');

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title></title>
</head>
<body>
    <h1>Авторизация</h1>
    <a href="<?= Controller::url('reg') ?>">Регистрация</a>
    <form action="" method="post">
        <label for="">Логин<br/><input type="text" name="login"><br/></label>
        <label for="">Пароль<br/><input type="password" name="pass"><br/></label>
        <label for=""><input type="checkbox" name="remember" value="remember">Запомнить меня<br/><br/></label>
        <input type="submit" value="Войти">
    </form>
</body>
</html>
