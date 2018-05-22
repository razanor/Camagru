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
            $errors = array();

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
                        $result = Pictures::addPhoto($fileDestination, $userId);
                        header ("Location: /user-page/");
                    } else {
                        $errors[] = "Your file is too big!";
                    }
                } else {
                    $errors[] = "There was an error uploading your file";
                }
            } else {
                $errors[] = "You cannot upload files of this type!";
            }

        }
        require_once (ROOT. '/App/Views/add.php');
    }

    public function actionsavePhoto() {
        $userId = Users::checkLogged();

        if (isset($_POST['data'])) {
            // convert from base64 to img
            $img = $_POST['data'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = ROOT . '/uploads/' . uniqid() . '.jpeg';
            $success = file_put_contents($file, $data);

            // add path to database
            $file = substr(strrchr($file, "/"), 1);
            $fileDestination = $_SERVER['HTTP_ORIGIN'] . '/uploads/' .$file;
            $result = Pictures::addPhoto($fileDestination, $userId);
        }
        return true;
    }

    public function actiontakePhoto() {
        $userId = Users::checkLogged();

        require_once (ROOT. '/App/Views/take-photo.php');
        return true;
    }

    /**
     * Posts
     */

     public function actionPost($params) {


        $picture = Pictures::getPhotoById($params[0]);
        $user = Users::getUserNameById($picture['userId']);

        require_once (ROOT. '/App/Views/posts.php');
        return true;
     }

     public function actionPostRegisterUser($params) {

        $userId = Users::checkLogged();
        $picture = Pictures::getPhotoById($params[0]);
        $user = Users::getUserNameById($picture['userId']);


        require_once (ROOT. '/App/Views/Users/posts-register.php');

        return true;
     }

     /**
      * Posts like and comments
      */
    
    public function actionLikePost() {

        if (isset($_POST['data'])) {
            $result = Pictures::addLike($_POST['data']);
        }
        if (isset($_POST['data1'])) {
            $result = Pictures::removeLike($_POST['data1']);
        }
        return true;
    }

}
