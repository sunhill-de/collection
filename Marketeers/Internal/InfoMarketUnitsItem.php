<?php

namespace Sunhill\InfoMarket\Marketeers\Internal;

use Sunhill\InfoMarket\Response\Units\Unit;

class InfoMarketUnitsItem extends InfoMarketArrayBase
{
  
    function getBaseDir()
    {
      return dirname(__FILE__).'/../../Response/Units';
    }  
  
    function classFits(string $test)
    {
      return is_a($test, Unit::class, true);
    }  

}
