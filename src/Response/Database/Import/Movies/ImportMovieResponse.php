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
    
    protected $template = 'collection::import.showmovie';
        
    public function prepareResponse()
    {
        parent::prepareResponse();
        
        $result = DB::table('import_movies')->where('id',$this->id)->first();
        foreach ($result as $key => $value) {
            $this->params[$key] = $value;
        }
        $this->params['id'] = $this->id;
    }
}  
