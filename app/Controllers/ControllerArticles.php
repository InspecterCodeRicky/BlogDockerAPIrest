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

  public function runApiArticle() {
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $this->_articlesManger = new ArticleManager();
    if($requestMethod == 'GET') {
      $this->getArticle();
    } else if ($requestMethod == 'POST') {
      $this->postArticle();
    } else if ($requestMethod == 'PUT') {
      $this->putArticle();
    } else if ($requestMethod == "DELETE") {
      $this->deleteArticle();
    }
  }

  public function runApiArticles() {
    $userId = 2;
    $this->_articlesManger = new ArticleManager();
    $articles = $this->_articlesManger->getArticlesForUser($userId);
    echo json_encode($articles);
  }

  public function getArticle() {

    $id = $_GET["id"];

    if (!isset($id)) {
      echo json_encode(array(
        "msg" => "id is not found",
      ));
      return;
    } 

    $this->_articlesManger = new ArticleManager();
    $article = $this->_articlesManger->getArticle($id);
    echo json_encode($article);
  }

  public function putArticle() {

    parse_str(file_get_contents('php://input'), $_PUT);

    $id = $_PUT["id"];
    $title = $_PUT["title"];
    $content = $_PUT["content"];
    $image = $_PUT["image"];

    if (!isset($id)) {
      echo json_encode(array(
        "msg" => "id is not found",
      ));
      return;
    } 

    if (!isset($title)) {
      echo json_encode(array(
        "msg" => "title is not found",
      ));
      return;
    } 

    if (!isset($content)) {
      echo json_encode(array(
        "msg" => "content is not found",
      ));
      return;
    } 

    if (!isset($image)) {
      echo json_encode(array(
        "msg" => "image is not found",
      ));
      return;
    } 

    $this->_articlesManger->updateArticle($id, $title, $content, $image);

    echo json_encode(array(
      "msg" => "article updated",
    ));
  }

  public function postArticle() {

    $title = $_POST["title"];
    $content = $_POST["content"];
    $image = $_POST["image"];
    $authorId = 1;

    if (!isset($title)) {
      echo json_encode(array(
        "name" => "title is not found",
      ));
      return;
    } 

    if (!isset($content)) {
      echo json_encode(array(
        "name" => "content is not found",
      ));
      return;
    } 

    if (!isset($image)) {
      echo json_encode(array(
        "name" => "image is not found",
      ));
      return;
    } 

    $this->_articlesManger->addArticle($title, $content, $image, $authorId);

    echo json_encode(array(
      "msg" => "article added",
    ));
  }

  public function deleteArticle() {
    parse_str(file_get_contents('php://input'), $_DELETE);
    $id = $_DELETE["articleId"];

    if (!isset($id)) {
      echo json_encode(array(
        "name" => "id is not found",
      ));
      return;
    } 

    $this->_articlesManger->removeArticle($id);

    echo json_encode(array(
      "msg" => "article deleted",
    ));
  }
}