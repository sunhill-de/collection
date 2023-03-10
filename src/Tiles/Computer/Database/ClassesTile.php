<?php

namespace Sunhill\Collection\Tiles\Computer\Database;

use Sunhill\Visual\Tiles\SunhillTileBase;
use Sunhill\ORM\Facades\Classes;

class ClassesTile extends SunhillTileBase
{
    
    protected $tile_template = 'collection::tiles.database.classes';
    
    protected function getParams()
    {
        return [
            'number_of_classes' => Classes::getClassCount()
        ];
    }
}