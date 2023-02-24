<?php

namespace Sunhill\Collection\Response\Database\Import;

use Sunhill\Visual\Response\BladeResponse;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Utils\ObjectList;
use Illuminate\Support\Facades\DB;

class ImportPersonsResponse extends BladeResponse
{

    
    protected $template = 'collection::import.persons';
     
    protected function prepareResponse()
    {
        $this->params['entries'] = DB::table('import_persons')->limit(10)->get();
        $entries = DB::table('import_persons')->limit(10)->get();
    }
    
}  
