<?php

abstract class ControllerBigBoss
{

    public function __construct(string $action, array $params = [])
    {
        $method = 'run' . ucfirst($action);
        if(!method_exists($this, $method)) {
            throw new \RuntimeException('L\'action "' . $method . '" n\'est pas définie sur ce module');
        }
        $this->$method();
    }

    // render Template view  
    public function MakeView(string $title, array $data , $view)
    {
        ob_start();
        require 'Views/'.$view.'.php';
        $bodyContent = ob_get_clean();
        return require 'Views/template.php';
    }

    public function renderJSON($content)
    {
        $this->HTTPResponse->addHeader('Content-Type: application/json');
        echo json_encode($content, JSON_PRETTY_PRINT);
    }
}