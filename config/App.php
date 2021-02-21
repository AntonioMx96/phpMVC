<?php
require_once './config/Template.php';
error_reporting(E_ALL ^ E_NOTICE);

class App
{
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
        $this->controller = ucwords($uriParts[0]) . 'Controller';

        if ($uriParts[count($uriParts) - 1] == '') {
            array_pop($uriParts);
        }

        if (count($uriParts) == 1) {
            $this->method = "index";
        } elseif (count($uriParts) <= 2) {
            $this->method = $uriParts[1];
            $this->args = "";
        } elseif (count($uriParts) >= 3) {
            $this->method = $uriParts[1];
            $this->args = $uriParts[2];
        }

        $this->loadController();
        $this->loadActions();
    }

    public function loadController()
    {
        //evalua si tiene un clase cargada
        spl_autoload_register(function ($class) {

            if (file_exists(CONFIG . $class . ".php")) {
                require_once CONFIG . $class . ".php";
            }
        });

        //llama a los controladores
        $controllerPath = CONTROLLERS . $this->controller . '.php';
        if (file_exists($controllerPath)) {
            require_once $controllerPath;
        } else {
            echo "no Existe este controllador";
        }
    }

    public function loadActions()
    {
        $this->controller = new $this->controller();
        if (isset($this->method)) {
            if (method_exists($this->controller, $this->method)) {


                switch ($_SERVER["REQUEST_METHOD"]) {
                    case 'GET':
                        if ($this->args != '') {
                            $this->controller->{$this->method}($this->args);
                        } else {
                            $this->controller->{$this->method}();
                        }
                        break;

                    case 'POST':
                        if ($this->args == '') {
                            $request = (object)$_REQUEST;
                            $this->controller->{$this->method}($request);
                        }
                        break;

                    case 'PUT':
                        if ($this->args != '') {
                            $this->controller->{$this->method}($this->args);
                        } else {
                            $this->response("argumento nosesario para la funcion", 400);
                        }
                        break;

                    case 'PATCH':
                        if ($this->args != '') {
                            $this->controller->{$this->method}($this->args);
                        } else {
                            $this->response("argumento nosesario para la funcion", 400);
                        }
                        break;

                    case 'DELETE':
                        if ($this->args != '') {
                            $this->controller->{$this->method}($this->args);
                        } else {
                            $this->response("argumento nosesario para la funcion", 400);
                        }
                        break;

                    default:
                        if ($this->args != '') {
                            $this->controller->{$this->method}($this->args);
                        } else {
                            $this->controller->{$this->method}();
                        }
                        break;
                }
            } else {
                echo  "este metodo no existe en el controlller";
            }
        }
    }
    public function response(String $message, int $status = 200)
    {
        echo json_encode(['status' => $status, 'message' => $message]);
    }

    public function redirect(){

    }


}
