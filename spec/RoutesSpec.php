<?php

namespace spec\HelloFresh;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoutesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('HelloFresh\Routes');
    }

    function it_is_login_view_name_exists()
    {
        $this->getViewName("auth", "login")->shouldbe("LoginView");
    }

    function it_is_register_view_name_exists()
    {
        $this->getViewName("auth", "register")->shouldbe("RegisterView");
    }

    function it_is_search_index_view_name_exists()
    {
        $this->getViewName("search", "index")->shouldbe("IndexView");
    }

    function it_is_a_search_list_view()
    {
        $this->getViewName("search", "postSearch")->shouldbe("SearchListView");
    }

    function it_is_a_register_user_model()
    {
        $this->getModelName("auth", "register")->shouldbe("UserModel");
    }

    function it_is_a_something_without_a_model()
    {
        $this->getModelName("auth", "nothing")->shouldbe("");
    }

    function it_should_be_a_user_model()
    {
        $this->getModel("auth", "register")->shouldBeAnInstanceOf('\HelloFresh\models\UserModel');
    }

    function it_should_be_a_login_view()
    {
        $this->getView("auth", "login", "")->shouldBeAnInstanceOf('\HelloFresh\Views\LoginView');
    }

    function it_should_be_a_register_view()
    {
        $this->getView("auth", "register", $this->getModel("auth", "register"))->shouldBeAnInstanceOf('\HelloFresh\Views\RegisterView');
    }

    function it_should_be_a_search_index_view()
    {
        $this->getView("search", "index", "")->shouldBeAnInstanceOf('\HelloFresh\Views\IndexView');
    }

    function it_should_be_a_search_list_view()
    {
        $this->getView("auth", "register", $this->getModel("auth", "register"))->shouldBeAnInstanceOf('\HelloFresh\Views\RegisterView');
    }

    function it_should_return_login_action_params()
    {
        $view =  $this->getView("auth", "login", "");
        $this->getActionParams("login", $view, "")->shouldbe(array($view));
    }


    function it_should_return_AuthController_constructor_params()
    {
        $controller = "auth";

        $returnArray = array(new \HelloFresh\Models\UserModel, new \HelloFresh\Utils\FormUtils(), new \HelloFresh\Utils\EncryptUtil(), new \HelloFresh\Repositories\UserRepository());

        $this->getConstructorParams("auth", new \HelloFresh\Models\UserModel, new \HelloFresh\Utils\FormUtils(),  new \HelloFresh\Utils\EncryptUtil(), new \HelloFresh\Repositories\UserRepository())[0]->shouldBeAnInstanceOf('\HelloFresh\Models\UserModel');


    }



}
