<?php

namespace Sunhill\Collection\Response\Database\Import;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Illuminate\Support\Facades\DB;
use Sunhill\Collection\Utils\HasID;

class ExecEditMovieResponse extends SunhillRedirectResponse
{

    use HasID;
    
    public function prepareResponse()
    {
        parent::prepareResponse();
        
        $params = [];
        $params['title'] = request('title');
        $params['source'] = request('source');
        $params['source_id'] = request('source_id');
        $params['imdb_id'] = request('imdb_id');
        $params['object_id'] = request('object_id');
        
        DB::table('import_movies')->where('id',$this->id)->update($params);
    
        $this->target = route('imports.movies.list');
    }
}  
