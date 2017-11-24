<?php

namespace Tests\AppBundle\Unit\Api\NewApi;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use AppBundle\Api\NewsApi\Client;
use Tests\AppBundle\Fixtures\NewsApi;

use GuzzleHttp\Client as ClientMock;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7;

use GuzzleHttp\Exception\RequestException;

class ClientTest extends TestCase
{
    
    public function testReturnsValidResponse()
    {
        $fixture = (new NewsApi())->getNewsStatusOk();
        
        $stream = Psr7\stream_for($fixture);
        $response = new Response(200, ['Content-Type' => 'application/json'], $stream);
        
        $mock = new MockHandler([
           $response
        ]);
        
        $handler = HandlerStack::create($mock);
        
        $clientMock = new ClientMock(['handler' => $handler]);
        
        $client = new Client($clientMock, '', '');
        
        $result = $client->request('endpoint', []);

        $this->assertArrayHasKey('articles', $result);
    }
    
    public function testThrowsExceptionOnCorruptResponse()
    {
        $this->expectException(\RuntimeException::class);  
        
        $stream = Psr7\stream_for('');
        $response = new Response(200, ['Content-Type' => 'application/json'], $stream);
        
        $mock = new MockHandler([
           $response
        ]);
        
        $handler = HandlerStack::create($mock);
        
        $clientMock = new ClientMock(['handler' => $handler]);
        
        $client = new Client($clientMock, '', '');
        
        $result = $client->request('endpoint', []);
    }
    
    public function testThrowsExceptionOnError()
    {
         $this->expectException(\RuntimeException::class);
        
        $fixture = (new NewsApi())->getStatusError();
        
        $stream = Psr7\stream_for($fixture);
        $response = new Response(200, ['Content-Type' => 'application/json'], $stream);
        
        $mock = new MockHandler([
           $response
        ]);
        
        $handler = HandlerStack::create($mock);
        
        $clientMock = new ClientMock(['handler' => $handler]);
        
        $client = new Client($clientMock, '', '');
        
        $result = $client->request('endpoint', []);
    }
}