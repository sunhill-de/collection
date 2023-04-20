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
        $hilf = request();
        if (!request()->hasFile('file')) {
            switch ($_FILES['file']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    throw new SunhillUserException(__("The file size exceeds upload_max_filesize."));
                case UPLOAD_ERR_FORM_SIZE:    
                    throw new SunhillUserException(__("The file size exceeds form filesize."));
                case UPLOAD_ERR_PARTIAL:
                    throw new SunhillUserException(__("The file was uploaded partially."));
                case UPLOAD_ERR_NO_FILE:
                    throw new SunhillUserException(__("No file was uploaded."));
                case UPLOAD_ERR_NO_TMP_DIR:
                    throw new SunhillUserException(__("No temp dir."));
                case UPLOAD_ERR_CANT_WRITE:
                    throw new SunhillUserException(__("The temp dir is not writeable."));
            }
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
