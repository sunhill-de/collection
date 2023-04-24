<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\Collection\Facades\TMDB;
use Sunhill\Collection\Traits\SearchName;
use Sunhill\Collection\Utils\HasID;
use Illuminate\Support\Facades\DB;
use Sunhill\Visual\Response\SunhillUserException;

class ImportMovieResponse extends SunhillBladeResponse
{
    
    use HasID, SearchName;
    
    protected $template = 'collection::import.movies.import';
        
    public function prepareResponse()
    {
        parent::prepareResponse();
        $result = DB::table('import_movies')->where('id',$this->id)->first();
        
        if (empty($result->imdb_id) && empty($result->tmdb_id)) {
            throw new SunhillUserException(__('Neither an imdb nor a tmdb ID was provided for import.'));
        }
        
        $movie = new \StdClass();
        if (empty($result->tmdb_id)) {
            $search = TMDB::searchMovieByIMDBID($result->imdb_id);
            $movie->tmdb_id = $search->id;
            $movie->imdb_id = $result->imdb_id;
        } else {
            $search = TMDB::searchMovieByID($result->tmdb_id);
            $movie->tmdb_id = $result->tmdb_id;
            $movie->imdb_id = $search->imdb_id; 
        }
        $movie->title   = $search->title;
        $movie->original_title = $search->original_title;
        $movie->search_name = $this->suggestSearchName($search->title);
        $movie->release_date = $search->release_date;
        $movie->length = $search->runtime;
        $movie->plot = $search->overview;
        
        $this->params['id'] = $this->id;
        $this->params['movie'] = $movie;
    }
}  
