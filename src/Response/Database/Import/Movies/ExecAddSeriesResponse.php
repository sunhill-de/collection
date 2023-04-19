<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Illuminate\Support\Facades\DB;
use Sunhill\Collection\Utils\HasID;

class ExecAddSeriesResponse extends SunhillRedirectResponse
{

    use HasID;
    
    public function prepareResponse()
    {
        parent::prepareResponse();
        
        $params = [];
        $params['title'] = request('title');
        $params['imdb_id'] = request('imdb_id');
        $params['object_id'] = request('object_id');
        $params['type'] = 'series';
        $params['source'] = 'manual';
        $params['object_id'] = 0;
        DB::table('import_movies')->insert($params);
    
        $this->target = route('imports.movies.list',['offset'=>request('return_to',0)]);
    }
}  
