<?php
      require_once( '_Globals.php' );

      // /*
      //  * By including routes/Routes.php we get access to the $Routes
      //  * array containing all of the valid routes for our app.
      // */
      require_once('Routes/Routes.php');
      function __autoload($class_name) {
            require_once 'Models/'.$class_name.'.php';
      }


      // // We create a new instance of the 'Blog' object and execute the run method.
      $blog = new Blog();
      $blog->run();

?>
