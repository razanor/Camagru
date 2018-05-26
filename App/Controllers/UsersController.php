<?php

include_once ROOT . '/App/Models/Users.php';

class UsersController
{
    /**
     * Mail sending
     */
    protected function mailSend($message, $email, $subject)
    {
        $to = $email; // Send email to our user
        $encoding = "utf-8";
        $from_name = "Camagru";
        $from_mail = "nrepak@student.unit.ua";
    
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
                $subject = 'Signup | Verification';
                $message = '
                
               Thanks for signing up!
               Your account has been created.
               <br>
               Please click this link to activate your account:
               <br>
               <a href="http://127.0.0.1:8080/activation/'.$hash.'">Click here!</a>
               
               ';
                $mail = self::mailSend($message, $email, $subject);
                                
                $result = Users::register($name, $email, $password, $hash);
            }
        }

        require_once(ROOT.'/App/Views/Users/register.php');
        return true;
    }

    /**
     * Reset password
     */
    public function actionReset() {
     
        $email = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];

            $errors = array();

            if (!Users::checkEmailExists($email)) {
                $errors[] = "This email isn't exist!";
            }
            if (empty($errors)) {
                $result = true;
                $hash = Users::getHash($email);
                $subject = 'Reset password';
                $message = '
                
                To reset password follow this link:
               <br>
               <a href="http://127.0.0.1:8080/reset-password/'.$hash.'">Click here!</a>
               
               ';
                $mail = self::mailSend($message, $email, $subject);   
            }
        }
        require_once(ROOT. '/App/Views/Users/reset.php');
        return true;
    }

    public function actionresetPassword($params) {

        $check = Users::hash($params[0]);
        $reset = false;

        if ($check === true) {
            if (isset($_POST['submit'])) {
                $password = $_POST['password'];
                $password_repeat = $_POST['password_repeat'];

                $errors = array();

                if (!Users::checkPassword($password)) {
                    $errors[] = "The password should be more than 6 symbols";
                }

                if (strcmp($password, $password_repeat) !== 0) {
                    $errors[] = "Passwords don't match";
                }

                if (empty($errors)) {
                    $reset = Users::resetPassword($password, $params[0]);
                }
    
        }

        require_once(ROOT. '/App/Views/Users/reset-password.php');
        return true;
    }
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
        $notification = $user['notification'];

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

    public function actionNotification() {

        $userId = $_POST['id'];
        $notification = $_POST['notification'];

        if ($notification === "off") {
            $return = Users::setNotification($userId, 0);
        } else {
            $return = Users::setNotification($userId, 1);
        }
        return true;
    }
}