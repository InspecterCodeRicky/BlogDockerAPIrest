<?php
require_once( 'Manager/ArticleManager.php' );
require_once( 'Manager/SecurityManager.php' );
require_once( 'Entity/Article.php' );
require_once('Entity/User.php');


class ControllerArticles extends ControllerBigBoss  {

  private $_articlesManger;
  private $_securityManger;

    
  public function runGetAllArticles() {
    $this->_articlesManger = new ArticleManager();
    $articles = $this->_articlesManger->get_articles();
      return $this->MakeView('Mon blog',  $articles, 'articles');
  }
  public function runGetOneArticle() {
    $this->_articlesManger = new ArticleManager();
    $this->_securityManger = new SecurityManager();

    $article = $this->_articlesManger->get_article_by_id($this->getParams(2));
    if($article == null) {
      return $this->MakeView('Page introuvable',  [] , 'error');
    }
    $authorPost = $this->_securityManger->get_user_by_id($article->getAuthorId());
    return $this->MakeView('Mon blog',  ['dataPost' => $article, 'authorPost' => $authorPost], 'singleArticle');
  }

  public function runAddArticle() {
    $this->_articlesManger = new ArticleManager();
    $this->_securityManger = new SecurityManager();
    $this->_flash = new Flash();
    
    $user_session = $this->_securityManger->get_user_session();
    if ($user_session == null) {
      $this->_flash->setFlash("Connectez-vous pour acceder à cette ressource");
      $this->redirectNewRoute('/home');
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
      return $this->MakeView('Ajouter un article', [], 'editArticle');
    }

    if (isset($_POST['post_title']) && empty($_POST['post_title'])) {
      $this->_flash->setFlash("Le champs titre est vide");
    } else if (isset($_POST['post_content']) &&  empty($_POST['post_content'])) {
      $this->_flash->setFlash("Le champs description est vide.");
    } else if ($_FILES["fileToUpload"]["name"] == null) {
      $this->_flash->setFlash("Choisissez une photo pour votre article");
    }else {
      $title = trim($_POST['post_title']);
      $content = $_POST['post_content'];
      $user_is_valid = $this->_securityManger->is_valid_user($user_session->getEmail(), $user_session->getPassword(), "verify_password_user");
      if (!$this->_flash->hasFlash() && $user_is_valid) {
        $image_is_upload = new ImagesUpload();
        if ($image_is_upload->upload($_FILES)) {
          $this->_articlesManger->addArticle($title, $content, $image_is_upload->getPathFile(), $user_session->getId());
          $this->_flash->setFlash("Vous article a été posté", "succes");
          $this->redirectNewRoute('/home');
        }
      } else {
        $this->_flash->setFlash("Vos informations sont incorrectes");
      }
      
    }
    return $this->MakeView('Ajouter un article', [], 'editArticle');
  }

  public function runRemoveArticle() {
    $this->_articlesManger = new ArticleManager();
    $this->_securityManger = new SecurityManager();
    $this->_flash = new Flash();
    
    $user_session = $this->_securityManger->get_user_session();
    if ($user_session == null) {
      $this->_flash->setFlash("Connectez-vous pour acceder à cette ressource");
      $this->redirectNewRoute("\/article/".$this->getParams(2));
    }
    $article = $this->_articlesManger->get_article_by_id($this->getParams(2));
    if($article !== null && $article->getAuthorId() == $user_session->getId()) {
      $this->_articlesManger->removeArticle($this->getParams(2));
      $this->_flash->setFlash("Votre article a été supprimé");
      $this->redirectNewRoute('/home');
    } else {
      $this->_flash->setFlash("Oups, quelque chose s'est mal passée");
      $this->redirectNewRoute('/home');
    }
  }


}
