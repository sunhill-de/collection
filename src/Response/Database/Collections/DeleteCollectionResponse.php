<?php

namespace Sunhill\Collection\Response\Database\Collections;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Objects;
use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\Visual\Response\SunhillUserException;
use Sunhill\Collection\Utils\HasID;
use Sunhill\ORM\Facades\Collections;

class DeleteCollectionResponse extends SunhillRedirectResponse
{
    
    use HasID;
    
    protected $target = '/';

    protected $colllection;
    
    public function setCollection(string $collection)
    {
        $this->collection = $collection;
        return $this;
    }
    
    protected function prepareResponse()
    {
        $collection = Collections::searchCollection($this->collection);
        if (!$collection::IDExists($this->id)) {
            throw new SunhillUserException(__("The collection of type ':type' with the id ':id' does not exist.",['type'=>$this->collection,'id'=>$this->id]));
        }
        $collection::delete($this->id);
        $this->setTarget(route('collection.list',['collection'=>$this->collection]));        
    }
    
}  
    
