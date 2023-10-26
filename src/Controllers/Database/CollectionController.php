<?php

namespace Sunhill\Collection\Controllers\Database;

use Sunhill\Visual\Controllers\CrudController;
use Sunhill\Collection\Response\Database\Collection\CollectionCrudResponse;

class CollectionController extends CrudController
{
   
    protected static $crud_response = CollectionCrudResponse::class;
    
}
