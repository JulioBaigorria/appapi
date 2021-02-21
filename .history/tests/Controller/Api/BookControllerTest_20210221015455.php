<?php

namespace App\Tests\Controller\Api;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PostControllerTest extends WebTestCase
{
   
    public function testSuccess()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/books',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"title":"Pañuelofuego"}'
        );
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
   
  /*  public function testCreateBookInvalidData()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/books',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"title":""}'
        );
        
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }  
    

    public function testCreateBookEmptyData()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/books',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            ''
        );
        
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
    
    */
}