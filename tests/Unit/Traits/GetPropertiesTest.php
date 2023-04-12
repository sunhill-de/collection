<?php

use Sunhill\Collection\Traits\GetProperties;
use Sunhill\Collection\Tests\DatabaseTestCase;
use Sunhill\Collection\Objects\Person;

class DummyGetPropertiesTest 
{
    use GetProperties;    
}

/**
 * GetProperties test case.
 */
class GetPropertiesTest extends DatabaseTestCase
{
    
    /**
     * @dataProvider ForIntProvider
     */
    public function testForInt($test, $expect)
    {
        $dummy = new DummyGetPropertiesTest();
        
        if ($test == 'object') {
            $test = new Person();
        }
        $this->assertEquals($expect, $this->callProtectedMethod($dummy, 'testForInt', [$test]));
    }
    
    public function ForIntProvider()
    {
        return [
            [1,Person::class],
            [Person::class,false],
            ['Person',false],
            ['object',false]
        ];
    }
    
    /**
     * @dataProvider ForStringProvider
     */
    public function testForString($test, $expect)
    {
        $dummy = new DummyGetPropertiesTest();
        
        if ($test == 'object') {
            $test = new Person();
        }
        $this->assertEquals($expect, $this->callProtectedMethod($dummy, 'testForString', [$test]));
    }
    
    public function ForStringProvider()
    {
        return [
            [1,false],
            [Person::class,Person::class],
            ['Person',Person::class],
            ['object',false]
        ];
    }
    
    /**
     * @dataProvider ForObjectProvider
     */
    public function testForObject($test, $expect)
    {
        $dummy = new DummyGetPropertiesTest();
        
        if ($test == 'object') {
            $test = new Person();
        }
        $this->assertEquals($expect, $this->callProtectedMethod($dummy, 'testForObject', [$test]));
    }
    
    public function ForObjectProvider()
    {
        return [
            [1,false],
            [Person::class,false],
            ['Person',false],
            ['object',Person::class]
        ];
    }
    
    
    /**
     * @dataProvider GetNamespaceProvider
     */
    public function testGetNamespace($test, $expect)
    {
        $dummy = new DummyGetPropertiesTest();
        
        if ($test == 'object') {
            $test = new Person();
        }
        $this->assertEquals($expect, $this->callProtectedMethod($dummy, 'getNamespace', [$test]));
    }
    
    public function GetNamespaceProvider()
    {
        return [
            [1,Person::class],
            [Person::class,Person::class],
            ['Person',Person::class],
            ['object',Person::class]
        ];
    }
}

