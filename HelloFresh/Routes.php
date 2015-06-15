<?php

namespace HelloFresh;

use HelloFresh\Models\UserModel;
use HelloFresh\Repositories\UserRepository;
use HelloFresh\Utils\EncryptUtil;
use HelloFresh\Utils\FormUtils as FormUtils;
use HelloFresh\Views\LoginView;

class Routes
{
    private $Models = array(
                        "auth" => array(
                            "register" => "UserModel"
                        )
                    );

    private $views = array(
        "search" => array(
            "index" => "IndexView",
            "postSearch" => "SearchListView"
        ),
        "auth" => array(
            "login" => "LoginView",
            "register" => "RegisterView"
        )
    );

    private $controllers = array(
        "auth" => "AuthController",
        "search" => "SearchController"
    );

    public function getView($controller, $action, $model)
    {
        $viewName = $this->getViewName($controller, $action, $model);

        if ($viewName != "")
        {
            if ($model != "")
            {
                $viewName = "\\HelloFresh\\Views\\".$viewName;
                return new $viewName($model);
            }
            else
            {
                $viewName = "\\HelloFresh\\Views\\".$viewName;
                return new $viewName();
            }
        }
        else
        {
            echo false;
        }
    }

    function getModel($controller, $action)
    {
        if($controller == "auth" and $action = "register")
        {
            return new UserModel();
        }
    }

    function getControllerName($controller)
    {


        if (array_key_exists($controller, $this->controllers))
        {
            return $this->controllers[$controller];
        }
        else
        {
            return "";
        }


    }

    function getModelName($controller, $action)
    {

        if (array_key_exists($controller, $this->Models) AND array_key_exists($action, $this->Models[$controller]))
        {
            return $this->Models[$controller][$action];
        }
        else
        {
            return "";
        }


    }

    public function getViewName($controller, $action)
    {

        if (array_key_exists ($controller, $this->views) AND array_key_exists($action, $this->views[$controller]))
        {
            return $this->views[$controller][$action];
        }
        else
        {
            return "";
        }

    }

    function getConstructorParams($controller, UserModel $user, FormUtils $FormUtils, EncryptUtil $EncryptUtil, UserRepository $userRepository)
    {
        if ($controller == "auth")
        {
            $constructorParams = array($user, $FormUtils, $EncryptUtil, $userRepository);
        }
        elseif ($controller == "search") {
            $constructorParams = array($FormUtils);
        }
        else
        {
            $constructorParams = array();
        }

        return $constructorParams;
    }

    /**
     * @param $action
     * @param $view
     * @param $viewName
     * @param $model
     * @return array
     */
    function getActionParams($action, $view, $POST)
    {
        if ($action == "login" or $action=="index" or $action=="register") {

            $actionParams = array($view);

        }
        elseif ($action == "postLogin" or $action == "postRegister" ) {

            $actionParams = array($POST);

        }
        elseif($action == "postSearch")
        {
            $actionParams = array($POST, $view);
        }
        else {

            $actionParams = array($POST);

        }

        return $actionParams;
    }
}
