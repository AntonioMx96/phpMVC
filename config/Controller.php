<?php

class Controller{

    public function __construct() {
        Session::start();
        $this->view = new Views();
    }

    public function loadModel($model)
    {
        require_once('./App/Entities/'.$model.'.php');
    }

}

