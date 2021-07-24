<?php

namespace Hail\Api;

class Client extends AbstractApi
{
    public function getCurrentUser()
    {
        return $this->makeRequest('GET', '/me');
    }

    public function getCurrentOrganizations()
    {
        $currentUser = $this->getCurrentUser();
        $currentUserId = $currentUser->id;

        return $this->makeRequest('GET', '/users/'. $currentUserId .'/organisations');
    }

    public function getCurrentArticles()
    {
        $currentOrganisations = $this->getCurrentOrganizations();
        $articles = [];
        
        foreach ($currentOrganisations as $org) {
            $organisation_articles = $this->makeRequest('GET', '/organisations/'. $org->id .'/articles');
            $articles = array_merge($organisation_articles, $articles);
        }

        return $articles;
    }
}