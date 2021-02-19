<?php 
class Session
 {
     //iniciamos la session
    static function start()
     {
         @session_start();
     }

     //obtenemos el valor de uno de los indices de session
     static function getSession($name){
      
         return $_SESSION[$name];
     }

     //Inicializamos el valor de uno de los inidice de sesion
     static function setSession($name, $data)
     {
         $_SESSION[$name]= $data;
     }

     //destruye la sesion
     static function destroy()
     {
         @session_destroy();
     }
 }