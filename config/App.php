<?php
require_once 'config/Template.php';
require_once 'config/autoload.php';
require_once 'config/Helpers.php';
require_once 'config/Views.php';
error_reporting(E_ALL ^ E_NOTICE);

class App
{
    private $request = "";
    private $controller = "";
    private $method = "";
    private $args = "";
    private $page = "";

    public function __construct()
    {
        $this->loadURL();
        $this->loadRequest();
        $this->loadController();
        $this->loadActions();

        // deb($this->request);
        // deb($this->controller);
        // deb($this->method);
        // deb($this->args);
    }

    public function loadURL()
    {
        //condicion para cargar url
        if ($_SERVER['REQUEST_URI'] == '/') {
            //cargamos "/home/index" si en la url solo es la raiz
            $uri = "/home/index";
        } else {
            //cargamos toda la url
            $uri = $_SERVER['REQUEST_URI'];
        }

        //dividimos la url por /
        $uriParts = explode('/', $uri);
        array_shift($uriParts);
        if ($uriParts[count($uriParts) - 1] == '') {
            array_pop($uriParts);
        }

        switch (count($uriParts)) {
            case 1:
                $this->controller = ucwords($uriParts[0]) . 'Controller';
                break;
            case 2:
                $this->controller = ucwords($uriParts[0]) . 'Controller';
                $this->method = $uriParts[1];
                break;
            case 3:
                $this->controller = ucwords($uriParts[0]) . 'Controller';
                $this->method = $uriParts[1];
                $this->args = $uriParts[2];
                break;
            default:

                break;
        }
    }

    public function loadRequest()
    {
        //cargamos el request
        $request = file_get_contents("php://input");
        $this->request = (object) json_decode($request, true);
    }


    public function loadController()
    {
        //llama a los controladores
        $controllerPath = CONTROLLERS . $this->controller . '.php';
        if (file_exists($controllerPath)) {
            require_once $controllerPath;
        } else {
            require_once("./App/Controllers/ErrorsController.php");
        }
    }

    public function loadActions()
    {
        $controller = new $this->controller();
        $request_method = $_SERVER["REQUEST_METHOD"];


        switch ($request_method) {
            case 'GET':
                if ($this->method == "") {
                    $this->method = "index";
                }
                $validateMethod = $this->validateMethod();

                if ($validateMethod) {
                    if ($this->args != '') {
                        $controller->{$this->method}($this->args);
                    } else {
                        $controller->{$this->method}("");
                    }
                } else if (is_numeric(($this->method))) {
                    $this->args = $this->method;
                    $this->method = "index";
                    $controller->{$this->method}($this->args);
                }
                break;
            case 'POST':
                ($this->method=="")?$this->method = "store" : null;

                $controller->{$this->method}($this->request);
                # code...
                break;
            case 'PUT':
                $this->method = "update";
                $controller->{$this->method}($this->request);
                # code...
                break;
            case 'DELETE':
                $this->method = "delete";
                $controller->{$this->method}($this->request);
                # code...
                break;
            default:
                # code...
                break;
        }
    }

    public function validateMethod()
    {
        $controller = new $this->controller();
        if (isset($this->method)) {
            if (method_exists($controller, $this->method)) {
                return true;
            }
        }
    }
}
