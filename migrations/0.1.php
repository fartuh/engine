<?php

$pdo = new PDO('mysql:host=localhost;dbname=stealit;charset=utf8', 'root', 'root');


// Таблица users


$stmt = $pdo->prepare("CREATE TABLE users(id INT NOT NULL AUTO_INCREMENT, login VARCHAR(40) UNIQUE, pass varchar(40), nic varchar(40) UNIQUE, vk varchar(30), skype varchar(20), secret VARCHAR(40), last_ip VARCHAR(20) NOT NULL, PRIMARY KEY(id))");

$res = $stmt->execute();

if($res)
    echo "Таблица users создана успешно <br />";
else
    echo "Таблица users не создана <br />";


// Таблица data


$stmt = $pdo->prepare("CREATE TABLE data(id INT NOT NULL AUTO_INCREMENT, user_id INT NOT NULL, data TEXT, PRIMARY KEY(id), FOREIGN KEY(user_id) REFERENCES users(id))");

$res = $stmt->execute();

if($res)
    echo "Таблица data создана успешно <br />";
else
    echo "Таблица data не создана <br />";

