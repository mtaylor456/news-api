<?php

namespace Tests\AppBundle\Unit\Api\NewApi;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use AppBundle\Api\NewsApi\News;
use AppBundle\Api\NewsApi\Client;
use Tests\AppBundle\Fixtures\NewsApi;

class NewsClientTest extends TestCase
{
    public function setUp()
    {
        $this->clientMock = $this->createMock(Client::class);
    }
    
    public function tearDown()
    {
        $this->clientMock = null;
    }
    
    public function testHeadlinesReturnsValidArray()
    {
        $fixture = (new NewsApi())->getNewsStatusOk();
        
        $this->clientMock->method('request')
                    ->willReturn(json_decode($fixture, 1));
        
        $client = new News($this->clientMock, ['headlines'=>'']);

        $result = $client->headlines('endpoint', []);

        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('author', $result[0]);
    }
    
    public function testEverythingReturnsValidArray()
    {
        $fixture = (new NewsApi())->getNewsStatusOk();
        
        $this->clientMock->method('request')
                    ->willReturn(json_decode($fixture, 1));
        
        $client = new News($this->clientMock, ['everything'=>'']);

        $result = $client->everything('endpoint', []);
        
        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('author', $result[0]);
    }
    
    public function testSourcesReturnsValidArray()
    {
        $fixture = (new NewsApi())->getSourcesStatusOk();
        
        $this->clientMock->method('request')
                    ->willReturn(json_decode($fixture, 1));
        
        $client = new News($this->clientMock, ['sources'=>'']);

        $result = $client->sources('endpoint', []);
        
        $this->assertTrue(is_array($result));
        $this->assertArrayHasKey('id', $result[0]);
    }
}