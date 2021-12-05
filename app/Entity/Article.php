<?php

class Article extends CommonHydrator{
    private $_id;
    private $_title;
    private $_content;
    private $_author_id;
    private $_image_path;
    private $_created_at;

    // setters 
    public function setId($id) 
    {
        // if(is_string($id)) {
            $this->_id = $id;
        // }
    }
    public function setTitle($title)
    {
        if(is_string($title)) {
            $this->_title = $title;
        }
    }
    public function setContent($content)
    {
        if(is_string($content)) {
            $this->_content = $content;
        }
    }
    public function setCreatedAt($createdAt)
    {
        $this->_created_at = $createdAt;
    }
    public function setAuthorId($authorId)
    {
        $this->_author_id = $authorId;
    }
    public function setImage($imagePath)
    {
        
        $this->_image_path = $imagePath;
    }
    
    // getters 
    public function getId()
    {
       return $this->_id;
    }
    public function getTitle()
    {
       return $this->_title;
    }
    public function getContent()
    {
       return $this->_content;
    }
    public function getCreatedAt()
    {
       return $this->_created_at;
    }
    public function getAuthorId()
    {
       return $this->_author_id;
    }
    public function getImage()
    {
       return $this->_image_path;
    }
    public function toArray()  {
        return array("id" => $this->_id, "title" => $this->_title, "content" => $this->_content, "createdAt" => $this->_created_at);
    }
}