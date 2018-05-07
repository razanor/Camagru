<?php

class Pictures
{
    /**
     * Add
     */
    public function addPhoto($path) {

        $db = Db::getConnection();
  
        $sql = 'INSERT INTO images (name) '
                . 'VALUES (:path)';
  
        $result = $db->prepare($sql);
        $result->bindParam(':path', $path, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Get
     */
    public function getPhoto() {

        $db = Db::getConnection();

        $sql = "SELECT * FROM images";
        $result = $db->prepare($sql);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetchAll();
    }
}