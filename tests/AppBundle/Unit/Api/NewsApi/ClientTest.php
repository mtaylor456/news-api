<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use AppBundle\Api\NewsApi\Client;
use GuzzleHttp\Client as ClientMock;
use Tests\AppBundle\Fixtures\NewsApi;

class ClientTest extends TestCase
{
    public function testReturnsValidArray()
    {
        $clientMock = $this->createMock(ClientMock::class);
        
        $fixture = (new NewsApi())->getHeadlinesStatusOk();
        
        $clientMock->method('request')
                    ->willReturn($fixture);
        
        $client = new Client($clientMock, '', '');

        $result = $client->request('endpoint', []);

        $this->assertArrayHasKey($result, 'articles');
    }
    
    public function testThrowsExceptionOnCorruptResponse()
    {
        $clientMock = $this->createMock(ClientMock::class);
        
        $clientMock->method('request')
                    ->willReturn('');
        
        $client = new Client($clientMock, '', '');

        $result = $client->request('endpoint', []);
        
        $this->expectException(InvalidArgumentException::class);  
    }
    
    public function testThrowsExceptionOnError()
    {
        $clientMock = $this->createMock(ClientMock::class);
        
        $fixture = (new NewsApi())->getStatusError();
        
        $clientMock->method('request')
                    ->willReturn("{'status':'error'}");
        
        $result = $client->request('endpoint', []);            
                
        $client = new Client($clientMock, '', '');

        $this->expectException(InvalidArgumentException::class); 
    }
}