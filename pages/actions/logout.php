<?php

use \core\Controller;

setcookie('id', '', time() - 3600);
unset($_SESSION['id']);
$url = Controller::url('auth');
header("Location: $url");
