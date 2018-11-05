<?php

use core\Controller;

if(isset($_POST['act'])){
    setcookie('id', '', time() - 3600);
    unset($_SESSION['id']);
    header("Refresh:0");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title></title>
</head>
<body>
    <form action="" method="post"> 
        <input type="hidden" name="act" value="true">
        <input type="submit" value="Выйти">
    </form>
</body>
</html>
