<?php

class Comment extends CommonHydrator
{
    private $_id;
    private $_post_id;
    private $_content;
    private $_author_id;
    private $_author_pseudo;
    private $_author_avatar;
    private $_created_at;
    private $_reply_id;

    // setters 
    public function setId($id)
    {
        if (is_int($id)) {
            $this->_id = $id;
        }
    }
    public function setPostId($postId)
    {
        if (is_int($postId)) {
            $this->_post_id = $postId;
        }
    }
    public function setContent($content)
    {
        if (is_string($content)) {
            $this->_content = $content;
        }
    }
    public function setAuthorPseudo($authorPseudo)
    {
        if (is_string($authorPseudo)) {
            $this->_author_pseudo = $authorPseudo;
        }
    }
    public function setAuthorAvatar($authorAvatar)
    {
        if (is_string($authorAvatar)) {
            $this->_author_avatar = $authorAvatar;
        }
    }
    public function setCreatedAt($createdAt)
    {
        if (is_string($createdAt)) {
            $this->_created_at = $createdAt;
        }
    }
    public function setAuthorId($authorId)
    {
        if (is_int($authorId)) {
            $this->_author_id = $authorId;
        }
    }
    public function setReplyId($replyId)
    {
        $this->_reply_id = $replyId;
    }

    // getters 
    public function getId()
    {
        return $this->_id;
    }
    public function getPostId()
    {
        return $this->_post_id;
    }
    public function getContent()
    {
        return $this->_content;
    }
    public function getAuthorPseudo()
    {
        return $this->_author_pseudo;
    }
    public function getAuthorAvatar()
    {
        return $this->_author_avatar;
    }
    public function getCreatedAt()
    {
        return $this->_created_at;
    }
    public function getAuthorId()
    {
        return $this->_author_id;
    }
    public function getReplyId()
    {
        return $this->_reply_id;
    }

    public function toArray()
    {
        return array("id" => $this->_id, "title" => $this->_title, "content" => $this->_content, "createdAt" => $this->_created_at);
    }
}
