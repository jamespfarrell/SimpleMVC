<?php

namespace HelloFresh\Views;

class LoginView extends View{

    public function output() {

        $returnHtml = "";

        $returnHtml = $this->getScreenMessageMarkup($returnHtml);

        $returnHtml = $this->getSessionMarkup($returnHtml);

        $returnHtml = $this->getLoginFormMarkup($returnHtml);

        $returnHtml = $this->getPageMarkup($returnHtml);

        return $returnHtml;
    }
    protected function getLoginFormMarkup($returnHtml)
    {
        $mainTemplateFile = "templates/LoginForm.tpl.php";

        $template = $this->getPageTemplate($mainTemplateFile);

        $returnHtml = $returnHtml . $this->addAnyErrorsToTemplate($template);

        return $returnHtml;

    }

    private function addAnyErrorsToTemplate($returnHtml)
    {
        return $returnHtml;
    }

        /*public function output() {

            $returnHtml = "";


            if (isset($_SESSION['screenMessage']) and $_SESSION['screenMessage'] <> "")
            {
                echo $_SESSION['screenMessage'];
                $_SESSION['screenMessage'] = "";
            }

            require_once("includes/templates/loginTemplate.php");

            return $returnHtml;
        }*/
}

