<?php

namespace Sunhill\InfoMarket\Marketeers\Internal;

use Sunhill\InfoMarket\Response\Units\Unit;

class InfoMarketUnitItem extends InfoMarketArrayBase
{
  
    function getBaseDir()
    {
      return dirname(__FILE__).'/../../Response/Unit';
    }  
  
    function classFits(string $test)
    {
      return is_a($test, Unit::class, true);
    }  

}
