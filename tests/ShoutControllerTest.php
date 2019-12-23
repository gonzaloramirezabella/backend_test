<?php 

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShoutControllerTest extends WebTestCase{    

    public function testShoutWithAuthorAndLimit(){
        $client = static::createClient();
        $client->request('GET', '/shout/steve-jobs?limit=2');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }   
    
    public function testShoutWithNoLimit(){
        $client = static::createClient();
        $client->request('GET', '/shout/steve-jobs');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
          
    public function testShoutWithAuthorAndLimitMoreThanTen(){
        $client = static::createClient();
        $client->request('GET', '/shout/steve-jobs?limit=11');
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}