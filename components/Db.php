<?php

class Db 
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/components/db_params.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

        try {
        $db = new PDO($dsn, $params['user'], $params['password']);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
       return $db;
    }
}