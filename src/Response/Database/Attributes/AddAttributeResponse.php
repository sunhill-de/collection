<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\Visual\Response\Dialog\SunhillDialogResponse;
use Sunhill\Visual\Response\Dialog\DialogDescriptor;

class AddAttributeResponse extends SunhillDialogResponse
{

    protected $route = 'attributes.execadd';
    
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
    
}  
