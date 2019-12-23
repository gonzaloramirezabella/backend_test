<?php

namespace App\Tests;

use App\Service\ShoutService;
use PHPUnit\Framework\TestCase;

class ShoutTest extends TestCase{
    public function testShout(){
        $this->assertEquals(ShoutService::shouted("hola"), 'HOLA!', "hola == HOLA!");
        $this->assertEquals(ShoutService::shouted("hola!"), 'HOLA!', "hola! == HOLA!");
        $this->assertEquals(ShoutService::shouted("hola     "), 'HOLA!', "'hola   ' == HOLA!");
        $this->assertEquals(ShoutService::shouted(""), '', "'' == ''");        
        $this->assertEquals(ShoutService::shouted("hola."), 'HOLA!', "hola. == HOLA!");
    }
}