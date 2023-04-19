<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Database\Import\ImportFileResponse;
use Sunhill\Collection\Response\Database\Import\ExecImportFileResponse;

use Sunhill\Collection\Response\Database\Import\Movies\ListMoviesImportResponse;
use Sunhill\Collection\Response\Database\Import\Movies\LookupMovieResponse;
use Sunhill\Collection\Response\Database\Import\Movies\ExecLookupMovieResponse;
use Sunhill\Collection\Response\Database\Import\Movies\EditMovieResponse;
use Sunhill\Collection\Response\Database\Import\Movies\ExecEditMovieResponse;
use Sunhill\Collection\Response\Database\Import\Movies\ShowMovieResponse;
use Sunhill\Collection\Response\Database\Import\Movies\DeleteMovieResponse;
use Sunhill\Collection\Response\Database\Import\Movies\ImportMovieResponse;
use Sunhill\Collection\Response\Database\Import\Movies\AddSeriesResponse;
use Sunhill\Collection\Response\Database\Import\Movies\ExecAddSeriesResponse;

class ImportsController extends Controller
{
    
    public function index()
    {
        $response = new SunhillTileViewResponse();
        return $response->response();
    }
    
    public function ImportFile()
    {
        $response = new ImportFileResponse();
        return $response->response();
    }

    public function ExecImportFile()
    {
        $response = new ExecImportFileResponse();
        return $response->response();        
    }
    
    // ***************************** Movies ****************************************
    public function listMovies($page = 0)
    {
        $response = new ListMoviesImportResponse();
        $response->setOffset($page);
        return $response->response();        
    }
    
    public function addSeries()
    {
        $response = new AddSeriesResponse();
        return $response->response();        
    }
    
    public function ExecAddSeries()
    {
        $response = new ExecAddSeriesResponse();
        return $response->response();
    }
    
    public function showMovie($id)
    {
        $response = new ShowMovieResponse();
        $response->setID($id);
        return $response->response();        
    }
    
    public function importMovie($id)
    {
        $response = new ImportMovieResponse();
        $response->setID($id);
        return $response->response();        
    }
    
    public function editMovie($id)
    {
        $response = new EditMovieResponse();
        $response->setID($id);
        return $response->response();        
    }
    
    public function execEditMovie($id)
    {
        $response = new ExecEditMovieResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function deleteMove($id)
    {
        $response = new DeleteMovieResponse();
        $response->setID($id);
        return $response->response();        
    }
    
    public function lookupMovie($id)
    {
        $response = new LookupMovieResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function execLookupMovie($id)
    {
        $response = new ExecLookupMovieResponse();
        $response->setID($id);
        return $response->response();
    }
}
