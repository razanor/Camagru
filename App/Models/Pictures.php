<?php

class Pictures
{
    /**
     * Add
     */
    public static function addPhoto($path, $userId) {

        $db = Db::getConnection();
  
        $sql = 'INSERT INTO images (path, userId) '
                . 'VALUES (:path, :id)';
  
        $result = $db->prepare($sql);
        $result->bindParam(':path', $path, PDO::PARAM_STR);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * Get
     */
    public static function getPhoto() {

        $db = Db::getConnection();

        $sql = "SELECT * FROM images ORDER BY creation desc";
        $result = $db->prepare($sql);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetchAll();
    }

    public static function getPhotoById($id) {
        
        $db = Db::getConnection();

        $sql = "SELECT * FROM images WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();

    }

    public static function getAllPhotoByUserId($userId) {

        $db = Db::getConnection();
        
        $sql = "SELECT * FROM images WHERE userId = :userId ORDER BY creation desc";
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetchAll();

    }

    public static function getSuperImg() {
        
        $db = Db::getConnection();
        
        $sql = "SELECT * FROM super";
        $result = $db->prepare($sql);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetchAll(); 
    }

    public static function getSuperById($id) {

        $db = Db::getConnection();
        
        $sql = "SELECT * FROM super WHERE id = :id";
        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch(); 

    }

    /**
     * Likes and comments
     */

     public static function addLike($id) {

      $db = Db::getConnection();

      $sql = "UPDATE images SET likes = likes + 1 WHERE id = :id";

      $result = $db->prepare($sql);
      $result->bindParam(':id', $id, PDO::PARAM_INT);

      return $result->execute();
    }

    public static function removeLike($id) {

        $db = Db::getConnection();
  
        $sql = "UPDATE images SET likes = likes - 1 WHERE id = :id";
  
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
  
        return $result->execute();
      }
    
    public static function getCommentsById($imgId) {
      
        $db = Db::getConnection();

        $sql = "SELECT username, comment FROM comments WHERE imgId = :imgId";
        $result = $db->prepare($sql);
        $result->bindParam(':imgId', $imgId, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetchAll();
    } 

    public static function addComment($imgId, $userId, $comment, $username) {

        $db = Db::getConnection();
        
        $sql = 'INSERT INTO comments (username, comment, userId, imgId) '
                . 'VALUES (:username, :comment, :userId, :imgId)';
  
        $result = $db->prepare($sql);
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':comment', $comment, PDO::PARAM_STR);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->bindParam(':imgId', $imgId, PDO::PARAM_INT);
  
        return $result->execute();
                
    }

    public static function addUniqueLike($imgId, $userId) {

        $db = Db::getConnection();

        $sql = 'INSERT INTO likes (userId, imgId) '
        . 'VALUES (:userId, :imgId)';

        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->bindParam(':imgId', $imgId, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function removeUniqueLike($imgId, $userId) {
        
        $db = Db::getConnection();

        $sql = "DELETE FROM likes WHERE userId = :userId AND imgId = :imgId";

        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->bindParam(':imgId', $imgId, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function getUniqueLike($userId, $imgId) {

        $db = Db::getConnection();
    
        $sql = 'SELECT COUNT(*) FROM likes WHERE userId = :userId AND imgId = :imgId';
        
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->bindParam(':imgId', $imgId, PDO::PARAM_INT);
        $result->execute();
        if ($result->fetchColumn()) {
        return true;
        } else {
        return false;
        }   
    }

    /**
     * Delete
     */
    
    public static function deleteCommentsById($imgId) {

        $db = Db::getConnection();
        
        $sql = "DELETE FROM comments WHERE imgId = :imgId";

        $result = $db->prepare($sql);
        $result->bindParam(':imgId', $imgId, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function deleteLikesById($imgId) {

        $db = Db::getConnection();
        
        $sql = "DELETE FROM likes WHERE imgId = :imgId";

        $result = $db->prepare($sql);
        $result->bindParam(':imgId', $imgId, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function deleteImgById($id) {

        $db = Db::getConnection();
        
        $sql = "DELETE FROM images WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

}