<?php

namespace Sunhill\Collection\Response\Database\Collections;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\Collection\Facades\SunhillManager;
use Sunhill\Collection\Utils\HasID;

class ShowSingleCollectionResponse extends SunhillBladeResponse
{

    use HasID;
    
    protected $template = 'collection::collection.show';
    
    protected $collection;

    protected function prepareResponse()
    {
        parent::prepareResponse();
        $infos = SunhillManager::getCollectionsInformations($this->collection);
        $this->params = array_merge($this->params, $infos);
    }
    
    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }
    
}  
