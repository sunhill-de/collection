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
        $file = request()->file('file')->getPathname();
        $filter = request()->input('filter');
        $target = Imports::importFile($file, $filter);
        $this->setTarget(route("imports.$target.list"));
    }
    
}  
