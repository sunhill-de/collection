<?php

/**
 * @file SunhillListResponse
 * Basic class that return blade templates
 *
 */
namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\Visual\Response\Dialog\SunhillDialogResponse;
use Sunhill\Visual\Response\Dialog\DialogDescriptor;
use Sunhill\ORM\Facades\Tags;
use Sunhill\Collection\Exceptions\InvalidIDException;
use Sunhill\ORM\Facades\Attributes;

class AttributeDialogResponse extends SunhillDialogResponse
{
    
    protected $id;
    
    protected $route_base = 'attributes';
    
    public function setID(int $id)
    {
        $this->id = $id;
        $this->route_parameters['id'] = $this->id;
        if (!Attributes::query()->where('id',$id)->count()) {
            throw new InvalidIDException("The id '$id' is invalid.");
        }
        return $this;
    }
    
    protected function defineDialog(DialogDescriptor $descriptor)
    {
        $descriptor->string()->label('Name of the attribute')->name('name')->required()->class('input is-small');
        $descriptor->select()->label('Type of the attribute')->name('type')->entries([
            'Integer'=>'integer',
            'Char'=>'string',
            'Float'=>'float',
            'Text'=>'text'
        ])->class('input is-small');
        $descriptor->list()->label('Allowed classed')->name('allowed_classes')->element('string')->lookup('classes');
    }
    
    protected function execAdd($parameters)
    {
        Attributes::query()->insert(['name'=>$parameters['name'],'type'=>$parameters['type'],'allowed_classes'=>$parameters['allowed_classes']]);
        $this->redirect('attributes.list');
    }
    
    protected function getEditValues()
    {
        $attribute = Attributes::query()->where('id',$this->id)->first();
        $classes = array_slice(explode('|',$attribute->allowed_classes),1,-1);
        return [
            'name'=>$attribute->name,
            'type'=>$attribute->type,
            'name_allowed_classes'=>$classes,
            'allowed_classes'=>$classes           
        ];
    }
    
    protected function execEdit($parameters)
    {
        Attributes::query()->where('id',$this->id)->update(['name'=>$parameters['name'],'type'=>$parameters['type'],'allowed_classes'=>$parameters['allowed_classes']]);
        $this->redirect('attributes.list');
    }
    
}
