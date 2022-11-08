<?php

namespace Sunhill\InfoMarket\Marketeers\Internal;

use Sunhill\InfoMarket\Response\Semantics\Semantic;

class InfoMarketSemanticsItem extends InfoMarketArrayBase
{
  
    function getBaseDir()
    {
      return dirname(__FILE__).'/../../Response/Semantics';
    }  
  
    function classFits(string $test)
    {
      return is_a($test, Semantic::class, true);
    }  

}
