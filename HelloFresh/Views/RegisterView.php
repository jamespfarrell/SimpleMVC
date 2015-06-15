<?php

namespace HelloFresh\Views;

class RegisterView extends View{

    private $model;

    public function __construct ($model)
    {
        $this->model = $model;
    }

    public function output() {

        $returnHtml = "";

        $returnHtml = $this->getScreenMessageMarkup($returnHtml);

        $returnHtml = $this->getSessionMarkup($returnHtml);

        $returnHtml = $this->getRegisterFormMarkup($returnHtml);

        $returnHtml = $this->getPageMarkup($returnHtml);

        return $returnHtml;
    }

    public function addValueToTemplate ($variable, $value, $template) {

        $template = str_replace("{" . $variable . "}", $value, $template);

        return $template;
    }

    private function addAnyErrorsToTemplate($template) {

        if (isset($_SESSION['screenMessage']) and $_SESSION['screenMessage'] <> "")
        {

            $_SESSION['screenMessage'] = "";

            $template = $this->addValueToTemplate("ScreenMessage", $_SESSION['screenMessage'], $template);

        }
        else
        {
            $template = $this->addValueToTemplate("ScreenMessage", "", $template);
        }
        //die(var_dump($template));
        $emailError = "";
        $nameError="";
        $passwordError="";

        if (isset($_SESSION['registrationErrorArray']) AND count($_SESSION['registrationErrorArray']) > 0)
        {
            foreach($_SESSION['registrationErrorArray'] as $error)
            {
                if ($error == 'email')
                {
                    $template = $this->addValueToTemplate("EmailInputClass", "errorInput", $template);
                    $template = $this->addValueToTemplate("EmailInputValue", $_SESSION['thisEmail'], $template);
                    $template = $this->addValueToTemplate("EmailInputErrorMessage", "Please enter a valid email address", $template);

                }
                elseif($error == 'name')
                {
                    $template = $this->addValueToTemplate("NameInputClass", "errorInput", $template);
                    $template = $this->addValueToTemplate("NameInputValue", $_SESSION['thisName'], $template);
                    $template = $this->addValueToTemplate("NameInputErrorMessage", "Please enter your name", $template);
                }
                elseif($error == 'password')
                {
                    $template = $this->addValueToTemplate("PasswordInputClass", "errorInput", $template);
                    $template = $this->addValueToTemplate("PasswordInputErrorMessage", "Please enter a password", $template);
                }
                elseif($error == 'passwordMatch')
                {
                    $template = $this->addValueToTemplate("PasswordRepeatInputClass", "errorInput", $template);
                    $template = $this->addValueToTemplate("PasswordRepeatInputErrorMessage", "Please make sure your passwords match", $template);
                }


            }


        }

        $template =$this->addValueToTemplate("EmailInputClass", "", $template);
        $template =$this->addValueToTemplate("EmailInputValue", "", $template);
        $template =$this->addValueToTemplate("EmailInputErrorMessage", "", $template);

        $template = $this->addValueToTemplate("NameInputClass", "", $template);
        $template = $this->addValueToTemplate("NameInputValue", "", $template);
        $template = $this->addValueToTemplate("NameInputErrorMessage", "", $template);

        $template = $this->addValueToTemplate("PasswordInputClass", "", $template);
        $template = $this->addValueToTemplate("PasswordInputErrorMessage", "", $template);

        $template = $this->addValueToTemplate("PasswordRepeatInputClass", "", $template);
        $template = $this->addValueToTemplate("PasswordRepeatInputErrorMessage", "", $template);



        return $template;
    }


    protected function getRegisterFormMarkup($returnHtml)
    {
        $mainTemplateFile = "templates/RegisterForm.tpl.php";

        $template = $this->getPageTemplate($mainTemplateFile);

        $returnHtml = $this->addAnyErrorsToTemplate($template);

        return $returnHtml;

    }

}
