<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxSearchResponse;
use Illuminate\Support\Facades\DB;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Facades\InfoMarket;

class AjaxInfomarket extends AjaxSearchResponse
{
    
    protected function assembleSearchResult(string $search)
    {
        return InfoMarket::getItem($search);
    }
    
}