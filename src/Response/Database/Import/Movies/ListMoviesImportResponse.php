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
        $descriptor->column('title')->title('Movie name')->searchable()->displayCallback(function($data) {
            if ($data->type == 'episode') {
                return $data->title.'(S'.$data->season.' E'.$data->episode.')';                
            } else {
                return $data->title;
            }
        });
        $descriptor->column('imdb_id')->title('IMDB-ID')->nullable();
        $descriptor->column('tmdb_id')->title('TMDB-ID')->nullable();
        $descriptor->column('object_id')->title('imported');
        $descriptor->column('lookup')->link('imports.movies.lookup',['id'=>'id','return_to'=>$this->offset]);
        $descriptor->column('import')->link('imports.movies.import',['id'=>'id','return_to'=>$this->offset]);
        $descriptor->column('edit')->link('imports.movies.edit',['id'=>'id','return_to'=>$this->offset]);
        $descriptor->column('delete')->link('imports.movies.delete',['id'=>'id','return_to'=>$this->offset]);
    }
    
    protected function getQuery()
    {
        $query = DB::table('import_movies');
        switch ($this->filter) {
            case 'unimported':
                $query = $query->where('object_id',0); break;
            case 'imported':    
                $query = $query->where('object_id','>',0); break;
            case 'deleted':
                $query = $query->where('object_id','<',0); break;
            case 'unimportedmovies':
                $query = $query->where('object_id',0)->where('type','movie'); break;
            case 'unimportedseries':
                $query = $query->where('object_id',0)->where('type','series'); break;
            case 'unimportedepisodes':
                $query = $query->where('object_id',0)->where('type','episode'); break;
        }
        return $query;
    }
    
    protected function getFilters()
    {
        return [
            'unimported'=>'Unimported',
            'imported'=>'Imported',
            'deleted'=>'Deleted',
            'all'=>'All',
            'unimportedmovies'=>'Unimported movies',
            'unimportedseries'=>'Unimported series',
            'unimportedepisodes'=>'Unimported episodes',            
        ];
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
        $query = $this->getQuery()->orderBy($this->order, $this->order_dir);
        $query = $query->offset($this->offset*self::ENTRIES_PER_PAGE)->limit(self::ENTRIES_PER_PAGE);
        return $query->get();
    }
        
}  
