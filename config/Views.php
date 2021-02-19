<?php 

class Views
{
    function __construct()
    {
       
    }

    public function template($child=null,  $title=null){
        $view = new Template('resources/app.html',[
            'title'=>$title,
            'child'=>$child
        ]);
        echo $view;        
    }

    public function render($controller=null, $view=null, $title=null, $data=[])
    {
        $arg = array_keys($data);
        $controllers =strtolower( get_class($controller));
        $controllers = substr($controllers, 0, -10);
        if($data!=null){
            $view = new Template('resources/Views/'.$controllers.'/'.$view.'.html',[
                ''.$arg[0]=>$data[$arg[0]]
           ]);
        }else{
            $view = new Template('resources/Views/'.$controllers.'/'.$view.'.html',[
           ]);
        }
        $this->template($view, $title);
    }
}
