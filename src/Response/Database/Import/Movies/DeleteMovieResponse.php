<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\Collection\Utils\HasID;
use Illuminate\Support\Facades\DB;

class DeleteMovieResponse extends SunhillRedirectResponse
{
    
    use HasID;
    
    protected $template = 'collection::import.showmovie';
        
    public function prepareResponse()
    {
        parent::prepareResponse();
        
        $result = DB::table('import_movies')->where('id',$this->id)->update(['object_id'=>-1]);
        
        $this->setTarget(url()->previous('imports.movies.list'));
    }
}  
