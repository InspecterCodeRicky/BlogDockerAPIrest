<?php

class Route
{



  /*
   * Checks if the current route is valid. Checks the route
   * against the global $Routes array.
  */
  static public function isRouteValid()
  {
    global $Routes;
    $uri = $_SERVER['REQUEST_URI'];
    if (!in_array(explode('?', $uri)[0], $Routes)) {
      return 0;
    } else {
      return 1;
    }
  }

  // Insert the route into the $Routes array.
  private static function registerRoute($route)
  {

    global $Routes;
    $Routes[] = BASEDIR.$route;
  }

  // This method creates dynamic routes.
  public static function dyn($dyn_routes) {
    $route_components = explode('/', $dyn_routes);
    $uri_components = explode('/', substr($_SERVER['REQUEST_URI'], strlen(BASEDIR)-1));
    for ($i = 0; $i < count($route_components); $i++) {
      if ($i+1 <= count($uri_components)-1) {
        $route_components[$i] = str_replace("<$i>", $uri_components[$i+1], $route_components[$i]);
      }
    }
    $route = implode('/', $route_components);
    // Return the route.
    return $route;
  }

  // Register the route
  public static function set($route, $closure)
  {
   
    // echo $route;
    // die;
    if ($_SERVER['REQUEST_URI'] == BASEDIR.$route) {
      self::registerRoute($route);
      $closure->__invoke();
    } else if (explode('?', $_SERVER['REQUEST_URI'])[0] == BASEDIR.$route) {
      self::registerRoute($route);
      return $closure->__invoke();
    } else if ($_GET['url'] == explode('/', $route)[0]) {
      self::registerRoute(self::dyn($route));
      $closure->__invoke();
    }
  }
}
