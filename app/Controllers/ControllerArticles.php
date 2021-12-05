<?php
require_once( 'Manager/ArticleManager.php' );
require_once( 'Manager/SecurityManager.php' );
require_once( 'Manager/CommentManager.php' );
require_once( 'Entity/Article.php' );
require_once('Entity/User.php');
require_once('Entity/Comment.php');


class ControllerArticles extends ControllerBigBoss  {

  private $_articlesManager;
  private $_securityManager;
  private $_commentManager;

    
  public function runGetAllArticles() {
    $this->_articlesManager = new ArticleManager();
    $articles = $this->_articlesManager->get_articles();
      return $this->MakeView('Mon blog',  $articles, 'articles');
  }
  public function runGetOneArticle() {
    $this->_articlesManager = new ArticleManager();
    $this->_securityManager = new SecurityManager();
    $this->_commentManager = new CommentManager();

    $article = $this->_articlesManager->get_article_by_id($this->getParams(2));
    if($article == null) {
      return $this->MakeView('Page introuvable',  [] , 'error');
    }
    $authorPost = $this->_securityManager->get_user_by_id($article->getAuthorId());
    $commentsPost = $this->_commentManager->get_comments_by_post_id($article->getId());
    return $this->MakeView('Mon blog',  ['dataPost' => $article, 'authorPost' => $authorPost, 'commentPost' =>$commentsPost], 'singleArticle');
  }

  public function runAddArticle() {
    $this->_articlesManager = new ArticleManager();
    $this->_securityManager = new SecurityManager();
    $this->_flash = new Flash();
    
    $user_session = $this->_securityManager->get_user_session();
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
      $user_is_valid = $this->_securityManager->is_valid_user($user_session->getEmail(), $user_session->getPassword(), "verify_password_user");
      if (!$this->_flash->hasFlash() && $user_is_valid) {
        $image_is_upload = new ImagesUpload();
        if ($image_is_upload->upload($_FILES)) {
          $this->_articlesManager->addArticle($title, $content, $image_is_upload->getPathFile(), $user_session->getId());
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
    $this->_articlesManager = new ArticleManager();
    $this->_securityManager = new SecurityManager();
    $this->_flash = new Flash();
    
    $user_session = $this->_securityManager->get_user_session();
    if ($user_session == null) {
      $this->_flash->setFlash("Connectez-vous pour acceder à cette ressource");
      $this->redirectNewRoute("\/article/".$this->getParams(2));
    }
    $article = $this->_articlesManager->get_article_by_id($this->getParams(2));
    if($article !== null && $article->getAuthorId() == $user_session->getId()) {
      $this->_articlesManager->removeArticle($this->getParams(2));
      $this->_flash->setFlash("Votre article a été supprimé");
      $this->redirectNewRoute('/home');
    } else {
      $this->_flash->setFlash("Oups, quelque chose s'est mal passée");
      $this->redirectNewRoute('/home');
    }
  }


}
