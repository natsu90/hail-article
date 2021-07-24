<?php

namespace Hail\Api;

use GuzzleHttp\Client as HttpClient;

abstract class AbstractApi
{
    protected $domain = 'https://hail.to';
    protected $apiPrefix = '/api/v1';
    protected $headers = [
        'Accept' => 'application/json'
    ];
    protected $client;

    public function __construct($accessToken)
    {
        $this->client = new HttpClient([
            'base_uri' => $this->domain
        ]);

        $this->headers['Authorization'] = 'Bearer '.$accessToken;
    }

    public function makeRequest($method, $urlPath)
    {
        $response = $this->client->request($method, $this->apiPrefix . $urlPath, [
            'headers' => $this->headers
        ]);

        return json_decode($response->getBody());
    }
}