<?php
class Controller extends Auth
{
    public function __construct()
    {
        ob_clean();
        Session::start();
    }
}
