<?php


class ControllerSecurity {

  // private static function getID($username) {
  //   return DB::query("SELECT id FROM users WHERE username=:username", array(':username'=>$username))[0]['id'];
  // }

  // private static function generateRandom($length = 64) {
  //   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  //   $charactersLength = strlen($characters);
  //   $randomString = '';
  //   for ($i = 0; $i < $length; $i++) {
  //       $randomString .= $characters[rand(0, $charactersLength - 1)];
  //   }
  //   return $randomString;
  // }

  // public static function loginUser($username) {
  //   $tok = self::generateRandom();

  //   setcookie("SSID", $tok, time() + 3600, BASEDIR);

  //   return DB::query("INSERT INTO login_tokens VALUES ('',:token,:uid)", array(':uid'=>self::getID($username), ':token'=>sha1($tok)));
  // }

  // public static function isLoggedIn() {
  //   if (isset($_COOKIE['SSID'])) {
      
  //     return true;
  //   } else {
  //     return false;
  //   }
  // }

}
