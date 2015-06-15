<?php

namespace HelloFresh\Controllers;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent as Eloquent;
use HelloFresh\Utils\EncryptUtil;
use HelloFresh\Utils\formUtils;
use Respect\Validation\Validator as v;
use HelloFresh\Repositories\UserRepository;


class AuthController
{
    private $userl;
    private $view;
    private $action;
    /**
     * @var formUtils
     */
    private $formUtils;
    /**
     * @var EncryptUtil
     */
    private $encryptUtil;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param $model
     * @param $view
     */
    public function __construct($user, formUtils $formUtils, EncryptUtil $encryptUtil, UserRepository $userRepository){

        $this->user = $user;

        $this->formUtils = $formUtils;
        $this->encryptUtil = $encryptUtil;

        $this->userRepository = $userRepository;
    }

   public function register($view) {

        echo $view->output();
    }

    public function login($view) {

        echo $view->output();

    }

    public function logout($view) {

        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();

        header("Location: /");
        exit();

    }

    public function postLogin($POST){

        if (isset($POST["action"]) && $POST["action"] == "loginSubmit")
        {
            $email = $this->formUtils->sanitiseInput($POST['email']);
            $password = $this->formUtils->sanitiseInput($POST['password']);

            $users = $this->userRepository->getUsers($email);

            if ($this->encryptUtil->verify($POST['password'], $users[0]['password'])) {

                $_SESSION['loggedIn'] = true;
                $_SESSION['name'] = $users[0]['name'];
                $_SESSION['screenMessage'] = "<p>Welcome ".$_SESSION['name']."</p>";

                header("Location: /");
                exit();
            }
            else
            {
                $_SESSION['screenMessage'] = "<p class='error'>Your password is incorrect</p>";
                header("Location: /auth/login");
                exit();

            }
        }
        else{
            header("Location: /auth/login");
        }
    }

    public function postRegister($POST) {

        if ((isset($POST["action"]) && $POST["action"] == "registerSubmit"))
        {
            $name = $this->formUtils->sanitiseInput($POST['name']);
            $email = $this->formUtils->sanitiseInput($POST['email']);
            $password = $this->formUtils->sanitiseInput($POST['password']);
            $passwordRepeat = $this->formUtils->sanitiseInput($POST['passwordRepeat']);

            $registrationErrorArray = Array();
            $inError = false;
            $_SESSION['thisEmail'] = $email;
            $_SESSION['thisName'] = $name;

            if ($password != $passwordRepeat)
            {
                $registrationErrorArray[] = "passwordMatch";
                $inError = true;


            }
            if (!v::email()->validate($email))
            {
                $registrationErrorArray[] = "email";
                $inError = true;

            }
            if (!v::alnum()->noWhitespace()->length(1, 15)->validate($name))
            {
                $registrationErrorArray[] = "name";
                $inError = true;

            }
            if (!v::alnum()->noWhitespace()->length(1, 15)->validate($password) or !v::alnum()->noWhitespace()->length(1, 15)->validate($passwordRepeat))
            {
                $registrationErrorArray[] = "password";
                $inError = true;

            }


            if ($inError == false)
            {
                $this->user->name = $name;
                $this->user->email = $email;
                $this->user->password =  $this->encryptUtil->encryptString($password);

                $_SESSION['screenMessage'] = "<h3>You have successfully registered</h3>";

                $this->user->save();
                header("Location: /auth/login");
                die();
            }
            else
            {
                $_SESSION['screenMessage'] = "<h1>There were errors</h1>";
                $_SESSION['registrationErrorArray'] = $registrationErrorArray;

                header("Location: /auth/register");
                die();
            }
        }




    }
}
