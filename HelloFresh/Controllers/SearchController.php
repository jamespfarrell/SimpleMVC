<?php

namespace HelloFresh\Controllers;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent as Eloquent;
use HelloFresh\Utils\FormUtils as FormUtils;

class SearchController
{

    /**
     * @var formUtils
     */
    private $formUtils;

    public function __construct(FormUtils $formUtils){

        $this->formUtils = $formUtils;
    }

    public function index($view)
    {
        echo $view->output();
    }

    public function postSearch($POST, $view){

        if (isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] == true)
        {
            $searchText = $this->formUtils->sanitiseInput($POST['searchText']);

            $users = Capsule::table('users')
                //->where('email', '=', $email)
                ->where('name', 'LIKE', "%$searchText%")
                ->where('email', 'LIKE', "%$searchText%")
                ->get();

            echo $view->output($searchText, $users);
        }
        else
        {
            $_SESSION['screenMessage'] = "<p style='color:red'>You need to be logged in, in order to do a search</p>";
            header("Location: /auth/login");
            exit();
        }
    }
}