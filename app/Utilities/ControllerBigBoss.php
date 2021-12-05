<?php

abstract class ControllerBigBoss
{

    public function __construct(string $action, array $params = [])
    {
        $method = 'run' . ucfirst($action);
        if(method_exists($this, $method)) {
            $this->$method();
        }
    }

    // render Template view  
    public function MakeView(string $title, $data = null , string $view)
    {
        ob_start();
        require 'Views/'.$view.'.php';
        $bodyContent = ob_get_clean();
        return require 'Views/template.php';
    }

    public function renderJSON($content)
    {
        echo json_encode($content, JSON_PRETTY_PRINT);
    }
}