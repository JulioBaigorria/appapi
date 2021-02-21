<?php

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{

    const $client = static::createClient();
    
    public function testCreateBookInvalidData()
    {
        

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

    public function testSuccess()
    {
        

        $client->request(
            'POST',
            '/api/books',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"title":"El imperio final"}'
        );
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}