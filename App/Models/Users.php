<?php

class Users
{
     /**
     * Registration
     */
    public static function checkName($name) {
      if (strlen($name) >= 4) {
        return true;
      } else {
        return false;
      }
    }

    public static function checkPassword($password) {
      if (strlen($password) >= 6) {
        return true;
      } else {
        return false;
      }
    }

    public static function checkPasswordNumbers($password) {
      if(!preg_match("#[0-9]+#", $password)) {
        return false;
      } else {
        return true;
      }
    }

    public static function checkPasswordLetters($password) {
      if(!preg_match("#[a-z]+#", $password)) {
        return false;
      } else {
        return true;
      }
    }

    public static function checkEmail($email) {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
      } else {
        return false;
      }
    }

    public static function checkEmailExists($email) {

      $db = Db::getConnection();

      $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';
      
      $result = $db->prepare($sql);
      $result->bindParam(':email', $email, PDO::PARAM_STR);
      $result->execute();
      if ($result->fetchColumn()) {
        return true;
      } else {
        return false;
      }   
    }

    public static function checkUserExists($name) {

      $db = Db::getConnection();

      $sql = 'SELECT COUNT(*) FROM users WHERE username = :name';
      
      $result = $db->prepare($sql);
      $result->bindParam(':name', $name, PDO::PARAM_STR);
      $result->execute();
      if ($result->fetchColumn()) {
        return true;
      } else {
        return false;
      }   

    }
  
    public static function register($name, $email, $password, $hash) {

      $db = Db::getConnection();
      $password = hash("whirlpool", $password);

      $sql = 'INSERT INTO users (username, email, password, hash) '
              . 'VALUES (:name, :email, :password, :hash)';

      $result = $db->prepare($sql);
      $result->bindParam(':name', $name, PDO::PARAM_STR);
      $result->bindParam(':email', $email, PDO::PARAM_STR);
      $result->bindParam(':password', $password, PDO::PARAM_STR);
      $result->bindParam(':hash', $hash, PDO::PARAM_STR);

      return $result->execute();

    }

      /**
     * Login
     */

     public static function check_user($name, $password, $activation) {

      $db = Db::getConnection();

      $sql = 'SELECT * FROM users WHERE username = :name AND password = :password AND activation = :activation';

      $result = $db->prepare($sql);
      $result->bindParam(':name', $name, PDO::PARAM_STR);
      $result->bindParam(':password', $password, PDO::PARAM_STR);
      $result->bindParam(':activation', $activation, PDO::PARAM_INT);
      $result->execute();

      $user = $result->fetch();
      if ($user) {
        return $user['id'];
      } else {
        return false;
      }  
    }

    public static function auth($userId) {
     
      $_SESSION['user'] = $userId;
    }

    public static function checkLogged() {

      if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
      }

      header("Location: /");
    }

    public static function getUsernameById($id) {

      if ($id) {
        $db = Db::getConnection();
        $sql = "SELECT * FROM users WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
      }
    }

    public static function edit($id, $username, $password) {

      $db = Db::getConnection();

      $sql = "UPDATE users SET username = :username, password = :password WHERE id = :id";

      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);
      $result->bindParam(':username', $username, PDO::PARAM_STR);
      $result->bindParam(':password', $password, PDO::PARAM_STR);

      return $result->execute();
    }

    public static function editEmail($id, $email) {

      $db = Db::getConnection();
      
      $sql = "UPDATE users SET email = :email WHERE id = :id";

      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);
      $result->bindParam(':email', $email, PDO::PARAM_STR);
      
      return $result->execute();

    }

    public static function сomparePasswords($id, $password) {

      $db = Db::getConnection();

      $sql = "SELECT * FROM users WHERE id = :id";
      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);
      $result->setFetchMode(PDO::FETCH_ASSOC);
      $result->execute();

      $user = $result->fetch();
      
      if (strcmp($user['password'], $password) == 0) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Activation
     */
    public static function hash($hash) {

       $db = Db::getConnection();

      $sql = "SELECT * FROM users WHERE hash = :hash";
      $result = $db->prepare($sql);
      $result->bindParam(':hash', $hash, PDO::PARAM_INT);
      $result->setFetchMode(PDO::FETCH_ASSOC);
      $result->execute();

      $user = $result->fetch();
      
      if (strcmp($user['hash'], $hash) == 0) {
        return true;
      } else {
        return false;
      }
    }

    public static function setToActive($hash, $activation) {

      $db = Db::getConnection();
      
      $sql = "UPDATE users SET activation = :activation WHERE hash = :hash";
      $result = $db->prepare($sql);
      $result->bindParam(':hash', $hash, PDO::PARAM_STR);
      $result->bindParam(':activation', $activation, PDO::PARAM_STR);

      return $result->execute();
      
    }

    /**
     * Reset password
     */
    public static function getHash($email) {

       $db = Db::getConnection();

      $sql = "SELECT * FROM users WHERE email = :email";
      $result = $db->prepare($sql);
      $result->bindParam(':email', $email, PDO::PARAM_STR);
      $result->setFetchMode(PDO::FETCH_ASSOC);
      $result->execute();

      $user = $result->fetch();
      
      if (isset($user['hash'])) {
        return $user['hash'];
      } else {
        return false;
      }
    }

      public static function resetPassword($password, $hash) {

      $db = Db::getConnection();
      $password = hash("whirlpool", $password);

      $sql = "UPDATE users SET password = :password WHERE hash = :hash";

      $result = $db->prepare($sql);
      $result->bindParam(':password', $password, PDO::PARAM_STR);
      $result->bindParam(':hash', $hash, PDO::PARAM_STR);

      return $result->execute();

    }
    /**
     * Notification
     */
    public static function setNotification($userId, $flag) {

      $db = Db::getConnection();

      $sql = "UPDATE users SET notification = :flag WHERE id = :userId";

      $result = $db->prepare($sql);
      $result->bindParam(':userId', $userId, PDO::PARAM_INT);
      $result->bindParam(':flag', $flag, PDO::PARAM_INT);

      return $result->execute();

    }
 }

