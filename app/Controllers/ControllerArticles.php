<?php
require_once( 'Manager/ArticleManager.php' );
require_once( 'Entity/Article.php' );


class ControllerArticles extends ControllerBigBoss  {

  private $_articlesManger;
    
  public function runGetAllArticles() {
    $this->_articlesManger = new ArticleManager();
    $articles = $this->_articlesManger->get_articles();
      return $this->MakeView('Mon blog',  $articles, 'articles');
  }
  public function runGetOneArticle() {
    echo "bnb". $_GET["id"];
    $this->_articlesManger = new ArticleManager();
    $article = $this->_articlesManger->get_article_by_id(explode('/', $_SERVER['REQUEST_URI'])[2]);
    return $this->MakeView('Mon blog',  $article, 'singleArticle');
  }
}
