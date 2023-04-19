<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Database\Import\ImportFileResponse;
use Sunhill\Collection\Response\Database\Import\ExecImportFileResponse;

use Sunhill\Collection\Response\Database\Import\ListMoviesImportResponse;
use Sunhill\Collection\Response\Database\Import\LookupMovieResponse;
use Sunhill\Collection\Response\Database\Import\ExecLookupMovieResponse;
use Sunhill\Collection\Response\Database\Import\EditMovieResponse;
use Sunhill\Collection\Response\Database\Import\ExecEditMovieResponse;
use Sunhill\Collection\Response\Database\Import\ShowMovieResponse;
use Sunhill\Collection\Response\Database\Import\DeleteMovieResponse;
use Sunhill\Collection\Response\Database\Import\ImportMovieResponse;

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
    
    public function listMovies($page = 0)
    {
        $response = new ListMoviesImportResponse();
        $response->setOffset($page);
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
