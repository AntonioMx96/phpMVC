<?php



require_once './config/Template.php';

class App
{
    const CONFIG = 'config/';
    private $controller = "";
    private $method = "";
    private $args = "";
    public function __construct()
    {
        if ($_SERVER['REQUEST_URI'] != '/') {
            $uri = $_SERVER['REQUEST_URI'];
        } else {
            $uri = "/home/index";
        }
        $uriParts = explode('/', $uri);
        array_shift($uriParts); //alimina el primer elemento de un arreglo

        $this->controller = ucwords($uriParts[0]).'Controller';
        if(count($uriParts)<=1){
            $this->method="index";
        }else{
            $this->method=$uriParts[1];
        }
        if(count($uriParts)==2){
            $this->args="";
        }elseif(count($uriParts)>2){
            $this->args=$uriParts[2];
        }
        $this->loadController();
    }

    public function loadController()
    {

        //evalua si tiene un clase cargada
        spl_autoload_register(function ($class) {

            if (file_exists('config/' . $class . ".php")) {
                require 'config/' . $class . ".php";
            }
        });

        //llama a los controladores
        $controllerPath = 'App/Controllers/' . $this->controller . '.php';
      
        $request = $_POST;
        if (file_exists($controllerPath)) {
            require_once $controllerPath;
            $this->controller = new $this->controller();
            if (isset($this->method)) {
                if (method_exists($this->controller, $this->method)) {
                    
                    if ($this->args!='') {
                        $this->controller->{$this->method}($this->args);
                    }else{
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $this->controller->{$this->method}($_POST);
                        }else{
                            $this->controller->{$this->method}();
                        }
                       
                    }
                    
                   
                }
            } else {
                echo "este metodo no existe";
            }
        } else {
            echo "no Existe este controllador";
        }
    }
}
