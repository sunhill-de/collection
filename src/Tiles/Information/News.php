<?php

namespace Sunhill\Collection\Tiles\Information;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class News extends SunhillBladeResponse
{
    
    protected $template = 'collection::information.news';
    
    protected function newNewsEntry($id, $headline, $symbol) 
    {
        $result = new \StdClass();
        
        $result->id = $id;
        $result->headline = $headline;
        $result->symbol = $symbol;
        
        return $result;
    }
    
    protected function getNewsEntries()
    {
        $result = [];
        
/*        $news_count = InfoMarket::getItem('news.headlines.count','anybody','stdclass');
        if (empty($news_count) || ($news_count->result !== 'OK')) {
            return [];
        }
        $max_entries = env('MAX_NEWS_ENTRIES', 50);
        $count = ($news_count->value > $max_entries)?$max_entries:$news_count->value;
        
        for ($i=1;$i<=$count;$i++) {
            $news_id = InfoMarket::getItem('news.headlines.'.$i.'.id','anybody','stdclass');
            $news_headline = InfoMarket::getItem('news.headlines.'.$i.'.title','anybody','stdclass');
            $news_symbol = InfoMarket::getItem('news.headlines.'.$i.'.icon','anybody','stdclass');
            $result[] = $this->newNewsEntry($news_id->value,$news_headline->value, $this->icon = $news_symbol->value);
        }*/
        
        return $result;
    }
    
    protected function prepareResponse()
    {
        $this->params['linktarget'] = "window.location = '/Information/News';";
        $this->params['newsentries'] = $this->getNewsEntries();
    }
    
}