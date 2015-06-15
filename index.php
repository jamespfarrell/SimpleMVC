<?php

require "vendor/autoload.php";

use HelloFresh\Models\Model;
use HelloFresh\Repositories\UserRepository;
use HelloFresh\Views\LoginView;
use HelloFresh\Utils\EncryptUtil;
use HelloFresh\Utils\FormUtils;
use HelloFresh\Views\IndexView;
use HelloFresh\Views\RegisterView;
use HelloFresh\Views;
use HelloFresh\Utils;
use HelloFresh\Models\UserModel;
use HelloFresh\Models;
use Respect\Validation\Validator as v;
use HelloFresh\Routes;


//use HelloFresh;

session_start();

if (!isset($_GET['controller']))
{
    $controller = "search";
}
else{
    $controller = $_GET['controller'];
}

if (!isset($_GET['action']))
{
    $action = "index";
}
else
{
    $action = $_GET['action'];
}





if (!empty($controller)) {
/*
    $data = array(
        'index' => array('model' => 'Model', 'view' => 'IndexView', 'controller' => 'Controller'),
        'login' => array('model' => 'Model', 'view' => 'LoginView', 'controller' => 'AuthController'),
        'logout' => array('model' => 'Model', 'view' => 'LoginView', 'controller' => 'AuthController'),
        'auth' => array('model' => 'Model', 'view' => 'RegisterView', 'controller' => 'AuthController'),
        'search' => array('model' => 'Model', 'view' => 'LoginView', 'controller' => 'SearchController'),
        'register' => array('model' => 'UserModel', 'view' => 'RegisterView', 'controller' => 'AuthController')
    );

    foreach($data as $key => $components){
        if ($controller == $key) {

            $modelName = "\\HelloFresh\\Models\\".$components['model'];
            $viewName = "\\HelloFresh\\Views\\".$components['view'];
            $controllerName = "\\HelloFresh\\Controllers\\".$components['controller'];
            break;
        }
    }
*/

/*
    if (!(empty($model) || empty($view) || empty($controller) || empty($action))) {
        $m = new $model();
        $c = new $controller($m, $action);
        $v = new $view($m);
        echo $v->output();
    }//if (isset($modelName)) {
    $controllerName = "\\HelloFresh\\Controllers\\".$controller;

    $modelName = "\\HelloFresh\\Models\\".getModel($controller, $action);
    $model = new $modelName();

    $viewName = "\\HelloFresh\\Views\\".getView($controller, $action, $model);
    $view = new $viewName($model);

    echo $modelName;
*/

    $Routes = new Routes();

    $model = $Routes->getModel($controller, $action);
    $view = $Routes->getView($controller, $action, $model);

    $actionParams = $Routes->getActionParams($action, $view, $_POST);
    $constructorParams = $Routes->getConstructorParams($controller, new UserModel, new FormUtils(),  new EncryptUtil(), new UserRepository());
    $controllerName = $Routes->getControllerName($controller);

    $frontController = new \HelloFresh\FrontController(array(
            "controller" => $controllerName,
            "action"     => $action,
            "constructorParams"     => $constructorParams ,
            "params"     => $actionParams
        ));

        $frontController->run();

        //$controller->$action($view);

        //echo $view->output();
    //}
}

/* $data = array(
                'register' => array(
                    "index" => array('model' => 'Model', 'view' => 'RegisterView', 'controller' => 'AuthController'),
                    'postRegister' => array('model' => 'Model', 'view' => 'RegisterView', 'controller' => 'AuthController')
                )
            );
    /*$data = array(
        'index' => array('model' => 'Model', 'view' => 'IndexView', 'controller' => 'Controller'),
        'login' => array('model' => 'Model', 'view' => 'LoginView', 'controller' => 'AuthController'),
        'logout' => array('model' => 'Model', 'view' => 'LoginView', 'controller' => 'AuthController'),
        'auth' => array('model' => 'Model', 'view' => 'RegisterView', 'controller' => 'AuthController'),
        'search' => array('model' => 'Model', 'view' => 'LoginView', 'controller' => 'SearchController'),
        'register' => array('model' => 'Model', 'view' => 'RegisterView', 'controller' => 'AuthController')
    );* /

foreach($data as $key => $controllerRoutes){
    if ($controller == $key) {
        foreach($controllerRoutes as $key2 => $actionRoutes){
            if ($action == $key2) {
                /*$modelName = $components['model'];
                $controllerName = $components['controller'];
                $viewName =$components['view'];* /
                $modelName = "\\HelloFresh\\Models\\" . $actionRoutes['model'];
                $viewName = "\\HelloFresh\\Views\\" . $actionRoutes['view'];
                $controllerName = "\\HelloFresh\\Controllers\\" . $actionRoutes['controller'];
                break;
            }
        }
    }*/