<?php

use App\Entities\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function createSession($user)
    {
        Session::setSession('User', $user);
    }

    public function destroySession()
    {
        Session::destroy();
        header("Location:" . URL);
    }
    public function userLogin($request)
    {
        if (isset($request->email) && isset($request->password)) {
            $user = User::where('email', '=', $request->email)->first();
            if ($user) {
                if ($user->email == $request->email && $user->password == $request->password) {
                    $this->createSession($user->username);
                    $this->response("success");
                } else {
                    $this->response("Correo o Contraseña incorrecta", 400);
                }
            } else {
                $this->response("Correo no registrado", 400);
            }
        }
    }

    public function signIn($request)
    {
        if (
            isset($request["user"]) && isset($request->email)
            && isset($request->password)
        ) {
            #code
        }
    }

    public function index()
    {
        $userName = Session::getSession("User");
        echo $_SESSION['User'];
        if ($userName != "") {
            header("Location: " . URL . "admin");
        } else {
            $this->view->render($this, 'login', "Login", ["hola"=>"holauwu"]);
        }
    }

    public function method()
    {
        echo "metodo";
    }

    public function arg($hola)
    {
        echo "metodo con argumento";
    }
}
