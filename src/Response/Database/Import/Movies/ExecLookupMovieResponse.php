<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Illuminate\Support\Facades\DB;
use Sunhill\Collection\Utils\HasID;

class ExecLookupMovieResponse extends SunhillRedirectResponse
{

    use HasID;
    
    public function prepareResponse()
    {
        parent::prepareResponse();
        
        $imdb = request()->input('imdb');
        $tmdb = request()->input('tmdb');
        DB::table('import_movies')->where('id',$this->id)->update(['imdb_id'=>$imdb,'tmdb_id'=>$tmdb]);
    
        $this->target = route('imports.movies.list');
    }
}  
