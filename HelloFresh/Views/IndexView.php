<?php

namespace HelloFresh\Views;

class IndexView extends View{

    public function output() {

        $returnHtml = "";

        $returnHtml = $this->getSessionMarkup($returnHtml);

        $returnHtml = $this->getSearchMarkup($returnHtml);

        $returnHtml = $this->getPageMarkup($returnHtml);

        return $returnHtml;
    }

    private function getSearchMarkup($returnHtml)
    {
        $template = $this->getPageTemplate("templates/search.tpl.php");

        return $returnHtml . $template;
    }

}
