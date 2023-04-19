<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\Collection\Utils\HasID;
use Sunhill\ORM\Facades\Classes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use hmerritt\Imdb;

class AddSeriesResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::import.movies.add';
        
}  
