<?php

namespace Sunhill\Collection\Response\Database\Import;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\Collection\Facades\Imports;
use Sunhill\Visual\Response\SunhillUserException;
use Sunhill\Visual\Modules\SunhillModuleTrait;

class ExecImportFileResponse extends SunhillRedirectResponse
{
    
    use SunhillModuleTrait;
    
    protected function prepareResponse()
    {
        if (!request()->hasFile('file')) {
            throw new SunhillUserException(__("File was not uploaded."));
        }
        if (!request()->file('file')->isValid()) {
            throw new SunhillUserException(__("File was not valid."));
        }
        $all = request()->all();
        $file = request()->file('file')->getPathname();
        $filter = request()->input('filter');
        Imports::importFile($file, $filter);
        $this->setTarget(route('imports.movies.list'));
    }
    
}  
