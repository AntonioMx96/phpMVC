<?php

use App\Entities\User;
use Illuminate\Database\Eloquent\InvalidCastException;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

   public function index(){
       $user = User::all();
       showOne($user);
   }
}
