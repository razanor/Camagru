<?php

include_once ROOT . '/App/Models/Users.php';

class UsersController
{
   /**
    * Register
    */
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $result = false;

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
                $errors[] = "This username is already exist";
            }

            if (strcmp($password, $password_repeat) !== 0) {
                $errors[] = "Passwords don't match";
            }


            if (empty($errors)) {
                $result = Users::register($name, $email, $password);
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

            $userId = Users::check_user($name, hash('whirlpool', $password));

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
                $errors[] = "This username is already exist";
            }
        }

        if (isset($_POST['submit_email'])) {
            $flag = 1;
            $email = $_POST['email'];
            if (!Users::checkEmail($email) ) {
                $errors[] = "Wrong email";
            }
            if (Users::checkEmailExists($email)) {
                $errors[] = "This email is already exist";
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
            $result = Users::edit($userId, $name, $email, hash("whirlpool", $password));
        }
        require_once (ROOT. '/App/Views/Users/edit.php');
        return true;

    }
}