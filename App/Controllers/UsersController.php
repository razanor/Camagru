<?php

include_once ROOT . '/App/Models/Users.php';

class UsersController
{
    /**
     * Mail sending
     */
    private function mailSend($name, $email, $hash)
    {
        $to = $email; // Send email to our user
        $encoding = "utf-8";
        $subject = 'Signup | Verification'; // Give the email a subject
        $from_name = "Camagru";
        $from_mail = "nrepak@student.unit.ua";

        $message = '
        
       Thanks for signing up!
       Your account has been created.
       <br>
       Please click this link to activate your account:
       <br>
       <a href="http://127.0.0.1:8080/activation/'.$hash.'">Click here!</a>
       
       '; // Our message above including the link
    
        // Set preferences for Subject field
        $subject_preferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );
    
        // Set mail header
        $header = "Content-type: text/html; charset=".$encoding." \r\n";
        $header .= "From: ".$from_name." <".$from_mail."> \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-Transfer-Encoding: 8bit \r\n";
        $header .= "Date: ".date("r (T)")." \r\n";
        $header .= iconv_mime_encode("Subject", $subject, $subject_preferences);
                          
        return mail($to, $subject, $message, $header); // Send our email

    }

    /**
     * User activation
     */

     public function actionActivation($param)
     {
        $check = Users::hash($param[0]);

        if ($check == true) {
            Users::setToActive($param[0], 1);
        }
        require_once(ROOT.'/App/Views/Users/activation.php');
        return true;
     }

   /**
    * Register
    */
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $result = false;
        $mail = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_repeat = $_POST['password_repeat'];

            $errors = array();

            if (!Users::checkEmail($email)) {
                $errors[] = "Wrong email";
            }

            if (!Users::checkName($name)) {
                $errors[] = "The username should be more than 4 symbols";
            }

            if (!Users::checkPassword($password)) {
                $errors[] = "The password should be more than 6 symbols";
            }

            if (Users::checkEmailExists($email)) {
                $errors[] = "This email is already in use";
            }

            if (Users::checkUserExists($name)) {
                $errors[] = "This username is already exists";
            }

            if (strcmp($password, $password_repeat) !== 0) {
                $errors[] = "Passwords don't match";
            }


            if (empty($errors)) {
                $hash = md5(rand(0,1000));
                $mail = self::mailSend($name, $email, $hash);
                                
                $result = Users::register($name, $email, $password, $hash);
            }
        }

        require_once(ROOT.'/App/Views/Users/register.php');
        return true;
    }

    /**
     * Login
     */
    public function actionLogin() {
        
        $name = '';
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];

            $errors = array();

            if (!Users::checkName($name)) {
                $errors[] = "The username should be more than 2 symbols";
            }

            if (!Users::checkPassword($password)) {
                $errors[] = "The password should be more than 6 symbols";
            }

            $userId = Users::check_user($name, hash('whirlpool', $password), 1);

            if ($userId == false) {
                $errors[] = 'Wrong password or username';
            } else {
                Users::auth($userId);

                header("Location: /user-page/");
            }

        }

        require_once(ROOT. '/App/Views/Users/login.php');
        return true;
        
    }

    /**
     * Logout
     */
    public function actionLogout() {

        unset($_SESSION['user']);
        header("Location: /");
    }

    /**
     * Edit
     */
    public function actionEdit() {

        $userId = Users::checkLogged();
        
        $user = Users::getUsernameById($userId);
        $name = $user['username'];
        $email = $user['email'];
        $password = $user['password'];

        $errors = array();
        $flag = 0;
        $result = false;

        if (isset($_POST['submit_name'])) {
            $flag = 1;
            $name = $_POST['name'];
            if (!Users::checkName($name)) {
                $errors[] = "The username should be more than 4 symbols";
            }
            if (Users::checkUserExists($name)) {
                $errors[] = "This username is already exists";
            }
        }

        if (isset($_POST['submit_email'])) {
            $flag = 1;
            $email = $_POST['email'];
            if (!Users::checkEmail($email) ) {
                $errors[] = "Wrong email";
            }
            if (Users::checkEmailExists($email)) {
                $errors[] = "This email is already exists";
            }
        }

        if (isset($_POST['submit_password'])) {
            $flag = 1;
            $password = $_POST['new_password'];
            $password_old = $_POST['old_password'];
            if (!Users::checkPassword($password)) {
                $errors[] = "The new password should be more than 6 symbols";
            }
            if (!Users::сomparePasswords($userId, hash("whirlpool", $password_old))) {
                $errors[] = "The old password doesn't match";
            }
        }

        if (empty($errors) && $flag == 1)  {
            if (isset($_POST['submit_password'])) {
                $password = hash("whirlpool", $password);
            }
            $result = Users::edit($userId, $name, $email, $password);
        }
        require_once (ROOT. '/App/Views/Users/edit.php');
        return true;

    }
}