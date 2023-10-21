<?php

namespace Sunhill\Collection\Controllers\Database;

use Sunhill\Visual\Controllers\CrudController;
use Sunhill\Collection\Response\Database\Classes\ShowClassResponse;
use Sunhill\Collection\Response\Database\Classes\ChooseClassResponse;
use Sunhill\Collection\Response\Database\Classes\SelectClassesResponse;
use Sunhill\Collection\Response\Database\Classes\ClassesCrudResponse;

class ClassesController extends CrudController
{
    
    protected static $crud_response = ClassesCrudResponse::class;
    
    public function select()
    {
       $response = new SelectClassesResponse();
       return $response->response();
    }
    
    public function choose()
    {
        $response = new ChooseClassResponse();
        return $response->response();
    }
    
}
