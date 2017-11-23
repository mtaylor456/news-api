<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use AppBundle\Api\NewsApi\News;
use AppBundle\Api\NewsApi\Client;
use Tests\AppBundle\Fixtures\NewsApi;

class NewsClientTest extends TestCase
{
    public function setUp()
    {
        $clientMock = $this->createMock(Client::class);
    }
    
    public function tearDown()
    {
        $clientMock = null;
    }
    
    public function testHeadlinesReturnsValidArray()
    {
        $fixture = (new NewsApi())->getNewsStatusOk();
        
        $clientMock->method('request')
                    ->willReturn(json_decode($fixture, 1));
        
        $client = new News($clientMock, ['headlines'=>'']);

        $result = $client->request('endpoint', []);

        $this->assertArrayHasKey($result, 'id');
    }
    
    public function testEverythingReturnsValidArray()
    {
        $fixture = (new NewsApi())->getNewsStatusOk();
        
        $clientMock->method('request')
                    ->willReturn(json_decode($fixture, 1));
        
        $client = new News($clientMock, ['headlines'=>'']);

        $result = $client->request('endpoint', []);

        $this->assertArrayHasKey($result, 'id');
    }
    
    public function testSourcesReturnsValidArray()
    {
        $fixture = (new NewsApi())->getHeadlinesStatusOk();
        
        $clientMock->method('request')
                    ->willReturn(json_decode($fixture, 1));
        
        $client = new News($clientMock, ['headlines'=>'']);

        $result = $client->request('endpoint', []);

        $this->assertArrayHasKey($result, 'id');
    }
}