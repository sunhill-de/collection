<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\Collection\Facades\TMDB;
use Sunhill\Collection\Objects\Language;
use Sunhill\Collection\Traits\SearchName;
use Sunhill\Collection\Utils\HasID;
use Illuminate\Support\Facades\DB;
use Sunhill\Visual\Response\SunhillUserException;

class ImportMovieResponse extends SunhillBladeResponse
{
    
    use HasID, SearchName;
    
    protected $template = 'collection::import.movies.import';
       
    protected function lookupLanguage(string $iso, \StdClass $movie)
    {
        if ($language = Language::search()->where('iso',$iso)->loadIfExists()) {
            $movie->language_id = $language->getID();
            $movie->language_name = $language->name;
            return $language;
        }
        throw new SunhillUserException(__("Language ':lan' not found",['lan'=>$iso]));
    }
    
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
        $this->lookupLanguage($search->original_language, $movie);
        
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
