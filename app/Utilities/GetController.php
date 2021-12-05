<?php

class GetController 
{

  static function runController($controller, $action = "null")
    {
  
      if (Route::isRouteValid()) {
        $controller = ucfirst($controller);
        $controllerClass = $controller;
        $controllerFile = 'Controllers/' . $controller . '.php';
        if (file_exists($controllerFile)) {
          require_once($controllerFile);
          $_ctrl = new $controllerClass($action);
          $_ctrl;
        }
        return 1;
      } 
    }
}
