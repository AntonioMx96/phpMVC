<?php 

class Auth {
       
    function  __construct()
    {
    }
    static function session(){
        $userName=Session::getSession("User");
        if($userName==""){
            redirect();
        }
    }

    public function destroySession()
    {
        Session::destroy();
    }

    // public function createSession($user)
    // {
    //     //Session::setSession('User', $user);
    // }

    public function crearSesion(){
        echo"hola";
    }
}