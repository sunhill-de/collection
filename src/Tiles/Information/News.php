<?php

namespace Sunhill\Collection\Tiles\Information;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class News extends SunhillBladeResponse
{
    
    protected $template = 'collection::information.news';
    
    protected function newNewsEntry($id, $headline) 
    {
        $result = new \StdClass();
        
        $result->id = $id;
        $result->headline = $headline;
        
        return $result;
    }
    
    protected function getNewsEntries()
    {
        $result = [];
        
        $news_count = InfoMarket::getItem('news.headlines.count','anybody','stdclass')->value;
        for ($i=1;$i<=10;$i++) {
            $news_id = InfoMarket::getItem('news.headlines.'.$i.'.id','anybody','stdclass');
            $news_headline = InfoMarket::getItem('news.headlines.'.$i.'.title','anybody','stdclass');
            $result[] = $this->newNewsEntry($news_id->value,$news_headline->value);
        }
        
        return $result;
    }
    
    protected function prepareResponse()
    {
        $this->params['linktarget'] = "window.location = '/Information/News';";
        $this->params['newsentries'] = $this->getNewsEntries();
    }
    
}