<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Market;
use Sunhill\InfoMarket\Market\Marketeer;
use Sunhill\InfoMarket\Market\Item;
use Sunhill\InfoMarket\Response\Response;

class FeatureMarketeer1Item1 extends Item
{
    
    protected function doGetItemValue(Response &$response, array $remains = [])
    {
        return 'TeSt';   
    }    
    
}

class FeatureMarketeer1 extends Marketeer
{
    
    protected function getOffering(): array
    {
        return [
            'simple.test.item'=>FeatureMarketeer1Item1::class
        ];    
    }
    
}

class FeatureMarketeer2Item1 extends Item
{

    protected function doGetItemValue(Response &$response, array $remains = [])
    {
        return 'tEsT';
    }
    
}

class FeatureMarketeer2 extends Marketeer
{
    
    protected function getOffering(): array
    {
        return [
            'simple.test.entry'=>FeatureMarketeer2Item1::class            
        ];        
    }
    
}

class FeatureMarketeer3Item1 extends Item
{
    
    protected function doGetItemValue(Response &$response, array $remains = [])
    {
        return 'TesT';
    }
    
}

class FeatureMarketeer3 extends Marketeer
{
    
    protected function getOffering(): array
    {
        return [
            'simple.test.entry2'=>FeatureMarketeer3Item1::class
        ];        
    }
    
}

// ******************************** Test starts here *********************************************
class MarketBase extends SunhillNoAppTestCase
{
    
    protected function getMarket()
    {
        $market = new Market();
        $market->installMarketeer(FeatureMarketeer1::class);
        $market->installMarketeer(FeatureMarketeer2::class);
        $market->installMarketeer(FeatureMarketeer3::class);
        return $market;
    }
}