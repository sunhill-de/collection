<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Visual\Response\ListDescriptor;
use Sunhill\Visual\Response\SunhillListResponse;
use Illuminate\Support\Facades\DB;

class ListMoviesImportResponse extends SunhillListResponse
{
    
    protected $template = 'collection::import.movies.list';
    
    protected $route = 'imports.movies.list';
    
    protected $order = 'id';
    
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->column('id')->title('id')->searchable();
        $descriptor->column('type')->title('type');
        $descriptor->column('season')->title('season')->nullable();
        $descriptor->column('episode')->title('episode')->nullable();
        $descriptor->column('title')->title('Movie name')->searchable();
        $descriptor->column('imdb_id')->title('IMDB-ID')->nullable();
        $descriptor->column('object_id')->title('imported');
        $descriptor->column('lookup')->link('imports.movies.lookup',['id'=>'id','return_to'=>$this->offset]);
        $descriptor->column('import')->link('imports.movies.import',['id'=>'id','return_to'=>$this->offset]);
        $descriptor->column('edit')->link('imports.movies.edit',['id'=>'id','return_to'=>$this->offset]);
        $descriptor->column('delete')->link('imports.movies.delete',['id'=>'id','return_to'=>$this->offset]);
    }
    
    protected function getQuery()
    {
        $query = DB::table('import_movies');
                
        return $query;
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        $query = $this->getQuery();
        return $query->count();
    }
    
    protected function getData()
    {
        $query = $this->getQuery();
        $query = $query->offset($this->offset*self::ENTRIES_PER_PAGE)->limit(self::ENTRIES_PER_PAGE);
        return $query->get();
    }
        
}  