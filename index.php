<?php
// var_dump($_SERVER['REQUEST_URI']);
// require_once( './app/config/config.php' );
require_once( './app/_Globals.php' );
// /*
//  * By including routes/Routes.php we get access to the $Routes
//  * array containing all of the valid routes for our app.
// */
require_once( './app/routes/Routes.php' );

function __autoload($class_name) {
      require_once './app/Models/'.$class_name.'.php';
}

// // We create a new instance of the 'How' object and execute the run method.
// $how = new How();
// $how->run();

?>
