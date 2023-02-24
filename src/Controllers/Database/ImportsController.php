<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\SunhillTileViewResponse;
use Sunhill\Collection\Response\Database\Import\ListMoviesImportResponse;
use Sunhill\Collection\Response\Database\Import\LookupMovieResponse;

class ImportsController extends Controller
{
    
    public function index()
    {
        $response = new SunhillTileViewResponse();
        return $response->response();
    }
    
    public function listMovies($page = 0)
    {
        $response = new ListMoviesImportResponse();
        $response->setDelta($page);
        return $response->response();        
    }
    
    public function showMovie($id)
    {
        
    }
    
    public function importMovie($id)
    {
        
    }
    
    public function editMovie($id)
    {
        
    }
    
    public function deleteMove($id)
    {
        
    }
    
    public function lookupMovie($id)
    {
        $response = new LookupMovieResponse();
        $response->setID($id);
        return $response->response();
    }
    
}
