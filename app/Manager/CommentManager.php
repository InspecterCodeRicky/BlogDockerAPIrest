<?php


class CommentManager extends PDOFactory
{
    protected static $pdo;

    public function __construct()
    {
        self::$pdo = $this->getConnection();
    }

    public function get_comments_by_post_id($postId)
    {
        $var = [];
        $query = 'SELECT * FROM ' . PDOFactory::DATABASE . '.commentPost WHERE postId = :postId';
        $req = self::$pdo->prepare($query);
        $req->bindValue(':postId', $postId);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new Comment($data);
        }
        return $var;
        $req->closeCursor();
    }

    public function get_comment_by_id(string $id): ?Comment
    {
        $query = 'SELECT * FROM ' . PDOFactory::DATABASE . '.commentPost WHERE id = :id';
        $req = self::$pdo->prepare($query);
        $req->bindValue(':id', $id);
        $req->execute();
        if ($req->rowCount() > 0 && $req->setFetchMode(\PDO::FETCH_CLASS, 'Comment')) {
            return new Comment($req->fetch(PDO::FETCH_ASSOC));
        }
        return null;
        $req->closeCursor();
    }


    public function add_comment(Comment $obj): bool
    {
        $query = 'INSERT INTO ' . PDOFactory::DATABASE . '.commentPost (postId, content, authorId, authorPseudo, authorAvatar , createdAt, replyId) VALUES (:postId,:content,:authorId,:authorPseudo,:authorAvatar,:createdAt,:replyId)';
        $req = self::$pdo->prepare($query);
        $req->bindValue(":postId", $obj->getPostId());
        $req->bindValue(":content", $obj->getContent());
        $req->bindValue(":authorId", $obj->getAuthorId());
        $req->bindValue(":authorPseudo", $obj->getAuthorPseudo());
        $req->bindValue(":authorAvatar", $obj->getAuthorAvatar());
        $req->bindValue(":createdAt", $obj->getCreatedAt());
        $req->bindValue(":replyId", $obj->getReplyId());
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }


    public function remove_comment(Comment $obj): bool
    {
        $query = 'DELETE FROM ' . PDOFactory::DATABASE . '.commentPost WHERE id = :id';
        $req = self::$pdo->prepare($query);
        $req->bindValue(':email', $obj->getId());
        return $req->execute();
    }
}
