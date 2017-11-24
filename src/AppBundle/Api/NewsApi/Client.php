<?php

namespace AppBundle\Api\NewsApi;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    public function __construct(GuzzleClient $client, $apiKey, $baseUrl)
    {
        $this->client = $client; 
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }
    
     /**
     * NewsApi API requests
     * 
     * @param string $endpoint
     * @param array $params
     * @return array
     */
    public function request($endpoint, array $params = [])
    {
        $params = array_merge(['apikey'=>$this->apiKey], $params);
        $params = [
            'base_uri'=>$this->baseUrl,
            'query'=>$params
        ];
        
        $response = $this->client->request('GET', $endpoint, $params);
        $contents = $response->getBody()->getContents();
        
        $arrayContents = json_decode($contents, true);
        
        if(!isset($arrayContents["status"])||$arrayContents["status"]!=="ok"){
            throw new \RuntimeException('NewsAPI error');
        }
        
        return json_decode($contents, true);
    }
}