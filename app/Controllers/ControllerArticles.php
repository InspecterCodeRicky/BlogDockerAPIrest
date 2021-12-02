<?php

class ControllerArticles {

    private $_articlesManger;
    
    public function __construct()
    {
        $this->articles();   
    }

  private function articles() {
      require_once( './app/Manager/ArticleManger.php' );
      require_once( './app/Entity/Article.php' );
      $this->_articlesManger = new ArticleManager();
      $articles = $this->_articlesManger->getArticles();
      require_once( './app/views/articles.php' );
  }
}
