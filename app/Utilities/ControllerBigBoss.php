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

    public function getParams(int $position) {
        return explode('/', $_SERVER['REQUEST_URI'])[$position];
    }

    public function redirectNewRoute(string $newRoute)
    {
        header('Location: '.$newRoute);
        exit;
    }
}