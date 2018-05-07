<?php

include_once ROOT . '/App/Models/Users.php';
include_once ROOT . '/App/Models/Pictures.php';

class MainController 
{
    public function actionView() {
        
        $pictures = Pictures::getPhoto();
        
        foreach ($pictures as $picture) {
            echo $picture['name'];
        }
        // here
        
        require_once (ROOT. '/App/Views/index.php');
        return true;
    }

    public function actionUser() {

        $userId = Users::checkLogged();
        
        $user = Users::getUsernameById($userId);

        require_once (ROOT. '/App/Views/Users/user-page.php');
        return true;
    }
}