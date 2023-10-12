<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

class FeatureCollectionsTest extends HtmlTestBase
{
    
    public static function HTMLProvider()
    {
        return [
            ['/Database/Collections/List',200,'get','Anniversary'],          // Default list classes
            ['/Database/Collections/Show/Anniversary',200],   // Show class with existing name
            ['/Database/Collections/ListCollection/Anniversary',200],
            ['/Database/Collections/ListCollection/Event',200],
            ['/Database/Collections/ListCollection/EventType',200],
            ['/Database/Collections/ListCollection/Genre',200],
            ['/Database/Collections/ListCollection/Language',200],
            ['/Database/Collections/ListCollection/MusicalArtist',200],
            ['/Database/Collections/ListCollection/Network',200],
            ['/Database/Collections/ListCollection/PersonsRelation',200],
            ['/Database/Collections/ListCollection/ProductGroup',200],
            ['/Database/Collections/ListCollection/Staff',200],
            ['/Database/Collections/ListCollection/StaffJob',200],
            
            ['/Database/Collections/Add/Anniversary',200],
            ['/Database/Collections/Add/Event',200],
            ['/Database/Collections/Add/EventType',200],
            ['/Database/Collections/Add/Genre',200],
            ['/Database/Collections/Add/Language',200],
            ['/Database/Collections/Add/MusicalArtist',200],
            ['/Database/Collections/Add/Network',200],
            ['/Database/Collections/Add/PersonsRelation',200],
            ['/Database/Collections/Add/ProductGroup',200],
            ['/Database/Collections/Add/Staff',200],
            ['/Database/Collections/Add/StaffJob',200],
            
            ['/Database/Collections/Add/Language',200],
            
            
            ['/Database/Collections/Show/NonExistingClass',500],  // Show non existing class
            ['/Database/Collections/List/1000',500],              // List classes with non existing page
            ['/Database/Collections/ListCollection/StaffJob',200],
            ['/Database/Collections/ListCollection/MusicalArtist/0',200],
            ['/Database/Collections/ListCollection/MusicalArtist/0/id',200],
            ['/Database/Collections/ListCollection/MusicalArtist/1/id',200],
            ['/Database/Collections/ListCollection/StaffJob/1000',500],
        ];    
    }
    
}