<?php

namespace Sunhill\Collection\Response\Information\News;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class ShowNewsResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::news.show';
 
    protected $id;
    
    public function setID($id)
    {
        $this->id = $id;    
    }
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $article = InfoMarket::getItem('news.articles.'.$this->id,'anybody','stdclass');
       if ($article->result !== 'OK') {
           return;
       }
       $this->params['id'] = 
       $this->params['id']       = $this->id;
       $this->params['stamp']    = $article = InfoMarket::getItem('news.articles.'.$this->id.'.stamp','anybody','stdclass')->value;
       $this->params['title']    = $article = InfoMarket::getItem('news.articles.'.$this->id.'.title','anybody','stdclass')->value;
       $this->params['content']  = $article = InfoMarket::getItem('news.articles.'.$this->id.'.content','anybody','stdclass')->value;
       $this->params['unread']   = $article = InfoMarket::getItem('news.articles.'.$this->id.'.unread','anybody','stdclass')->value;
       $this->params['link']     = $article = InfoMarket::getItem('news.articles.'.$this->id.'.link','anybody','stdclass')->value;
       $this->params['author']   = $article = InfoMarket::getItem('news.articles.'.$this->id.'.author','anybody','stdclass')->value;
       $this->params['icon']     = $article = InfoMarket::getItem('news.articles.'.$this->id.'.icon','anybody','stdclass')->value;

     }
}