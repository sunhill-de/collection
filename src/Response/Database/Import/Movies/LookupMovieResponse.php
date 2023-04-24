<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\Collection\Utils\HasID;
use Illuminate\Support\Facades\DB;
use Sunhill\Collection\Facades\TMDB;

class LookupMovieResponse extends SunhillBladeResponse
{
    
    use HasID;
    
    protected $template = 'collection::import.movies.lookup';
        
    public function prepareResponse()
    {
        parent::prepareResponse();
        
        $result = DB::table('import_movies')->where('id',$this->id)->first();
        
        $candiates = TMDB::searchMovieByName($result->title);
        
        $this->params['results'] = $candiates;
        $this->params['id'] = $this->id;
    }
}  
