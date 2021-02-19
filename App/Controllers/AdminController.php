<?php
class AdminController extends Controller{
    public function __construct() {
        parent::__construct();
        //Auth::session();
    }

    public function index()
    {
        $this->view->render($this, 'index', 'Bienvenido');
    }
}