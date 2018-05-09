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

     public static function check_user($name, $password) {

      $db = Db::getConnection();

      $sql = 'SELECT * FROM users WHERE username = :name AND password = :password';

      $result = $db->prepare($sql);
      $result->bindParam(':name', $name, PDO::PARAM_STR);
      $result->bindParam(':password', $password, PDO::PARAM_STR);
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

    public static function edit($id, $username, $email, $password) {

      $db = Db::getConnection();

      $sql = "UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id";

      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);
      $result->bindParam(':username', $username, PDO::PARAM_STR);
      $result->bindParam(':email', $email, PDO::PARAM_STR);
      $result->bindParam(':password', $password, PDO::PARAM_STR);

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
 }
