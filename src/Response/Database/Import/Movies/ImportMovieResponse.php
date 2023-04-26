<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\Collection\Objects\Language;
use Sunhill\Collection\Traits\SearchName;
use Sunhill\Collection\Utils\HasID;

class ImportMovieResponse extends SunhillBladeResponse
{
    
    use HasID, SearchName, CollectMovieData;
    
        
    protected $template = 'collection::import.movies.import';
       
    public function prepareResponse()
    {
        parent::prepareResponse();
        
        
        $this->params['id'] = $this->id;
        $this->params['movie'] = $this->collectMovie();
    }
}  
