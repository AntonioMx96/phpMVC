<?php
class Template
{
    private $content;
    public function __construct($path, $data = [])
    {
        
        if(is_array($data[0])){
            extract($data[0]);
            $title = $data[1];
        }else{
            extract($data);
        }
        ob_start();
        try {
           if(file_exists($path)){
                include($path);
           }else{
               include('resources/Views/errors/notFound.html');
             
           }
          
        } catch (Exception $th) {
            echo $th->getMessage();
        }
     
        $this->content = ob_get_clean();
    }

    public function __toString()
    {
        return $this->content;
    }
}
