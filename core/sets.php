<?php

if($settings['debug'] == true){
    $tests = require(ROOT . 'tests/do.php');
    foreach($tests as $test){
        $class = "tests\\$test";
        $test = new $class();
    }
    exit();
}

if($settings['db']['on'] == true){
    core\Model::connect($settings['db']); 
}
