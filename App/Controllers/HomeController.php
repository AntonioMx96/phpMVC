<?php

use App\Entities\User;


class HomeController extends Controller
{
    function  __construct()
    {
        parent::__construct();
    }

    public function index(){

         $users = User::all();
       
        view("home.index","hola uwu", ["users"=>$users]);
    } 
}
