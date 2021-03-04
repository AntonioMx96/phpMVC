<?php
class Template
{
    private $content;
    public function __construct($path, $data = [])
    {
        if(is_array($data[0])){
            extract($data[0]);
        }else{
            extract($data);
        }
        ob_start();
        include($path);
        $this->content = ob_get_clean();
    }

    public function __toString()
    {
        return $this->content;
    }
}
