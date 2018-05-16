<?php

include_once ROOT . '/App/Models/Pictures.php';
include_once ROOT . '/App/Models/Users.php';


class PicturesController
{
    /**
     * Add 
     */

     public function actionAdd() {

        $userId = Users::checkLogged();
        
        if (isset($_POST['submit'])) {
            $file = $_FILES['file'];

            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 500000) {
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = ROOT. '/uploads/' .$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $fileDestination = substr(strrchr($fileDestination, "/"), 1);
                        $fileDestination = $_SERVER['HTTP_ORIGIN'] . '/uploads/' .$fileNameNew;
                        $result = Pictures::addPhoto($fileDestination);
                        header ("Location: /user-page/");
                    } else {
                        echo "Your file is too big!";
                    }
                } else {
                    echo "There was an error uploading your file";
                }
            } else {
                echo "You cannot upload files of this type!";
            }

        }
        require_once (ROOT. '/App/Views/add.php');
    }

    public function actiontakePhoto() {
        $userId = Users::checkLogged();

        var_dump($_POST);
        require_once (ROOT. '/App/Views/take-photo.php');
        return true;
    }
}
