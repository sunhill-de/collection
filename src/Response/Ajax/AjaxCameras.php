<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxSearchResponse;
use Sunhill\ORM\Facades\Attributes;

class AjaxCameras extends AjaxSearchResponse
{
    
    protected function zoneminderStream(int $monitor)
    {
         base64_encode(readfile("http://192.168.3.1:8081/cgi-bin/nph-zms?scale=0&mode=jpeg&maxfps=30&monitor=$monitor"));   
    }
    
    protected function assembleSearchResult(string $search)
    {
        switch ($this->parameter1) {
            case 'haustuer':
                return $this->zoneminderStream(1);
                break;
            case 'kaemmerchen':
                break;
            case 'carport':
                break;
        }
    }
    
}