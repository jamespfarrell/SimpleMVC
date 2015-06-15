<?php

namespace HelloFresh\Views;

class SearchListView extends View
{

    public function output($searchText, $users)
    {

        $returnHtml = "";

        $returnHtml = $this->getScreenMessageMarkup($returnHtml);

        $returnHtml = $this->getSessionMarkup($returnHtml);

        $returnHtml = $this->getSearchResultsMarkup($returnHtml, $searchText, $users);

        $returnHtml = $this->getPageMarkup($returnHtml);

        return $returnHtml;
    }

    protected function getSearchResultsMarkup($returnHtml, $searchText, $users)
    {
        $returnHtml.= "<h2>You have searched for '$searchText'</h2>";

        foreach( $users as $user)
        {
            $returnHtml .=  "<p><b>User id is </b>" . $user["id"];
            $returnHtml .=  "<p><b>Email is </b> " . $user["email"]."</p><hr/>";
        }

        return $returnHtml;

    }

    private function addAnyErrorsToTemplate($returnHtml)
    {
        return $returnHtml;
    }
}
