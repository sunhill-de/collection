<?php

namespace Sunhill\Collection\Marketeers\News;

use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\Collection\Marketeers\DataSource\WebDataSource;

class NewsArticlesMarketeer extends OnDemandMarketeer
{
    
    protected function initializeMarketeer()
    {
        $source = new WebDataSource();
        
        $date = new \DateTime();
//        $source->setUrl('192.168.3.3:8888/items?updatedsince='.$date->sub(\DateInterval::createFromDateString('12 hours'))->format('Y-m-d H:i:s'));
        $source->setUrl('192.168.3.3:8888/items?items=20');
        $data = json_decode($source->getData());

        $this->addEntry('count', (new DynamicItem())->defineValue(count($data))->type('int')->semantic('Count'));

        foreach ($data as $news_entry) {
            $this->addEntry($news_entry->id, new NewsHeadline($news_entry));
        }
    }
    
    
}
