<?php

use App\Entities\Post;
use App\Entities\User;

class PostUserController extends Controller
{
    public function index($id)
    {
        $posts = Post::where("users_id", $id)->orderBy('created_at', 'DESC')->get();
        showOne($posts);
    }

    public function store($request)
    {
        $validate = [];
        if (!isset($request->post)) {
            $validate = $validate + ["post" => "required"];
        }

        if (!isset($request->user_id)) {
            $validate = $validate + ["user_id" => "required"];
        }

        if (count($validate) != 0) {
            validateResponse($validate, 400);
        } else {
            try {

                $user = User::find($request->user_id);
                $posts = new Post();
                if ($user) {
                    $posts->post = $request->post;
                    $posts->users_id = $request->user_id;
                    $posts->save();
                    showOne($posts);
                } else {
                    response("El usuario no existe", 400);
                }
            } catch (Exception $th) {
                validateResponse($th->errorInfo[2], 400);
            }
        }
    }
}
