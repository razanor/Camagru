<?php

include_once ROOT . '/App/Models/Users.php';
include_once ROOT . '/App/Models/Pictures.php';

class MainController 
{
    public function actionView() {
        
        $pictures = Pictures::getPhoto();
        
        require_once (ROOT. '/App/Views/index.php');
        return true;
    }

    public function actionUser() {

        $pictures = Pictures::getPhoto();

        require_once (ROOT. '/App/Views/Users/user-page.php');
        return true;
    }
}