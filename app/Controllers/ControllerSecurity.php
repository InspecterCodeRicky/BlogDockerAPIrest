<?php
require_once('Manager/SecurityManager.php');
require_once('Entity/User.php');

class ControllerSecurity extends ControllerBigBoss
{

  private $_securityManger;
  private $_flash;


  function runLogin()
  {
    $this->_securityManger = new SecurityManager();

    $this->_flash = new Flash();
    if (empty($_POST)) {
      return $this->MakeView('Se connecter', [], 'login');
    }


    if (isset($_POST['email_login']) && empty($_POST['email_login'])) {
      $this->_flash->setFlash("Le champs email est vide");
    } else if (isset($_POST['password_login']) &&  empty($_POST['password_login'])) {
      $this->_flash->setFlash("Le champs mot de passe est vide.");
    } else {
      $email = trim($_POST['email_login']);
      $password = $_POST['password_login'];

      // check validation email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->_flash->setFlash("L'adresse email '$email' est considérée comme invalide.");
        return $this->MakeView('Se connecter', [], 'login');
      }
      $user_is_valid = $this->_securityManger->is_valid_user($email, $password);
      if (!$this->_flash->hasFlash() && $user_is_valid) {
        $this->_securityManger->authenticate_user($this->_securityManger->get_user_by_email($email));
        $this->_flash->setFlash("Vous êtes connecté(é)", "succes");
        return $this->MakeView('Se connecter', [], 'login');
      } else {
        $this->_flash->setFlash("Vos informations sont incorrectes");
      }
    }
    return $this->MakeView('Se connecter', [], 'login');
  }

  function runRegister()
  {
    $this->_securityManger = new SecurityManager();

    $this->_flash = new Flash();
    if (empty($_POST)) {
      return $this->MakeView('Créer un compte', [], 'register');
    }

    if ($_FILES["fileToUpload"]["name"] == null) {
      $this->_flash->setFlash("Choisissez une photo de profil");
    } else if (isset($_POST['firstname_register']) && empty($_POST['firstname_register'])) {
      $this->_flash->setFlash("Le champs Prénom est vide");
    } else if (isset($_POST['lastname_register']) && empty($_POST['lastname_register'])) {
      $this->_flash->setFlash("Le champs Nom est vide");
    } else if (isset($_POST['email_register']) && empty($_POST['email_register'])) {
      $this->_flash->setFlash("Le champs email est vide");
    } else if (isset($_POST['password_register']) &&  empty($_POST['password_register'])) {
      $this->_flash->setFlash("Le champs mot de passe est vide.");
    } else {
      $email = trim($_POST['email_register']);
      $password = md5($_POST['password_register']);
      $lastname = $_POST['lastname_register'];
      $firstname = $_POST['firstname_register'];

      $image_is_upload = new ImagesUpload();
      $image_is_upload->upload($_FILES);
      // check validation email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->_flash->setFlash("L'adresse email '$email' est considérée comme invalide.");
        return $this->MakeView('Créeer un compte', [], 'register');
      }

      if (!$image_is_upload) {
        return $this->MakeView('Créeer un compte', [], 'register');
      }
      $user_exists = $this->_securityManger->user_in_db($email);
      if ($this->_flash->hasFlash() && $user_exists) {
        $this->_flash->setFlash("Vos informations sont incorrectes");
        
      }
      $objUser = new User(array(
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'password' => $password,
        'isAdmin' => 0,
        'avatar' => $image_is_upload->getPathFile(),
      ));
      $res = $this->_securityManger->register_user($objUser);
      $this->_securityManger->authenticate_user($res);
      $this->_flash->setFlash("Vous êtes connecté(é)", "succes");
      return $this->MakeView('acceuil', [], 'articles');
    }
    return $this->MakeView('Créer un compte', [], 'register');
  }



  // // METHOD GET USER BY ID
  // public function authenticate($email, $password)
  // {
  //   $password = md5($_POST['password']);
  //   $query = 'SELECT * FROM ' . PDOFactory::DATABASE . '.users WHERE email = ' . $email . ' AND password = ' . $password;
  //   $req = self::$pdo->prepare($query);
  //   $req->execute();
  //   $count = $req->rowCount();
  //   if ($count > 0) {

  // Session::init();
  // Session::set('role', "user");
  // Session::set('loggedIn', true);
  // Session::set('user_name', $user_name);
  // Session::set('password', $res[0]['password']);
  // header('location: '.URL.'login/index');
  //   } else {
  //     // Session::set('loggedIn', false);
  //     // header('location: '.URL);
  //     return 0;
  //   }
  // }


  // METHOD LOGIN USER
  public function login_user($typeProfile, $email, $password)
  {
    global $pdo;

    // hach password for compare with db password
    $passwordHach = md5($password);

    $query = $pdo->prepare("SELECT * FROM $typeProfile where email = ? AND password = ?");
    $query->bindValue(1, $email);
    $query->bindValue(2, $passwordHach);

    $query->execute();
    $num = $query->rowCount();

    // if user exits or not
    if ($num == 1) {
      $_SESSION['logged_in'] = true;
      $_SESSION['email'] = $email;
      $_SESSION['type_profile'] = $typeProfile;
      header('location: talents.php');
      exit();
    } else {
      return json_encode(array('error' => "l'email ou le mot de passe est incorrect ou votre type de profile n'est pas le bon"));
    }
  }
}
