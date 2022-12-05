<?php

namespace Sunhill\InfoMarket\Marketeers\Internal;

use Sunhill\InfoMarket\Response\Types\Type;

class InfoMarketTypesItem extends InfoMarketArrayBase
{
  
    function getBaseDir()
    {
      return dirname(__FILE__).'/../../Response/Types';
    }  
  
    function classFits(string $test)
    {
      return is_a($test, Type::class, true) && ($test !== Type::class);
    }  

}
