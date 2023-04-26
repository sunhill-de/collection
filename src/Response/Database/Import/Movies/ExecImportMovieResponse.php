<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\Collection\Traits\SearchName;
use Sunhill\Collection\Utils\HasID;

class ExecImportMovieResponse extends SunhillRedirectResponse
{
    
    use HasID, SearchName, CollectMovieData;
    
        
    protected $template = 'collection::import.movies.import';
       
    protected function insertData(string $class, $data)
    {
        $objec    
    }
    
    protected function insertClass(string $class, array $values)
    {
        foreach ($values as $data) {
            $this->insertObject($class, $data);
        }
    }
    
    public function prepareResponse()
    {
        parent::prepareResponse();
        
        $movie = $this->collectMovie();
        
        foreach ($movie->reference_tree as $key => $values) {
            $this->insertClass($key, $values);
        }
    }
}  
