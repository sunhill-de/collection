<?php

namespace Sunhill\Collection\Controllers\Database;

use Sunhill\Visual\Controllers\CrudController;
use Sunhill\Collection\Response\Database\Objects\ObjectsCrudResponse;

class ObjectsController extends CrudController
{
    
    protected static $crud_response = ObjectsCrudResponse::class;
   
    protected function addAdditionalParameters($response)
    {
        $response->setClass(request('class','object'));
    }
        
}
