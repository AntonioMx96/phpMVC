<?php

use App\Entities\Post;
use App\Entities\User;

class PostsController extends Controller{
    public function __construct() {
    }

    public function index(){
        $posts=Post::all();
        showOne($posts);
    }
}
