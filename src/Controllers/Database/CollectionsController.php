<?php

namespace Sunhill\Collection\Controllers\Database;

use Sunhill\Visual\Controllers\SemiCrudController;
use Sunhill\Collection\Response\Database\Collections\CollectionsCrudResponse;

class CollectionsController extends SemiCrudController
{
    
    protected static $crud_response = CollectionsCrudResponse::class;
    
}
