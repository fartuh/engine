<?php

use \core\Controller;

Controller::action('reg');

?>
<!DOCTYPE html>
<html lang="ru">
<head>
        <meta charset="UTF-8">
        <title></title>
</head>
<script>
    function valForm(){
        var pass1 = document.getElementsByName('pass')[0].value;
        var pass2 = document.getElementsByName('pass_repeat')[0].value;

        if(pass1 == pass2 && pass1 != '' && pass2 != ''){
            return true;
        }
        else{
            var p = document.getElementById('not');
            if(p){
                return false;
            }
            var body = document.getElementsByTagName('body')[0];
            var text = document.createTextNode('Пароли не совпадают');
            var p = document.createElement('h5');
            p.appendChild(text);
            p.id = 'not';
            body.appendChild(p);
            return false;
        }
    }
</script>

<body>
    <h1>Регистрация</h1>
    <a href="<?= Controller::url('auth') ?>">Авторизация</a>
    <form action="" method="post">
        <label for="">Ваш логин<br/><input required type="text" name="login"><br/></label>
        <label for="">Ваш ник(будет виден всем участникам сайта)<br/><input required type="text" name="nic"><br/></label>
        <label for="">Ваш Вконтакте (увиличит шансы восстановления аккаунта при утере пароля)<br/><input type="text" name="vk"><br/></label>
        <label for="">Ваш skype (увиличит шансы восстановления аккаунта при утере пароля)<br/><input type="text" name="skype"><br/></label>
        <label for="">Ваш Пароль<br/><input required type="text" name="pass"><br/></label>
        <label for="">Повтрите Пароль<br/><input required type="text" name="pass_repeat"><br/></label>
        <label for="">Секретное слово для восстановления аккаунта<br/><input required type="text" name="secret"><br/></label>
        <label for=""><input type="checkbox" name="remember" value="remember">Запомнить меня при входе<br/><br/></label>
        <input type="submit" onclick="return valForm()" value="Войти">
    </form>
</body>
</html>
