<?php 

class Auth {
       
    function  __construct()
    {
    }
    static function session(){
       error_reporting(E_ALL ^ E_NOTICE);
        $userName=Session::getSession("User");
        if($userName==""){
            header("Location: ".URL);
        }
    }
}