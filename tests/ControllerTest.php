<?php

namespace tests;

use core\Controller;

class ControllerTest extends Test
{

    public function __construct(){
        $this->auth();
        //$this->pages('lalala');
        $this->actions('auth');
    }

    private function auth(){
        $this->equal(Controller::isAuth(), false);
        $this->equal(Controller::getCurrentAuth(), false);

        $_SESSION['id'] = 1;

        $this->equal(Controller::isAuth(), true);
        $this->equal(Controller::getCurrentAuth(), 1);
        unset($_SESSION['id']);

        $_COOKIE['id'] = 1;
        
        $this->equal(Controller::isAuth(), true);
        $this->equal(Controller::getCurrentAuth(), 1);
        unset($_COOKIE['id']);
    }

    private function pages($page){
        Controller::findPage($page);
    }

    private function actions($name){
        echo Controller::action($name);
    }

}
