<?php

class View {
    private $_ctrl;
  /*
   * If the route is valid create the view and the view controller.
   * If the route is invalid do nothing and if something goes wrong
   * checking the route return 0;
  */
  public function make($view) {

    try {
      if (Route::isRouteValid()) {
        $controller = ucfirst($view);
        $controllerClass = 'Controller'.$controller;
        $controllerFile = './app/Controllers/Controller'.$controller.'.php';
        if(file_exists($controllerFile)){
          require_once($controllerFile);
          $this->_ctrl = new $controllerClass();
        } 
        else {
          require_once( './app/views/'.$view.'.php' );
        }
        return 1;
      }
    } catch (\Throwable $th) {
      //throw $th;
    }

  }

  // public static function makeAdmin($view) {

  //   if (Route::isRouteValid()) {
  //       // Create the view and the view controller.
  //       require_once( './app/controllers/Controller.php' );
  //       require_once( './app/views/'.$view.'.php' );
  //       return 1;
  //   }

  // }

  public static function post($view) {

    if (Route::dyn($view)) {
        // Create the view and the view controller.
        require_once( './app/controllers/'.$view.'.php' );
        return 1;
    }

  }


}
