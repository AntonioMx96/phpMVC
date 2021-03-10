<?php
class AdminController extends Controller {

    public $layout ;
    public function __construct() {
        $this->layout="admin";
    }

    public function index()
    {
        view('admin.index',  [] , 'Admin', 'admin');
    }
}