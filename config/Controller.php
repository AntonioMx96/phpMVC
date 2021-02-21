<?php

class Controller extends App
{

    public function __construct()
    {
        Session::start();
        $this->view = new Views();
    }
}