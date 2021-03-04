<?php

use App\Entities\User;

class AuthController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function register($request)
    {
        $validate = [];
        if (!isset($request->username)) {
            $validate = $validate + ["username" => "required"];
        }

        if (!isset($request->email)) {
            $validate = $validate + ["email" => "required"];
        }

        if (!isset($request->password)) {
            $validate = $validate + ["password" => "required"];
        }

        if (count($validate) != 0) {
            validateResponse($validate, 400);
        } else {
            try {

                $user = new User();
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = $request->password;
                $user->save();
                response("success", 200);
            } catch (Exception $th) {
                validateResponse($th->errorInfo[2], 400);
            }
        }
    }

    public function update($request)
    {
        $validate = [];

        if (!isset($request->email)) {
            $validate = $validate + ["email" => "required"];
        }
        if (count($validate) != 0) {
            validateResponse($validate, 400);
        } else {

            try {
                $user = User::where("email", $request->email)->first();
                if ($request->username != $user->username) {
                    User::where("email", $request->email)->update([
                        "username" => $request->username
                    ]);
                    response("success", 200);
                } else {
                    response("el nombre usuario: $request->username debe ser difenre al anterior", 400);
                }
                $user->username = $request->username;
                response("success", 200);
            } catch (Exception $th) {
                validateResponse($th->errorInfo[2], 400);
            }
        }
    }
}
