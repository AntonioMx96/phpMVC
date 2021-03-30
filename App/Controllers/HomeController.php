<?php

class HomeController extends Controller
{
    function  __construct()
    {
        parent::__construct();
    }

    public function index(){
        view("home.index");
    } 
}
