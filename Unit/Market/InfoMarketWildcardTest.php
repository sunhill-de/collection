<?php

namespace Sunhill\InfoMarket\Tests\Unit\Market;

use Sunhill\InfoMarket\Test\InfoMarketTestCase;
use Sunhill\InfoMarket\Marketeers\MarketeerBase;
use Sunhill\InfoMarket\Market\InfoMarket;
use Sunhill\InfoMarket\Market\MarketException;
use Sunhill\InfoMarket\Test\Marketeers\FakeMarketeer;
use Sunhill\InfoMarket\Test\Marketeers\FakeMarketeer2;
use Sunhill\InfoMarket\Marketeers\Response\Response;

class InfoMarketWildcardTest extends InfoMarketTestCase
{
   
    /**
     * @dataProvider ContainsWildcardProvider
     */
    public function testContainsWildcard($test_item, $expect)
    {
        $test = new InfoMarket();
        $this->assertEquals($expect, $this->invokeMethod($test,'containsWildcard', [$test_item]));
    }   
    
    public function ContainsWildcardProvider()
    {
        return [
            ['test.string', false],
            ['test.*.string', true],
            ['test*.string', true],
            ['test.#.string', true],
            ['test.?.string', true],
        ];
    }  
    
    /**
     * @dataProvider WildcardAtomProvider
     * @param unknown $atom
     * @param unknown $test
     * @param unknown $expect
     * @throws \Exception
     */
    public function testWildcardAtomMatches($atom, $test_str, $expect)
    {
        $test = new InfoMarket();
        try {
            $matches = $this->invokeMethod($test, 'wildcardAtomMatches', [$atom, $test_str]);
            $this->assertEquals($expect, $matches);
        } catch (\Exception $e) {
            if ($expect == 'except') {
                $this->assertTrue(true);
                return;
            }
            throw $e;
        }
    }
    
    public function WildcardAtomProvider()
    {
        return [
            ['*','abcdef',true],
            ['?','abcdef',true],
            ['#','abcdef',false],
            ['*','1',true],
            ['*def','abcdef',true],
            ['*xyz','abcdef',false],
            ['*de','abcdef',false],
            ['abc*','abcdef',true],
            ['xyz*','abcdef',false],
            ['ab*ef','abcdef',true],
            ['ab*xy','abcdef',false],
            ['ab*d*f','abcdef','except'],
        ];
    }

    /**
     * @dataProvider WildcardProvider
     * @param unknown $atom
     * @param unknown $test
     * @param unknown $expect
     * @throws \Exception
     */
    public function testWildcardMatches($atom, $test_str, $expect)
    {
        $test = new InfoMarket();
        try {
            $matches = $this->invokeMethod($test, 'wildcardMatches', [$atom, $test_str]);
            $this->assertEquals($expect, $matches);
        } catch (\Exception $e) {
            if ($expect == 'except') {
                $this->assertTrue(true);
                return;
            }
            throw $e;
        }
    }
    
    public function WildcardProvider()
    {
        return [
            ['ab.cd.de','ab.cd.de',true],
            ['ab.*.de','ab.cd.de',true],
            ['ab.*','ab.cd.de',true],
            ['ab.cd.*','ab.cd',false],
        ];
    }
    
}
