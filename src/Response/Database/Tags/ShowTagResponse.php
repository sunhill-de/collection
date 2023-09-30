<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Objects\Tag;
use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Facades\Objects;

class ShowTagResponse extends SunhillBladeResponse
{

    protected $template = 'collection::tags.show';
        
    protected $id;
    
    public function setID(int $id)
    {
        $this->id = $id;
    }
    
    protected function getChildTagCount()
    {
        return Tags::query()->where('parent', '=', $this->params['fullpath'])->count();    
    }
    
    protected function getChildTags(int $short)
    {
        return Tags::query()->where('parent', '=', $this->params['fullpath'])->orderBy('id')->limit($short)->get();
    }
    
    protected function getChildObjectCount()
    {
        return ORMObject::search()->where('tags','has',$this->params['fullpath'])->count();
    }
    
    protected function getChildObjects(int $short)
    {
        $return = [];
        $result = ORMObject::search()->where('tags','has',$this->params['fullpath'])->limit($short)->get();
        foreach ($result as $entry) {
            $item = new \StdClass();
            $item->id = $entry->id;
            $object = Objects::load($entry->id);
            $item->class = Objects::getClassnameOf($entry->id);
            $item->class_name = Objects::getClassnameOf($entry->id);
            $item->keyfield = '';
            $return[] = $item;
        }
        return $return;    
    }
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $tag = Tags::loadTag($this->id);
        $short = config('collection.entries_per_short_table',5);
        $this->params['id'] = $this->id;
        $this->params['name'] = $tag->name;
        $this->params['parent'] = ($tag->parent)?$tag->parent->name:'';
        $this->params['fullpath'] = $tag->getFullpath();
        $this->params['leafable'] = ($tag->options & Tag::TO_LEAFABLE)?__('yes'):__('no');
        $this->params['childtagcount'] = $this->getChildTagCount(); 
        $this->params['tags'] = $this->getChildTags($short);
        $this->params['objectcount'] = $this->getChildObjectCount();
        $this->params['objects'] = $this->getChildObjects($short);
    }
    
}  
