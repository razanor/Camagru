<?php

include_once ROOT . '/App/Models/Pictures.php';
include_once ROOT . '/App/Models/Users.php';
include_once ROOT . '/App/Controllers/UsersController.php';


class PicturesController extends UsersController
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

                        $fileDestination = '/uploads/' .$fileNameNew;
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
            $file = ROOT . '/uploads/' . uniqid() . '.png';
            $success = file_put_contents($file, $data);

            // add path to database
            $file = substr(strrchr($file, "/"), 1);
            $fileDestination = '/uploads/' .$file;
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
        $comments = Pictures::getCommentsById($params[0]);
        

        require_once (ROOT. '/App/Views/posts.php');
        return true;
     }

     public function actionPostRegisterUser($params) {

        $userId = Users::checkLogged();
        $picture = Pictures::getPhotoById($params[0]);
        $user = Users::getUserNameById($userId);
        $userCom = Users:: getUserNameById($picture['userId']);

        $comments = Pictures::getCommentsById($params[0]);
        $likesFlag = Pictures::getUniqueLike($userId, $params[0]);
        $userName = $user['username'];
        $userComment = $userCom['username']; 

        require_once (ROOT. '/App/Views/Users/posts-register.php');

        return true;
     }

     /**
      * Posts like and comments
      */
    
    public function actionLikePost() {

        $userId = Users::checkLogged();
        
        if (isset($_POST['data'])) {
            $result = Pictures::addLike($_POST['data']);
            Pictures::addUniqueLike($_POST['data'], $userId);
        }
        if (isset($_POST['data1'])) {
            $result = Pictures::removeLike($_POST['data1']);
            Pictures::removeUniqueLike($_POST['data1'], $userId);
        }
        return true;
    }

    public function actionaddComment() {

        $userId = Users::checkLogged();
        $user = Users::getUsernameById($userId);
        

        $username = $user['username'];
        $email = $user['email'];
        $notification = $user['notification'];


        if (isset($_POST['action'])) {
            $result = Pictures::addComment($_POST['img-id'], $userId, $_POST['body'], $username);
            if ($result === true && $notification == 1) {

                $subject = 'New comment';
                $message = '
                
                Somebody comment your post. Please check it.
               
               ';
                $mail = UsersController::mailSend($message, $email, $subject);
            }
            
        }
        return true;
    }

}
