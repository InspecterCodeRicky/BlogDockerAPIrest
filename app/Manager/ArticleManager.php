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

    public function get_articles()
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
    public function get_article_by_id(string $id) : ?Article
    {
        $query = 'SELECT * FROM ' . PDOFactory::DATABASE . '.blog WHERE id = :id';
        $req = self::$pdo->prepare($query);
        $req->bindValue(':id', $id);
        $req->execute();
        if($req->rowCount()>0 && $req->setFetchMode(\PDO::FETCH_CLASS, 'Article')) {
            return new Article($req->fetch(PDO::FETCH_ASSOC));
        }
        return null;
        $req->closeCursor();
    }
}