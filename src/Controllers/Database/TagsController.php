<?php

namespace Sunhill\Collection\Controllers\Database;

use Sunhill\Collection\Response\Database\Tags\ListChildrenResponse;
use Sunhill\Collection\Response\Database\Tags\ListAssociatedObjectsResponse;
use Sunhill\Visual\Controllers\CrudController;
use Sunhill\Collection\Response\Database\Tags\TagsCrudResponse;

class TagsController extends CrudController
{
    
    protected static $crud_response = TagsCrudResponse::class;
    
    public function listChildren(int $id, $offset = 0)
    {
        $response = new ListChildrenResponse();
        $response->setID($id);
        return $response->response();        
    }
    
    public function listAssociatedObjects(int $id, $offset = 0)
    {
        $response = new ListAssociatedObjectsResponse();
        $response->setID($id);
        return $response->response();        
    }
}
    
