<?php

use \core\Controller;

Controller::action('change');

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title></title>
</head>
<body>
    <form action="" method="post">
        <a href="<?= Controller::url('profile') ?>">Вернуться в аккаунт</a>
        <br/>
        <label for="">Новый пароль<br/><input type="text" name="newpass"><br/><br/></label>
        <input type="submit" value="Изменить пароль">
    </form>
</body>
</html>
