<?php

namespace Sunhill\Collection\Response\Database\Import\Movies;

use Sunhill\Collection\Utils\Collector;
use Sunhill\Visual\Response\SunhillUserException;
use Illuminate\Support\Facades\DB;
use Sunhill\Collection\Facades\TMDB;

define('IMPORT_ACTORS', 7);

trait CollectMovieData
{
    
    protected function searchImportMovie(int $id)
    {
        if (!$result = DB::table('import_movies')->where('id',$id)->first()) {
            throw new SunhillUserException(__('The entry :id does not exist.',['id'=>$id]));
        }
        return $result;
    }
    
    protected function checkIDBIDs($import_movie)
    {
        if (empty($import_movie->imdb_id) && empty($import_movie->tmdb_id)) {
            throw new SunhillUserException(__('Neither an imdb nor a tmdb ID was provided for import.'));
        }
    }
    
    protected function getTMDBEntry($import_movie)
    {
        if (empty($import_movie->tmdb_id)) {
            return TMDB::searchMovieByIMDBID($import_movie->imdb_id);
        } else {
            return TMDB::searchMovieByID($import_movie->tmdb_id);
        }
    }
    
    protected function handleLanguage($movie, $tmdb_movie)
    {
        $movie->addObject('language','Language','iso','name',['iso'=>$tmdb_movie->original_language,'name'=>$tmdb_movie->original_language]);
    }
    
    protected function handleCountries($movie, $tmdb_movie)
    {
        foreach ($tmdb_movie->production_countries as $country) {
            $movie->addObject('countries','Country','iso_code','name',['iso_code'=>strtolower($country->iso_3166_1),'name'=>$country->name]);
        }
    }
    
    protected function handleGenres($movie, $tmdb_movie)
    {
        foreach ($tmdb_movie->genres as $genre) {
            $movie->addObject('genres','Genre','name','name',['name'=>$genre->name]);
        }
    }
    
    protected function handleCollection($movie, $tmdb_movie)
    {
        if (!empty($tmdb_movie->belongs_to_collection)) {
            
        }
    }
    
    protected function handleKeywords($movie, $tmdb_movie)
    {
        $keywords = $tmdb_movie->keywords();
        foreach ($keywords->keywords as $keyword) {
            $movie->addString('keywords',$keyword->name);
        }
    }
    
    protected function parsePerson($actor): array
    {
        $result = [];
        $name_parts = explode(' ',$actor->name);
        $result['lastname'] = array_pop($name_parts);
        $result['firstname'] = implode(' ',$name_parts);
        switch ($actor->gender) {
            case 2: $result['sex'] = 'male'; break;
            case 1: $result['sex'] = 'female'; break;
            default:
                $result['sex'] = 'divers'; break;
        }
        return $result;
    }
    
    protected function handleActors($actors, $movie)
    {
        $actors = array_slice($actors, 0, IMPORT_ACTORS);
        foreach ($actors as $actor) {
            $person = $movie->addPerson('actor',$this->parsePerson($actor));
        }
    }
    
    protected function handleCrew($crew, $movie)
    {
        
    }
    
    protected function handleCast($movie, $tmdb_movie)
    {
        $cast = $tmdb_movie->casts();
        $this->handleActors($cast['cast'], $movie);
        $this->handleCrew($cast['crew'], $movie);
    }
    
    protected function handleName($movie, $tmdb_movie)
    {
        $movie->addString('title', $tmdb_movie->title);
        $movie->addString('original_title', $tmdb_movie->original_title);
        $movie->addString('search_name', $this->suggestSearchName($tmdb_movie->title));
    }
    
    protected function collectMovie()
    {
        $import_movie = $this->searchImportMovie($this->id);
        $this->checkIDBIDs($import_movie);
        
        $tmdb_movie = $this->getTMDBEntry($import_movie);
        
        $movie = new Collector();
        $movie->addString('tmdb_id', $tmdb_movie->id);
        $movie->addString('imdb_id', $tmdb_movie->imdb_id);
        
        $this->handleLanguage($movie, $tmdb_movie);
        $this->handleCountries($movie, $tmdb_movie);
        $this->handleGenres($movie, $tmdb_movie);
        $this->handleKeywords($movie, $tmdb_movie);
        $this->handleCast($movie, $tmdb_movie);
        $this->handleName($movie, $tmdb_movie);
        
        $movie->addString('poster', $tmdb_movie->poster());
        $movie->addDate('release_date', $tmdb_movie->release_date);
        $movie->addInteger('length', $tmdb_movie->runtime);
        $movie->addText('plot', $tmdb_movie->overview);
        
        return $movie;
    }
}