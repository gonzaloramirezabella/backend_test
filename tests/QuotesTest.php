<?php 

namespace App\Tests;

use App\Repository\QuotesJsonRepository;
use PHPUnit\Framework\TestCase;

class QuotesTest extends TestCase{
    public function testJsonQuoutes(){
        $quotes_json = new QuotesJsonRepository();
        $quoutes = $quotes_json->get('steve-jobs',2);
        $this->assertEquals(2, count($quoutes), "Count is 2");        

        $quoutes = $quotes_json->get('steve-jobs',3);
        $this->assertEquals(2, count($quoutes), "Count is 2, because there is no more quotes of Steve");        

        $quoutes = $quotes_json->get('',10);
        $this->assertEquals(0, count($quoutes), "Count has to be 0, because no author");        
    }
}