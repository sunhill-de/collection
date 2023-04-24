<?php

namespace Sunhill\Collection\Managers;

use TMDB\Client;
use TMDB\structures\Movie;

class TMDBManager
{
    
    protected $tmdb;
    
    public function __construct()
    {
        $this->tmdb = Client::getInstance(env('TMDB_KEY'));
        $this->tmdb->adult = true;
        $this->tmdb->language = 'de';
    }
    
    public function searchMovieByName(string $title)
    {
        $results = $this->tmdb->search('movie', ['query'=>$title]);
        $return = [];
        foreach ($results as $id => $movie) {
            $return[] = $this->searchMovieByID($id);
        }
        
        return $return;        
    }
    
    public function searchMovieByID(int $id)
    {
        return new Movie($id);
    }
    
    public function searchMovieByIMDBID(string $id)
    {
        return $this->tmdb->find($id);
    }
    
}
