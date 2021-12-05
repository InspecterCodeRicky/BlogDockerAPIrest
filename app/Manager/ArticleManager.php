<?php


class ArticleManager extends PDOFactory
{
    protected static $pdo;

    public function __construct()
    {
        // $pdo = parent::__construct();
        self::$pdo = $this->getConnection();
        // Si la table n'existe pas...
        $createTable = 'CREATE DATABASE IF NOT EXISTS `' . PDOFactory::DATABASE . '`;
        USE `' . PDOFactory::DATABASE . '`;
        CREATE TABLE IF NOT EXISTS `blog` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `content` varchar(255) NOT NULL,
            `createdAt` datetime NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';
            self::$pdo->exec($createTable);
    }

    public function getArticles()
    {
        $var = [];
        $query = 'SELECT * FROM ' . PDOFactory::DATABASE . '.blog';
        $req = self::$pdo->prepare($query);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new Article($data);
        }
        return $var;
        $req->closeCursor();
        
    }

    
    public function getArticle($id)
    {
        $pdo = ArticleManager::$pdo;
        $var = [];
        $query = $pdo->prepare('SELECT * FROM blog WHERE id=?');
        $query->execute([$id]); 
        while ($row = $query->fetch()) {
            $article = new Article($row);
            $var[] = $article->toArray();
        }
        return $var[0];
    }

    public function getArticlesForUser($userId)
    {
        $pdo = ArticleManager::$pdo;
        $var = [];
        $query = $pdo->prepare('SELECT * FROM blog WHERE authorId=?');
        $query->execute([$userId]); 
        while ($row = $query->fetch()) {
            $article = new Article($row);
            $var[] = $article->toArray();
        }
        return $var;
    }

    public function addArticle($title, $content, $image, $authorId) {
        $pdo = ArticleManager::$pdo;
        try {
            $sql = "INSERT INTO blog (id, title, content, createdAt, image, authorId) VALUES (?,?,?,?,?,?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([null, $title, $content, date('Y-m-d H:i:s'), $image, $authorId]);
        }catch (Exception $e){
            throw $e;
        }
    }

    public function updateArticle($id, $title, $content, $image) {
        $pdo = ArticleManager::$pdo;
        try {
            $sql = "UPDATE blog SET title=?, content=?, image=? WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$title, $content, $image, $id]);
        }catch (Exception $e){
            throw $e;
        }
    }

    public function removeArticle($id) {
        $pdo = ArticleManager::$pdo;
        try {
            $sql = "DELETE FROM blog WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$id]);
        }catch (Exception $e){
            throw $e;
        }
    }
}