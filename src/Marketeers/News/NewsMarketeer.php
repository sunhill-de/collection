<?php

namespace Sunhill\Collection\Marketeers\News;

use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\Collection\Marketeers\DataSource\WebDataSource;

class NewsMarketeer extends OnDemandMarketeer
{
    
    protected function initializeMarketeer()
    {
        $this->addEntry('headlines', new NewsHeadlinesMarketeer());
        $this->addEntry('articles', new NewsArticlesMarketeer());
    }
    
    
}
