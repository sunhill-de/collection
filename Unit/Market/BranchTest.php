<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Branch;

class BranchTest extends SunhillNoAppTestCase
{
    
    public function testAddBranch()
    {
        $test = new Branch();
        $element = new Branch();
        $element->setName('test');
        
        $this->assertFalse($test->hasSubbranch('test'));
        $test->addSubbranch($element);
        $this->assertTrue($test->hasSubbranch('test'));
        $this->assertEquals('test',$test->getSubbranch('test')->getName());
    }
    
    public function testMergeBranch()
    {
        $test = new Branch();
        
        $element1 = new Branch();
        $element1->setName('test');
        $subelement1 = new Branch();
        $subelement1->setName('subtest1');
        $element1->addSubbranch($subelement1);
        
        $element2 = new Branch();
        $element2->setName('test');
        $subelement2 = new Branch();
        $subelement2->setName('subtest2');
        $element2->addSubbranch($subelement2);
        
        $test->addSubbranch($element1);
        $test->addSubbranch($element2);
        
        $this->assertTrue($test->hasSubbranch('test'));
        $subbranch = $test->getSubbranch('test');
        $this->assertTrue($subbranch->hasSubbranch('subtest1'));
        $this->assertTrue($subbranch->hasSubbranch('subtest2'));
    }
}