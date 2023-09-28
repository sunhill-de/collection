<?php

/**
 * @file SunhillListResponse
 * Basic class that return blade templates
 *
 */
namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\Visual\Response\Dialog\SunhillDialogResponse;
use Sunhill\Visual\Response\Dialog\DialogDescriptor;
use Sunhill\ORM\Facades\Tags;
use Sunhill\Collection\Exceptions\InvalidIDException;

class TagDialogResponse extends SunhillDialogResponse
{
    
    protected $id;
    
    protected $route_base = 'tags';
    
    public function setID(int $id)
    {
        $this->id = $id;
        $this->route_parameters['id'] = $this->id;
        if (!Tags::query()->where('id',$id)->count()) {
            throw new InvalidIDException("The id '$id' is invalid.");
        }
        return $this;
    }
    
    protected function defineDialog(DialogDescriptor $descriptor)
    {
        $descriptor->string()->label('Name')->name('name')->required();
        $descriptor->checkbox()->label('Leafable')->name('leafable');
        $descriptor->inputLookup()->label('Parent')->name('parent')->lookup('tags');
    }
    
    protected function execAdd($parameters)
    {
         Tags::query()->insert(['name'=>$parameters['name'],'parent_id'=>$parameters['parent']]);
         $this->redirect('tags.list');
    }
    
    protected function getEditValues()
    {
        $tag = Tags::query()->where('id',$this->id)->first();
        if (!empty($tag->fullpath)) {
            $parts = explode('.',$tag->fullpath);
            array_pop($parts);
            $parent = implode('.',$parts);
        } else {
            $parent = '';
        }
        return [
            'name'=>$tag->name,
            'value_parent'=>$tag->parent_id,
            'input_parent'=>$parent
        
        ];
    }
    
    protected function execEdit($parameters)
    {
        Tags::query()->where('id',$this->id)->update(['name'=>$parameters['name'],'parent_id'=>$parameters['parent']]);
        $this->redirect('tags.list');        
    }
    
}
    