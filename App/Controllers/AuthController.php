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
        if (isset($request["email"]) && isset($request["password"])) {
            $user = User::where('email', '=', $request["email"])->first();
            if ($user) {
                if ($user->email == $request['email'] && $user->password == $request['password']) {
                    $this->createSession($user->username);
                    echo json_encode(['status' => 200, 'message' => '']);
                } else {
                    echo json_encode(['status' => 400, 'message' => 'Contraseña incorecta']);
                }
            } else {
                echo json_encode(['status' => 400, 'message' => 'Corro no valido']);
            }
        }
    }

    public function signIn($request)
    {
        if (
            isset($request["user"]) && isset($request["email"])
            && isset($request["password"])
        ) {
            #code
        }
    }

    public function index()
    {
        error_reporting(E_ALL ^ E_NOTICE);
        $userName = Session::getSession("User");
        echo $_SESSION['User'];
        if ($userName != "") {
            header("Location: " . URL . "product");
        } else {
            $this->view->render($this, 'login', "Login");
            error_reporting(E_ALL ^ E_NOTICE);
        }
    }
}
