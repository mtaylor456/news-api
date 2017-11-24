<?php

namespace AppBundle\Api\NewsApi;


class News
{
    public function __construct($client, $endpoints)
    {
        $this->client = $client;
        $this->endpoints = $endpoints;
    }
    
    /**
     * @param string $source
     * @return array
     */
    public function headlines($source)
    {
        $params = ['sources'=>$source];
        $endpoint = $this->endpoints['headlines'];
        
        $result = $this->client->request($endpoint, $params);
       
        return $result['articles'];
    }
    
    /**
     * @param string $source
     * @return array
     */
    public function everything($source)
    {
        $params = ['sources'=>$source];
        $endpoint = $this->endpoints['everything'];
        
        $result = $this->client->request($endpoint, $params);
       
        return $result['articles'];
    }
    
    /**
     * @param string $language
     * @return array
     */
    public function sources($language)
    {
        $params = ['language'=>$language];
        $endpoint = $this->endpoints['sources'];
        
        $result = $this->client->request($endpoint, $params);
        
        return $result['sources'];
    }
}

