<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

trait CollectionProvider
{
    public static function CollectionProvider()
    {
        return [
            [
                'Anniversary',
                [
                    "Homer Simpson",
                    "Homer's birthday"
                ],
                [
                    'name',
                    'first',
                    'type',
                    'birthday',
                    'weddingday',
                    'persons'                    
                ]                
            ],
            [
                'Event',
                [
                    "Homer Simpson"                   
                ]                
            ],
            ['EventType',['watch']],
            ['Genre',['fiction']],
            ['Language',['en'],['name','iso']],
            ['MusicalArtist',['Muse']],
            ['Network',['home']],
            ['PersonsRelation',['Marge Simpson']],
            ['ProductGroup',['food']],
            ['Staff',['Edward Norton']],
            ['StaffJob',['actor']],
            ['Transaction']
        ];
    }
    
    
}