<?php
require_once( 'Manager/ArticleManager.php' );
require_once( 'Entity/Article.php' );


class ControllerArticles extends ControllerBigBoss  {

  private $_articlesManger;
    
  public function runShowArticles() {
    $this->_articlesManger = new ArticleManager();
    $articles = $this->_articlesManger->getArticles();
      return $this->MakeView('Mon blog',  $articles, 'articles');
  }
  public function runGetOneArticle() {
    $this->_articlesManger = new ArticleManager();
    $articles = $this->_articlesManger->getArticles();
      return $this->MakeView('Mon blog',  $articles, 'singleArticle');
  }
}
