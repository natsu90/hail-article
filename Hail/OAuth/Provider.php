<?php

namespace Hail\OAuth;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

class Provider extends AbstractProvider 
{
    public $domain = 'https://hail.to';

    public $apiPrefix = '/api/v1';

    public function getBaseAuthorizationUrl(): string
    {
        return $this->domain . '/oauth/authorise';
    }

    public function getBaseAccessTokenUrl(array $params): string
    {
        return $this->domain . $this->apiPrefix . '/oauth/access_token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token): string
    {
        return $this->domain . $this->apiPrefix . '/me';
    }

    protected function getDefaultScopes(): array
    {
        return ['user.basic', 'content.read'];
    }

    protected function getScopeSeparator(): string
    {
        return ' ';
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if ($response->getStatusCode() >= 400) {
            throw new IdentityProviderException($data['error']['message'], $response->getStatusCode(), $response);
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new ResouceOwner($response);
    }
}