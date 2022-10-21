<?php

namespace Sunhill\InfoMarket\Items;

use Sunhill\InfoMarket\Marketeers\MarketeerBase;
use Sunhill\InfoMarket\Marketeers\Response\Response;

abstract class ArrayItemBase extends ItemBase
{

    abstract protected function getArrayCount();
    abstract protected function getArrayItemByIndex(int $index);
    
}