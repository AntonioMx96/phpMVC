<?php 

class Auth {
       
    function  __construct()
    {
    }
    static function session(){
        $userName=Session::getSession("User");
        if($userName==""){
            header("Location: ".URL);
        }
    }
}