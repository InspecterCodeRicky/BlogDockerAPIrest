<?php
require_once('Manager/ArticleManager.php');
require_once('Manager/CommentManager.php');
require_once('Manager/SecurityManager.php');
require_once('Entity/Article.php');
require_once('Entity/User.php');


class ControllerComment extends ControllerBigBoss
{

    private $_articlesManger;
    private $_securityManger;
    private $_commentManger;

    public function runRemoveComment()
    {
        $this->_articlesManger = new ArticleManager();
        $this->_commentManger = new CommentManager();
        $this->_securityManger = new SecurityManager();
        $this->_flash = new Flash();

        $user_session = $this->_securityManger->get_user_session();
        if ($user_session == null) {
            $this->_flash->setFlash("Connectez-vous pour acceder à cette ressource");
            $this->redirectNewRoute("\/article/" . $this->getParams(2));
        }
        $paramIdComment = $this->getParams(3);
        $paramIdArticle = $this->getParams(2);
        $article = $this->_articlesManger->get_article_by_id($paramIdArticle);
        $comment = $this->_commentManger->get_comment_by_id($paramIdComment);
        if ($article !== null &&  $comment !== null) {
            $this->_commentManger->remove_comment($comment);
            $this->_flash->setFlash("Votre commentaire a été supprimé");
            $this->redirectNewRoute("\/article/" . $paramIdArticle);
        } else {
            $this->_flash->setFlash("Oups, quelque chose s'est mal passée");
            $this->redirectNewRoute('/home');
        }
    }

    public function runAddComment()
    {
        $this->_articlesManger = new ArticleManager();
        $this->_commentManger = new CommentManager();
        $this->_securityManger = new SecurityManager();
        $this->_flash = new Flash();

        $paramIdComment = $this->getParams(3);
        $paramIdArticle = $this->getParams(2);

        $user_session = $this->_securityManger->get_user_session();
        if ($user_session == null) {
            $this->_flash->setFlash("Connectez-vous pour acceder à cette ressource");
            $this->redirectNewRoute("\/article/" . $paramIdArticle);
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->redirectNewRoute("\/article/" . $paramIdArticle);
        }
        
        if (isset($_POST['post_comment']) && empty($_POST['post_comment'])) {
            $this->_flash->setFlash("Le champs commetaire est vide");
        } 
        echo "djekjde";

        $article = $this->_articlesManger->get_article_by_id($paramIdArticle);
        if (!$this->_flash->hasFlash() && $article !== null) {
            $comment = new Comment(array(
            'content' => $_POST['post_comment'],
            'createdAt' => date('Y-m-d H:i:s'),
            'reply' => '',
            'authorId' =>  $user_session->getId(),
            'authorPseudo' =>  $user_session->getFirstname().' ' .$user_session->getLastname(),
            'athorAvatar' =>  $user_session->getAvatar(),
            ));
            $this->_commentManger->add_comment($comment);
            $this->redirectNewRoute("\/article/" . $paramIdArticle);
        } else {
            $this->_flash->setFlash("Oups, quelque chose s'est mal passée");
            $this->redirectNewRoute('/home');
        }
    }
}
