<?php


class SecurityManager extends PDOFactory
{
    protected static $pdo;

    public function __construct()
    {
        self::$pdo = $this->getConnection();
    }

    //METHOD GET ALL USERS
    public function fetch_all_users() {
        $var = [];
        $query = 'SELECT * FROM ' . PDOFactory::DATABASE . '.users';
        $req = self::$pdo->prepare($query);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new Article($data);
        }
        return $var;
        $req->closeCursor();
    }

    // METHOD RETURN TRUE IF USER IS Valid
    public function is_valid_user($email = null, $password = null, $actionCheck = null): bool
    {
        $user = $this->get_user_by_email($email);
        if ($actionCheck == null && $user !== null && password_verify($password, $user->getPassword())) {
            return true;
        }
        if ($actionCheck === "verify_password_user" && $user->getPassword() === $password) {
            return true;
        }
        return false;
    }

    public function authenticate_user(User $user) 
    {
        $_SESSION['user_info'] = serialize($user);
    }

    public function get_user_session(): ?User 
    {
        if(isset($_SESSION['user_info'])) {
            return unserialize($_SESSION['user_info']);
        }
        return null;
    }
    

    public function kill_session(): void 
    {
        unset($_SESSION['user_info']);
    }

    // METHOD RETURN TRUE IF USER EXISTS IN BD 
    public function user_in_db(string $email): bool
    {
        $user = $this->get_user_by_email($email);
        if($user) {
            return true;
        }
        return false;
    }

    // METHOD GET USER BY ID
    public function get_user_by_id(int $id) : ?User {
        $query = 'SELECT * FROM ' . PDOFactory::DATABASE . '.users WHERE id = :id LIMIT 1';
        $req = self::$pdo->prepare($query);
        $req->bindValue(':id', $id);
        $req->execute();
        $req->execute();
        if($req->rowCount()>0 && $req->setFetchMode(\PDO::FETCH_CLASS, 'User')) {
            return new User($req->fetch(PDO::FETCH_ASSOC));
        }
        return null;
    }

    // METHOD GET USER BY EMAIL
    public function get_user_by_email($email) : ?User {
        $var = new User([]);
        $query = 'SELECT * FROM ' . PDOFactory::DATABASE . '.users WHERE email = :email LIMIT 1';
        $req = self::$pdo->prepare($query);
        $req->bindValue(':email', $email);
        $req->execute();
        if($req->rowCount()>0 && $req->setFetchMode(\PDO::FETCH_CLASS, 'User')) {
            return new User($req->fetch(PDO::FETCH_ASSOC));
        }
        return null;
    }

    //METHOD REGISTER USER
    public function register_user(User $obj) : User {
        $query = 'INSERT INTO ' . PDOFactory::DATABASE . '.users (firstname, lastname, avatar, email, password, isAdmin) VALUES (:firstname, :lastname, :avatar, :email, :password, :isAdmin)';
        $req = self::$pdo->prepare($query);
        $req->bindValue(':firstname', $obj->getFirstname());
        $req->bindValue(':lastname', $obj->getLastname());
        $req->bindValue(':avatar', $obj->getAvatar());
        $req->bindValue(':email', $obj->getEmail());
        $req->bindValue(':password', $obj->getPassword());
        $req->bindValue(':isAdmin', $obj->getIsAdmin());
        $req->execute();
        return $this->get_user_by_email($obj->getEmail());
    }

    // METHOD UPDATE user
    public function update_user(User $obj) : User {
        $query = 'UPDATE ' . PDOFactory::DATABASE . '.users SET lastname = : lastname, firstname = : firstname, password = :password, isAdmin = : isAdmin WHERE email = :email';
        $req = self::$pdo->prepare($query);
        $req->bindValue("lastname", $obj->getLastname());
        $req->bindValue("firstname", $obj->getFirstname());
        $req->bindValue("password", $obj->getPassword());
        $req->bindValue("isAdmin", $obj->getIsAdmin());
        $req->bindValue("email", $obj->getEmail());
        $req->execute();
        $user = $this->get_user_by_email($obj->getEmail());
        return $user;
    }

    public function delete_user(User $obj): bool
    {
        $query = 'DELETE FROM ' . PDOFactory::DATABASE . '.users WHERE email = :email';
        $req = self::$pdo->prepare($query);
        $req->bindValue(':email', $obj->getEmail());
        return $req->execute();
    }
}