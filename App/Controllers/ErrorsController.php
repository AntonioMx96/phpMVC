<?php
class ErrorsController extends Controller{
    public function __construct() {
        parent::__construct();
    }

    public function notFound(){
        $this->view->render($this, 'notFound', 'page not Found"',["message"=>"La pagina no exite"]);
    }
}
$notFound2 = new ErrorsController();
$notFound2->notFound();