<?php
class Controller extends Auth
{
    public function __construct()
    {
        Session::start();
    }
}
