<?php

class ControllerSecurity {

    private $_securityManger;
    
    public function __construct()
    {
        $this->articles();   
    }

  private function articles() {
      require_once( 'Manager/ArticleSecurity.php' );
    //   require_once( 'Entity/Article.php' );
      $this->_securityManger = new SecurityManager();
    //   $articles = $this->_securityManger->getArticles();
    //   require_once( 'views/articles.php' );
  }
}
