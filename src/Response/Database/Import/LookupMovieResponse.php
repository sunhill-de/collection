<?php

namespace Sunhill\Collection\Response\Database\Import;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\Collection\Utils\HasID;
use Sunhill\ORM\Facades\Classes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use hmerritt\Imdb;

class LookupMovieResponse extends SunhillBladeResponse
{
    
    use HasID;
    
    protected $template = 'collection::import.lookupmovie';
        
    protected function collectCandidates(string $title): array
    {
        
        $imdb = new Imdb();
        $search = $imdb->search($title)['titles'];
        
        for ($i=0;$i<count($search);$i++) {
            $movie = $imdb->film($search[$i]['id']);
            $search[$i] = array_merge($search[$i],$movie);
        }
        
        return $search;
    }
    
    public function prepareResponse()
    {
        parent::prepareResponse();
        
        $result = DB::table('import_movies')->where('id',$this->id)->first();
        
        $candiates = $this->collectCandidates($result->title);
        
        $this->params['results'] = $candiates;
        $this->params['id'] = $this->id;
    }
}  
