<?php

namespace HelloFresh\Views;

class View
{
    private $model;

    public function output() {
        return '<p><a href="mvc.php?action=clicked"' . $this->model->string . "</a>link </p>";
    }

    public function getPageTemplate($file) {


        if (isset($file) && file_exists($file)) {
            $template = file_get_contents($file);
        }

        return $template;
    }

    public function getScreenMessageMarkup ($returnHtml)
    {
        if (isset($_SESSION['screenMessage']) and $_SESSION['screenMessage'] <> "")
        {
            $returnHtml .= $_SESSION['screenMessage'];
            $_SESSION['screenMessage'] = "";
        }
        return $returnHtml;
    }

    public function getSessionMarkup ($returnHtml)
    {
        if (isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] == true)
        {
            if (isset($_SESSION['name']) and $_SESSION['name'] <> "")
            {
                $returnHtml .= "<h2>Welcome ".$_SESSION['name']."</h2>";
            }
            else
            {
                $returnHtml .= "<h2>Welcome</h2>";
            }
        }
        else
        {
            $returnHtml .= "<h2>You are logged NOT in</h2>";

        }

        return $returnHtml;
    }

    protected function getPageMarkup($returnHtml)
    {
        $mainTemplateFile = "templates/page.tpl.php";

        $template = $this->getPageTemplate($mainTemplateFile);

        $template = str_replace("{" . "pageContent" . "}", $returnHtml, $template);

        return $template;
    }
}

