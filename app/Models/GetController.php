<?php

class GetController 
{

  static function runControler($controller, $view, $action = "null")
    {
  
      echo "ttdeed";
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
      } else {
        require_once('Controllers/ControllerError.php');
        new ControllerError('PageNotFound');
        return 0;
      }
    }
}
