<?php


class User extends CommonHydrator
{
    private int $id;
    private string $firstname;
    private string  $lastname;
    private string $email;
    private string $password;
    private int $isAdmin; 
    private string $avatar; 

    // SETTERS
    public function setId($id): void
    {
        $this->id = $id;
    }


    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setPassword($password): void
    {
        $this->password = md5($password);
    }

    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }

    public function setIsAdmin($isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

  
    public function getFirstname()
    {
        return $this->firstname;
    }

  
    public function getLastname()
    {
        return $this->lastname;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }
  
    public function getEmail()
    {
        return $this->email;
    }

  
    public function getPassword()
    {
        return $this->password;
    }


    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

}