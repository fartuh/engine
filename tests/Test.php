<?php

namespace tests;

class Test
{
    protected function equal($value1, $value2){
        if($value1 == $value2){
            echo "Значения равны друг другу($value1, $value2)<br />";
            return true;
        }
        echo "Ошибка! Значения не равны друг другу($value1, $value2)<br />";
        return false;
    }
}
