<?php
require_once('Manager/SecurityManager.php');
require_once('Entity/User.php');

class ControllerSecurity extends ControllerBigBoss
{

  private $_securityManger;
  private $_flash;



  public function runShowProfile()
  {
    $this->_securityManger = new SecurityManager();

    $this->_flash = new Flash();

  
    $user_session = $this->_securityManger->get_user_session();
    if($user_session == null) {
      $this->_flash->setFlash("Vous n'êtes pas connecté(é)");
      $this->redirectNewRoute('/home');
    }
    // return $this->MakeView('Mon profil', $user_session, 'profile');
  }

  public function logout() {
    $this->_securityManger = new SecurityManager();
    $this->_securityManger->kill_session();
    $this->redirectNewRoute('/home');
  }

  function runLogOut() {
    $this->_securityManger = new SecurityManager();
    $this->_flash = new Flash();
    $this->_securityManger->kill_session();
    $this->_flash->setFlash("Vous êtes deconnecté(é)", "succes");
    return $this->MakeView('Se connecter', [], 'articles');
  }

  function runLogin()
  {
    $this->_securityManger = new SecurityManager();
    
    $this->_flash = new Flash();

    $user_session = $this->_securityManger->get_user_session();
    if ($user_session !== null) {
      $this->redirectNewRoute('/home');
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
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
        $this->redirectNewRoute('/home');
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

    $user_session = $this->_securityManger->get_user_session();
    if ($user_session !== null) {
      $this->redirectNewRoute('/home');
    }
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
      return $this->MakeView('Créer un compte', [], 'register');
    }

    $newUser = $this->checkFieldsPost();
    if ($newUser == null) {
      return $this->MakeView('Créer un compte', [], 'register');
    }
    $res = $this->_securityManger->register_user($newUser);
    $this->_securityManger->authenticate_user($res);
    $this->_flash->setFlash("Vous êtes connecté(é)", "succes");
    $this->redirectNewRoute('/home');
  }


  // METHOD LOGIN USER
  public function runRemoveUser()
  {
    $this->_securityManger = new SecurityManager();
    $this->_flash = new Flash();

    $user_session = $this->_securityManger->get_user_session();
    if ($user_session !== null && $this->_securityManger->user_in_db($user_session->getEmail())) {
      $this->_securityManger->delete_user($user_session);
      $this->redirectNewRoute('/home');
    }
    $this->_flash->setFlash("Oups... Quelque chose s'est mal passée !");
  }

  // METHOD LOGIN USER
  public function runUpdateUser()
  {
    $this->_securityManger = new SecurityManager();
    $this->_flash = new Flash();
    $user_session = $this->_securityManger->get_user_session();

    if ($user_session == null) {
      $this->_flash->setFlash("Connectez-vous pour acceder à cette ressource");
      return $this->MakeView('Se connecter', [] , 'login');
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
      return $this->MakeView('MAJ', $user_session, 'updateProfile');
    }


    if ($user_session !== null && $this->_securityManger->user_in_db($user_session->getEmail())) {
      $this->_securityManger = new SecurityManager();


      $newUser = $this->checkFieldsPost();
      if ($newUser == null) {
        return $this->MakeView('MAJ', [], 'updateProfile');
      }
      $res = $this->_securityManger->register_user($newUser);
      $this->_securityManger->authenticate_user($res);
      $this->_flash->setFlash("Vous êtes connecté(é)", "succes");
      return $this->MakeView('Mon profil', [], 'profile');
    }
  }

  private function checkFieldsPost(): ?User
  {
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
        return null;
      }

      if (!$image_is_upload) {
        return null;
      }
      $user_exists = $this->_securityManger->user_in_db($email);
      if ($this->_flash->hasFlash() && $user_exists) {
        $this->_flash->setFlash("Vos informations sont incorrectes");
        return null;
      }
      $objUser = new User(array(
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'isAdmin' => 0,
        'avatar' => $image_is_upload->getPathFile(),
      ));
      return $objUser;
    }
    return null;
  }
}
