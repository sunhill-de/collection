<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\Collection\Utils\HasID;
use Sunhill\ORM\Facades\Classes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use hmerritt\Imdb;

class ImportMovieResponse extends SunhillBladeResponse
{
    
    use HasID;
    
    protected $template = 'collection::import.movies.import';
        
    public function prepareResponse()
    {
        parent::prepareResponse();
        
        $this->params['id'] = $this->id;
    }
}  
